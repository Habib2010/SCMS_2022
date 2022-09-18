<?php

class EmployeesController extends AppController {

    public $name = 'Employees';
    public $uses = array('Employee', 'Level', 'Section');
    public $components = array('ImageUpload', 'Email','Security');
    
    public function admin_index() {
        $this->set('title_for_layout', __('List of Employee'));
        $this->Employee->recursive = 0;
        $filter = array();
        if (!empty($this->request->data)) {
            if ($this->request->data['User']['username']) {
                $filter['User.username'] = $this->request->data['User']['username'];
            }
            if ($this->request->data['User']['role_id']) {
                $filter['User.role_id'] = $this->request->data['User']['role_id'];
            }
            if ($this->request->data['Employee']['status'] == 1) {
                $filter['Employee.status'] = 0;
            }
            if ($this->request->data['Employee']['status'] == 2) {
                $filter['Employee.status'] = 1;
            }
        }
        $this->paginate['Employee']['order'] = "Employee.weight ASC";
        $this->set('employees', $this->paginate(null, $filter));
        $this->set('displayFields', $this->Employee->displayFields());

        $emp_roles = array();
        $excludes = array('admin', 'registered', 'public', 'student', 'guardian');
        $roles = $this->Employee->User->Role->find('all');
        foreach ($roles as $role_id => $role) {
            $role_id = $role['Role']['id'];
            $alias = $role['Role']['alias'];
            $title = $role['Role']['title'];
            if (!in_array($alias, $excludes)) {
                $emp_roles[$role_id] = $title;
            }
        }

        $this->set('roles', $emp_roles);
    }

    public function admin_add() {
        $this->set('title_for_layout', __('Add Employee'));

        if (!empty($this->request->data)) {
            $this->Employee->create();

            $photographName = $this->ImageUpload->uploadEmployeeImage('image', IMAGE_LOCATION2);
            $this->request->data['User']['image'] = $photographName['image'];
            $this->request->data['Employee']['thumbnail'] = $photographName['thumbnail'];

            $this->request->data['User']['status'] = 1;

            $this->request->data['User']['name'] = htmlspecialchars($this->request->data['User']['name']);
            $this->request->data['Employee']['name'] = $this->request->data['User']['name'];

            $this->request->data['User']['activation_key'] = md5(uniqid());

            $pass = $this->random_password();
            $this->request->data['User']['pass'] = $pass;
            $this->request->data['User']['password'] = Security::hash("$pass", null, true);



            $capabilityErrMsg = false;
            if ($this->request->data['User']['role_id'] == $this->scmsLevelTeacherRoleId) {
                if (empty($this->request->data['Employee']['level_id'])) {
                    $capabilityErrMsg = 'Please select Department for this Employee type.';
                } 
            }

            if (empty($capabilityErrMsg) && $this->Employee->saveAll($this->request->data)) {
                $user_id = $this->Employee->User->getLastInsertId();

                $this->request->data['User']['password'] = null;
                $this->Email->from = Configure::read('Site.title') . ' ' .
                        '<support@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])) . '>';
                $this->Email->to = $this->request->data['User']['email'];
                $this->Email->subject = __('[%s] Please activate your account', Configure::read('Site.title'));
                $this->Email->template = 'register';

                //$this->Email->sendAs = 'html';

                $this->set('user', $this->request->data['User']);

                //$this->Email->delivery = 'debug';
//                $this->Email->send();

                $this->Session->setFlash(__('The Employee has been saved'), 'default', array('class' => 'success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Employee could not be saved. Please, try again.'), 'default', array('class' => 'error'));
            }
        }

        $emp_roles = array();
        $excludes = array('admin', 'registered', 'public', 'student', 'guardian');
        $roles = $this->Employee->User->Role->find('all');
        foreach ($roles as $role_id => $role) {
            $role_id = $role['Role']['id'];
            $alias = $role['Role']['alias'];
            $title = $role['Role']['title'];
            if (!in_array($alias, $excludes)) {
                $emp_roles[$role_id] = $title;
            }
        }
        $this->set('role_id', $emp_roles);

        $this->set('scms_jSIdVal', $this->scmsLevelTeacherRoleId);
        $this->set('levels', $this->Level->find('list'));
    }

