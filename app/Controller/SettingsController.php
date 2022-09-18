<?php

/**
 * Settings Controller
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
class SettingsController extends AppController {

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'Settings';

    /**
     * Models used by the Controller
     *
     * @var array
     * @access public
     */
    public $uses = array('Setting', 'SmsLog');

    /**
     * Helpers used by the Controller
     *
     * @var array
     * @access public
     */
    public $helpers = array('Html', 'Form');
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

    /**
     * Admin dashboard
     *
     * @return void
     * @access public
     */
    public function admin_dashboard() {
        $this->set('title_for_layout', __('Dashboard'));
        $setingsInfo = Configure::read("Scms");
        $uid = $this->Session->read('Auth.User.id');
        $u_roleid = $this->Session->read('Auth.User.role_id');
        //pr($u_roleid);die;
        if ($setingsInfo['credit_expire_date'] < strtotime(date('d-m-Y')) && $setingsInfo['credit_expire_date'] != 0 && !empty($setingsInfo['credit_expire_date'])) {
            $creditInfo = $this->Setting->find('first', array('conditions' => array('Setting.key' => 'Scms.credit'), 'fields' => array('Setting.id', 'Setting.value'), 'recursive' => -1));
            $this->Setting->save(
                    array('Setting' => array(
                            'id' => $creditInfo['Setting']['id'],
                            'value' => 0
                    ))
            );
        }
        $this->set('uid', $uid);
        $this->set('u_roleid', $u_roleid);
    }

    /**
     * Admin index
     *
     * @return void
     * @access public
     */
    public function admin_index() {
        $this->set('title_for_layout', __('Settings'));

        $this->Setting->recursive = 0;
        $this->paginate['Setting']['order'] = "Setting.weight ASC";
        if (isset($this->request->params['named']['p'])) {
            $this->paginate['Setting']['conditions'] = "Setting.key LIKE '" . $this->request->params['named']['p'] . "%'";
        }
        $this->set('settings', $this->paginate());
    }

    /**
     * Admin view
     *
     * @param view $id
     * @return void
     * @access public
     */
    public function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid Setting.'), 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('setting', $this->Setting->read(null, $id));
    }

    /**
     * Admin add
     *
     * @return void
     * @access public
     */
    public function admin_add() {
        $this->set('title_for_layout', __('Add Setting'));
        if (!empty($this->request->data)) {
            if ($this->request->data['Setting']['key'] == 'Scms.credit_expire_date' && $this->request->data['Setting']['value'] != 0 && !empty($this->request->data['Setting']['value'])) {
                $this->request->data['Setting']['value'] = strtotime($this->request->data['Setting']['value']);
            }
            $this->Setting->create();
            if ($this->Setting->save($this->request->data)) {
                if ($this->request->data['Setting']['key'] == 'Scms.credit_expire_date') {
                    $this->request->data['Setting']['value'] = strtotime($this->request->data['Setting']['value']);
                }

                $this->Session->setFlash(__('The Setting has been saved'), 'default', array('class' => 'success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Setting could not be saved. Please, try again.'), 'default', array('class' => 'error'));
            }
        }
    }

    /**
     * Admin edit
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function admin_edit($id = null) {
        $this->set('title_for_layout', __('Edit Setting'));

        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid Setting'), 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->request->data['Setting']['key'] == 'Scms.credit_expire_date' && $this->request->data['Setting']['value'] != 0 && !empty($this->request->data['Setting']['value'])) {
                $this->request->data['Setting']['value'] = strtotime($this->request->data['Setting']['value']);
            }
            if ($this->Setting->save($this->request->data)) {
                $this->Session->setFlash(__('The Setting has been saved'), 'default', array('class' => 'success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Setting could not be saved. Please, try again.'), 'default', array('class' => 'error'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Setting->read(null, $id);
        }
    }

    /**
     * Admin delete
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Setting'), 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Setting->delete($id)) {
            $this->Session->setFlash(__('Setting deleted'), 'default', array('class' => 'success'));
            $this->redirect(array('action' => 'index'));
        }
    }

    /**
     * Admin prefix
     *
     * @param string $prefix
     * @return void
     * @access public
     */
    public function admin_prefix($prefix = null) {
        $this->set('title_for_layout', __('Settings: %s', $prefix));

        if (!empty($this->request->data) && $this->Setting->saveAll($this->request->data['Setting'])) {
            $this->Session->setFlash(__("Settings updated successfully"), 'default', array('class' => 'success'));
            $this->redirect(array('action' => 'prefix', $prefix));
        }

        $settings = $this->Setting->find('all', array(
            'order' => 'Setting.weight ASC',
            'conditions' => array(
                'Setting.key LIKE' => $prefix . '.%',
                'Setting.editable' => 1
            )
                ));
        $this->set(compact('settings'));

        if (count($settings) == 0) {
            $this->Session->setFlash(__("Invalid Setting key"), 'default', array('class' => 'error'));
        }

        $this->set("prefix", $prefix);
    }

    /**
     * Admin moveup
     *
     * @param integer $id
     * @param integer $step
     * @return void
     * @access public
     */
    public function admin_sms_log() {
        $this->layout = 'scms-esa';
        $this->set('title_for_layout', __('Sms Log'));
        $conditions = array();
        if (!empty($this->params->query)) { //GET METHOD!!
            foreach ($this->params->query as $key => $val) {
                if (in_array($key, array('type', 'date'))) {
                    if (isset($this->params->query[$key])) {
                        if (!empty($this->params->query[$key])) {
                            switch ($key) {
                                case 'type': $conditions[$key] = $this->params->query['type'];
                                    break;
                                case 'date': $conditions[$key] = $this->params->query['date'];
                                    break;
                                default: $conditions[$key] = $this->params->query[$key];
                                    break;
                            }
                        }

                        //Set Form Selected Vars;
                        $Model = $key == 'SmsLog';
                        $this->request->data[$Model][$key] = $this->params->query[$key];
                    }
                }
            }
        }
        $this->Paginator->settings = array(
            'SmsLog' => array(
                'conditions' => $conditions,
                'order' => array('id' => 'DESC'),
                'limit' => 100,
            )
        );
        $smsInfos = $this->Paginator->paginate('SmsLog');
        $this->set('smsInfos', $smsInfos);
        //  pr($smsInfos); //die;
    }

    public function admin_moveup($id, $step = 1) {
        if ($this->Setting->moveUp($id, $step)) {
            $this->Session->setFlash(__('Moved up successfully'), 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash(__('Could not move up'), 'default', array('class' => 'error'));
        }

        $this->redirect(array('admin' => true, 'controller' => 'settings', 'action' => 'index'));
    }

    /**
     * Admin moveup
     *
     * @param integer $id
     * @param integer $step
     * @return void
     * @access public
     */
    public function admin_movedown($id, $step = 1) {
        if ($this->Setting->moveDown($id, $step)) {
            $this->Session->setFlash(__('Moved down successfully'), 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash(__('Could not move down'), 'default', array('class' => 'error'));
        }

        $this->redirect(array('admin' => true, 'controller' => 'settings', 'action' => 'index'));
    }

}
