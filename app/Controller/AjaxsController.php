<?php

/**
 * Ajaxs Controller
 *
 * PHP version 5
 *
 * @category Ajaxs Controller
 * @version  1.0
 * @author   Mamun Reza <reza@esoftarena.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.esoftarena.com
 */
class AjaxsController extends AppController {

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'Ajaxs';
    public $helpers = array('Js');

    /**
     * Models used by the Controller
     *
     * @var array
     * @access public
     */
    public $uses = array('Level', 'Section', 'Group', 'Course', 'CourseCycle', 'Student', 'Group', 'StudentCycle', 'StudentCourse', 'StudentResult', 'Employee'); //????????
    public $components = array(
        'RequestHandler',
        'Acl',
        'Auth',
        'Session',
        'Security',
        'Cookie'
    );

    public function beforeFilter() {
        //pr($this->request); die();
        if ($this->request->params['action'] == 'index' && $this->request->data['act'] == 'get-dpndnc-on') {//&& $this->Session->read('Auth.User') != '' ) { 
            $this->Security->csrfCheck = false;
            $this->Security->validatePost = false;
        }

        parent::beforeFilter();
        //$this->Security->unlockedActions = array('getgroup');
    }

    public function index() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $data = array();

        //pr($this->data); die();

        if ($this->request->is('ajax') && !empty($this->data)) { //$this->RequestHandler->isAjax()
            //Configure::write('debug', 0);
            $level_id = $section_id = NULL;

            //Check Limit Access (whatever it is requested by form submission):
            $withCaps = $this->limitCapabilities($level_id, $section_id);
            if ($withCaps) {
                //Overwrite the form vars if any, otherwise set forcefully:
                //............
            }



            if ($this->request->data['obj'] == 'scms-class' || $this->request->data['obj'] == 'scms-class-result') {
                /* $data['section'] = $this->Section->find('list',array(
                  'conditions' => array(
                  'Section.level_id'=>$this->request->data['id']
                  )
                  )); */
                //pr($withCaps);
                $data['section'] = $this->Section->find('list', array(
                    'conditions' => array_merge(
                            array('Section.level_id' => $withCaps ? $level_id : $this->request->data['id']), ($withCaps ? array('Section.id' => $section_id) : array())
                    )
                        ));


                if ($this->request->data['obj'] == 'scms-class-result') {
                    $data['group'] = $this->Group->find('list', array(
                        'conditions' => array(
                            'Group.level_id' => $this->request->data['id']),
                            ));
                } else {
                    $data['course'] = $this->getStudentCourses($this->request->data['id'], NULL);

                    $data['group'] = $this->Group->find('list', array(
                        'conditions' => array(
                            'Group.level_id' => $this->request->data['id']),
                            ));

                    $data['roll'] = $this->StudentCycle->find('list', array(
                        'conditions' => array('StudentCycle.level_id' => $this->request->data['id']),
                        'fields' => array('StudentCycle.id', 'StudentCycle.roll'),
                        'recursive' => 0
                            ));
                }
                //echo json_encode($data['roll']); die;
            } else if ($this->request->data['obj'] == 'scms-group') {
                /* $data['section'] = $this->Section->find('list',array(
                  'conditions' => array(
                  'Section.level_id'=>$this->request->data['scms-class']))); */

                $data['course'] = $this->getStudentCourses($this->request->data['scms-class'], $this->request->data['id']);

                //echo json_encode($data['course']); die;
            }

            /* else if( $this->request->data['obj']=='scms-course' ){
              $data['course'] = $this->CourseCycle->find('list',array(
              'conditions' => array('CourseCycle.level_id'=>$this->request->data['scms-class']),
              'fields' => array('CourseCycle.course_id','Course.name'),
              'recursive' => 0
              ));

              echo json_encode($data['course']); die;
              } */
        }

        echo json_encode($data);
        exit();
    }

}