    /**
     * Admin edit
     * @param integer $id
     * @return void
     * @access public
     */
    public function admin_edit($id = null) {
        $this->set('title_for_layout', __('Edit Employee'));

        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid Employee ID'), 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'index'));
        }

        if (!empty($this->request->data)) {
            $photographName = $this->ImageUpload->uploadEmployeeImage('image', IMAGE_LOCATION2);
            if (!empty($photographName['image'])) {
                $this->request->data['User']['image'] = $photographName['image'];
                $this->request->data['Employee']['thumbnail'] = $photographName['thumbnail'];
            } else {
                unset( $this->request->data['User']['image']);
                unset( $this->request->data['Employee']['thumbnail']);
            }

            $this->request->data['User']['status'] = 1;
            $this->request->data['User']['name'] = htmlspecialchars($this->request->data['User']['name']);
            $this->request->data['Employee']['name'] = $this->request->data['User']['name'];


            $capabilityErrMsg = false;
            if ($this->request->data['User']['role_id'] == $this->scmsLevelTeacherRoleId) {
                if (empty($this->request->data['Employee']['level_id'])) {
                    $capabilityErrMsg = 'Please select Class and Section for this Employee type.';
                } 
            }
            $empInfo = $this->Employee->find('all', array('conditions' => array('Employee.id' => $id)));
            if (empty($capabilityErrMsg) && $this->Employee->saveAll($this->request->data)) {
                 if (!empty($_FILES['image']['name'])) {
                    if (!empty($empInfo[0]['Employee']['thumbnail'])) {
                        if ($empInfo[0]['Employee']['thumbnail'] != $this->request->data['Employee']['thumbnail']) {
                            unlink(WWW_ROOT . "img" . DS . "employee" . DS . "thumbnail" . DS . $empInfo[0]['Employee']['thumbnail']);
                        }
                    }
                    if (!empty($empInfo[0]['User']['image'])) {
                        if ($empInfo[0]['User']['image'] != $this->request->data['User']['image']) {
                            unlink(WWW_ROOT . "img" . DS . "employee" . DS . "large" . DS . $empInfo[0]['User']['image']);
                        }
                    }
                }
                $this->Session->setFlash(__('The Employee has been saved'), 'default', array('class' => 'success'));
                //$this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Employee could not be saved. Please, try again.'), 'default', array('class' => 'error'));
            }
        }

        if (empty($this->request->data)) {
            $this->request->data = $this->Employee->read(null, $id);
        }
        $emp_roles = array();
        $excludes = array('admin', 'registered', 'public', 'student', 'guardian');
        $roles = $this->Employee->User->Role->find('all');
        foreach ($roles as $role_id => $role) {
            $role_id = $role['Role']['id'];
            $alias = $role['Role']['alias'];
            $title = $role['Role']['title'];
            if (!in_array($alias, $excludes)) {
                $emp_roles[$role_id] = $title;
            }
        }
        $this->set('role_id', $emp_roles);


