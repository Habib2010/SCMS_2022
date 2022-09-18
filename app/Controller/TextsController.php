<?php

/**
 * Roles Controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  Croogo
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class TextsController extends AppController {

    public $name = 'Texts';
    public $uses = array('Text', 'Level', 'Section', 'Group', 'Shift', 'SchoolSession', 'SchoolTermCycle', 'SchoolTerm');
    public $helpers = array('Html', 'Form', 'Js' => array("Jquery"));
    public $components = array(
        'Akismet',
        'Email',
        'Recaptcha',
        'ImageUpload',
        'RequestHandler',
        'Acl',
        'Auth',
        'Session',
        'Security',
        'Cookie',
        'Paginator'
    );

    function beforeFilter() {
        parent::beforeFilter();
        $this->Security->blackHoleCallback = 'blackhole';
        $this->Security->csrfCheck = false;
        $this->Security->validatePost = false;
    }

    public function admin_index() {
        $this->layout = 'scms-esa';
        $this->set('title_for_layout', __('Student Result Text'));
        $level_id = $group_id = NULL;
        $withCaps = $this->limitCapabilities($level_id, $section_id);
        if ($withCaps && empty($this->params->query['level']) && empty($this->params->query['section'])) {
            $this->params->query['level'] = $this->request->data['Text']['level_id'] = $level_id;
        }
       $conditions = array();
        if (!empty($this->params->query)) { //GET METHOD!!
            //pr($this->params->query);die;
            foreach ($this->params->query as $key => $val) {
                if (in_array($key, array('level_id', 'group_id', 'school_session_id', 'term_id'))) {
                    if (isset($this->params->query[$key])) {
                        if (!empty($this->params->query[$key])) {
                            switch ($key) {
                                case 'level_id': $conditions['Text.' . $key] = $this->params->query['level_id'];
                                    break;
                                case 'group_id': $conditions['Text.' . $key] = $this->params->query['group_id'];
                                    break;
                                case 'term_id': $conditions['Text.' . 'school_term_id'] = $this->params->query['term_id'];
                                    break;
                                case 'school_session_id': $conditions['Text.' . $key] = $this->params->query['school_session_id'];
                                    break;
                                default: $conditions[$key] = $this->params->query[$key];
                                    break;
                            }
                        }
                        $Model = $key == 'Text';
                        $this->request->data[$Model][$key] = $this->params->query[$key];
                    }
                }
            }
        }
        //pr($this->params->query);die;
        if (!empty($conditions)) {
                    //pr($conditions);die;
            $this->Paginator->settings = array(
                'Text' => array(
                    'conditions' => $conditions,
                    'order' => array('Text.id' => 'DESC'),
                    'limit' => 100,
                // 'recursive'=>2
                )
            );
            $texts = $this->Paginator->paginate('Text');
        } else {
            $this->Paginator->settings = array(
                'Text' => array(
                    'order' => array('Text.id' => 'DESC'),
                    'limit' => 100,
                //'recursive'=>2
                )
            );
            $texts = $this->Paginator->paginate('Text');
        }
         $this->set('texts', $texts);
        $this->setStudentFormAddEditVars($withCaps, array('levels', 'sections', 'groups'), compact('level_id', 'section_id', 'group_id'));
        $this->set('schoolSessions', $this->SchoolSession->find('all', array(
                    'recursive' => -1
                )));
        $this->set('terms', $this->SchoolTerm->find('list', array('recursive' => -1, 'order' => array('SchoolTerm.id ASC'), 'limit' => 2)));
    }

    public function admin_add() {
        $this->layout = 'scms-esa';
        $this->set('title_for_layout', __('Add Student Result Text'));

        $level_id = $group_id = $section_id = $showCommonVers = NULL;
        $withCaps = $this->limitCapabilities($level_id, $section_id);
        if ($withCaps && empty($this->request->data['Text']['level_id']) && empty($this->request->data['Text']['section_id'])) {
            //Overwrite the form vars if any, otherwise set forcefully:
            $this->request->data['Text']['level_id'] = $level_id;
            $this->request->data['Text']['section_id'] = $section_id;
        }
        if (!empty($this->request->data)) {
            $this->request->data['Text']['school_term_id'] = $this->request->data['Text']['term_id'];
            // $this->request->data['Text']['school_session_id'] = $this->request->data['StudentCycle'][0]['school_session_id'];
            //pr($this->request->data); die;
            $this->Text->create();
            if ($this->Text->save($this->request->data)) {
                $this->Session->setFlash(__('The Student Result Text  has been saved'), 'default', array('class' => 'success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Student Result Text  could not be saved. Please, try again.'), 'default', array('class' => 'error'));
            }
        }
        $this->setStudentFormAddEditVars($withCaps, array('levels', 'sections', 'groups'), compact('level_id', 'section_id', 'group_id'));
        $this->set('schoolSessions', $this->SchoolSession->find('all', array(
                    'recursive' => -1
                )));
        $this->set('terms', $this->SchoolTerm->find('list', array('recursive' => -1, 'order' => array('SchoolTerm.id ASC'), 'limit' => 2)));
    }

    /**
     * Admin edit
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function admin_edit($id = null) {
        $this->set('title_for_layout', __('Edit Student Result Text'));
        $this->layout = 'scms-esa';
        $level_id = $group_id = $section_id = $showCommonVers = NULL;
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid Student Result Text'), 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'index'));
        }
        $withCaps = $this->limitCapabilities($level_id, $section_id);
        if ($withCaps && empty($this->request->data['Text']['level_id']) && empty($this->request->data['Text']['section_id'])) {
            //Overwrite the form vars if any, otherwise set forcefully:
            $this->request->data['Text']['level_id'] = $level_id;
            $this->request->data['Text']['section_id'] = $section_id;
        }
        if (!empty($this->request->data)) {
            // pr($this->request->data);die;
            $this->request->data['Text']['school_term_id'] = $this->request->data['Text']['term_id'];
            if ($this->Text->save($this->request->data)) {
                $this->Session->setFlash(__('The Student Result Text has been updated'), 'default', array('class' => 'success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Student Result Text could not be updated. Please, try again.'), 'default', array('class' => 'error'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Text->read(null, $id);
            // pr($this->request->data);die;
        }
        $this->setStudentFormAddEditVars($withCaps, array('levels', 'sections', 'groups'), compact('level_id', 'section_id', 'group_id'));
        $this->set('schoolSessions', $this->SchoolSession->find('all', array(
                    'recursive' => -1
                )));
        $this->set('terms', $this->SchoolTerm->find('list', array('recursive' => -1, 'order' => array('SchoolTerm.id ASC'), 'limit' => 2)));
    }

    public function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Student Result Text'), 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Text->delete($id)) {
            $this->Session->setFlash(__('Student Result Text deleted'), 'default', array('class' => 'success'));
            $this->redirect(array('action' => 'index'));
        }
    }

}