        $this->set('scms_jSIdVal', $this->scmsLevelTeacherRoleId);
        $this->set('levels', $this->Level->find('list'));
    }

    public function admin_mark($id = null) {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid Employee ID'), 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'index'));
        }

        if (!empty($this->request->data)) {
            $this->request->data['Employee']['status'] = 0;

            if ($this->Employee->save($this->request->data)) {
                $this->Session->setFlash(__('The Employee has been saved'), 'default', array('class' => 'success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Employee could not be saved. Please, try again.'), 'default', array('class' => 'error'));
            }
        }

        if (empty($this->request->data)) {
            $this->request->data = $this->Employee->read(null, $id);

            if ($this->request->data['Employee']['status'] == 0) {
                $this->request->data['Employee']['status'] = 1;
                if ($this->Employee->save($this->request->data)) {
                    $this->Session->setFlash(__('The Employee has been saved'), 'default', array('class' => 'success'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The Employee could not be saved. Please, try again.'), 'default', array('class' => 'error'));
                }
            }
        }
    }

    public function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Employee'), 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'index'));
        }
         $empInfo = $this->Employee->find('all', array('conditions' => array('Employee.id' => $id)));
        if ($this->Employee->delete($id)) {
            unlink(WWW_ROOT . "img" . DS . "employee" . DS . "thumbnail" . DS . $empInfo[0]['Employee']['thumbnail']);
            unlink(WWW_ROOT . "img" . DS . "employee" . DS . "large" . DS . $empInfo[0]['User']['image']);
            $this->Session->setFlash(__('Employee deleted'), 'default', array('class' => 'success'));
            $this->redirect(array('action' => 'index'));
        }
    }

    public function view($id = null) {
        $user_id = $this->Session->read('Auth.User.id');
        if (!$user_id) {
            if (!$id) {
                $this->Session->setFlash(__('Invalid Employee'), 'default', array('class' => 'error'));
                $this->redirect(array('action' => 'index'));
            }
            $profile = $this->Employee->findById($id);
        } else {
            $profile = $this->Employee->findByUserId($user_id);
           // pr($profile); die;
        }

        $role = $this->Employee->User->Role->findById($profile['User']['role_id']);
        $this->set(compact('profile', 'role', 'user_id'));

        if ($user_id) {
            $this->render('profile');
        }
    }

    public function index($slug = null) {
        $this->Employee->recursive = 0;

        $filter = array('Employee.status' => 1);

        if ($role = $this->Employee->User->Role->findByAlias($slug)) {
            $filter = array('Employee.status' => 1, 'User.role_id' => $role['Role']['id']);
        }

        $this->set('count', $this->Employee->find('count', array('conditions' => $filter)));

        $this->paginate = array('order' => 'Employee.weight ASC', 'limit' => 30);
        $this->set('profiles', $this->paginate(null, $filter));
        //pr($this->paginate); die;
        $this->set('role', $role);
    }

    public function ex($slug = null) {
        $this->Employee->recursive = 0;

        $filter = array('Employee.status' => 0);

        if ($role = $this->Employee->User->Role->findByAlias($slug)) {
            $filter = array('Employee.status' => 0, 'User.role_id' => $role['Role']['id']);
        }

        $this->set('count', $this->Employee->find('count', array('conditions' => $filter)));

        $this->paginate = array('order' => 'Employee.id DESC', 'limit' => 30);
        $this->set('profiles', $this->paginate(null, $filter));
        $this->set('role', $role);
    }

    /* Profile Edit */

    public function edit() {
        $this->set('title_for_layout', __('জীবনবৃত�?তান�?ত �?ডিট কর�?ন'));

        if (!empty($this->request->data)) {
            $photographName = $this->ImageUpload->uploadImage('image', IMAGE_LOCATION2);

            if (empty($photographName['image'])) {
                $this->request->data['Employee']['image'] = $image;
                $this->request->data['Employee']['thumbnail'] = $thumbnail;
            }

            $this->request->data['User']['name'] = htmlspecialchars($this->request->data['User']['name']);
            $this->request->data['Employee']['name'] = $this->request->data['User']['name'];

            if ($this->Employee->saveAll($this->request->data)) {
                $this->Session->setFlash(__('The Employee has been saved'), 'default', array('class' => 'success'));
                $this->redirect(array('action' => 'view'));
            } else {
                $this->Session->setFlash(__('The Employee could not be saved. Please, try again.'), 'default', array('class' => 'error'));
            }
        }

        if (empty($this->request->data)) {
            $user_id = $this->Session->read('Auth.User.id');
            $this->request->data = $this->Employee->findByUserId($user_id);
        }
    }

    public function random_password() {
        $pass = substr(uniqid(), rand(5, 9), 4) . rand(0, 9) . substr("!@#$%^&*()", rand(0, 9), rand(1, 3));
        return $pass;
    }
    
     public function admin_moveup($id, $step = 1) {
        if ($this->Employee->moveUp($id, $step)) {
            $this->Session->setFlash(__('Moved up successfully'), 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash(__('Could not move up'), 'default', array('class' => 'error'));
        }

        $this->redirect(array('admin' => true, 'controller' => 'employees', 'action' => 'index'));
    }

    public function admin_movedown($id, $step = 1) {
        if ($this->Employee->moveDown($id, $step)) {
            $this->Session->setFlash(__('Moved down successfully'), 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash(__('Could not move down'), 'default', array('class' => 'error'));
        }

        $this->redirect(array('admin' => true, 'controller' => 'employees', 'action' => 'index'));
    }

}