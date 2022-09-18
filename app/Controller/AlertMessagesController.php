<?php
class AlertMessagesController extends AppController {

	var $name = 'AlertMessages';
	
	function index() {
        $this->set('title_for_layout', __('Inbox', true));

        $user_id = $this->Session->read('Auth.User.id');

        if(!empty($this->data)){
            $action = $this->data['action']; 
            $messages = $this->data['AlertMessage']; 
            foreach($messages as $message_id){
                if($action == 'mark'){
                    $this->AlertMessage->markview($message_id);
                }
                else if($action == 'unmark'){
                    $this->AlertMessage->unmarkview($message_id);
                }
                else{
                    $this->AlertMessage->deleteselected($message_id);
                }
            }
			$this->redirect(array('action' => 'index'));
        }

		$this->AlertMessage->recursive = 0;
        $filter = Array('AlertMessage.recipient'=>$user_id);
		$this->set('alertMessages', $this->paginate(null,$filter));
	}

    function preview($id = null) {
        if (!$id) {
			$this->Session->setFlash(__('Invalid alertMessage', true), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
		}

        $this->data = $this->AlertMessage->read(null, $id);
        $this->data['AlertMessage']['status'] = 1;
        if ($this->AlertMessage->save($this->data)) {
            $this->Session->delete('Auth.Employee');
            $this->set('alertMessage', $this->data);
            $this->redirect(array('action' => 'view',$id)); 
        }
        else{
            $this->redirect(array('action' => 'index'));
        }
    }

	function view($id = null) {
        $this->set('title_for_layout', __('View Message', true));
		if (!$id) {
			$this->Session->setFlash(__('Invalid alertMessage', true), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
		}
		
        $this->data = $this->AlertMessage->read(null, $id); 
        $this->set('alertMessage', $this->data);
        $this->Session->delete('Auth.Employee');
	}

	function add() {
		$user_id = $this->Session->read('Auth.User.id');
		
		if (!empty($this->data)) {
			$this->AlertMessage->create();
            if ($this->AlertMessage->save($this->data)) {
                $this->Session->setFlash(__('The message has been saved', true), 'default', array('class' => 'success'));
                $this->redirect(array('controller' => 'users','action' => 'index'));
            } else {
                $this->AlertMessage->User->delete($this->data['AlertMessage']['user_id']);
                $this->Session->setFlash(__('The message could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
            }
		}
		
		$this->set(compact('user_id'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid id for message', true), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
		}

        if (!empty($this->data)) {
            if ($this->AlertMessage->save($this->data)) {
                $this->Session->delete('Auth.Employee');
                $this->Session->setFlash(__('The message has been updated', true), 'default', array('class' => 'success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The message could not be updated. Please, try again.', true), 'default', array('class' => 'error'));
            }
        }
		if (empty($this->data)) {
                    $this->data = $this->AlertMessage->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for alertMessage', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}

		if ($this->AlertMessage->delete($id)) {
			$this->Session->setFlash(__('Message deleted', true), 'default', array('class' => 'success'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Message was not deleted', true), 'default', array('class' => 'error'));
		$this->redirect(array('action' => 'index'));
	}

        function admin_index() {
		$this->AlertMessage->recursive = 0;
		$this->set('alertMessages', $this->paginate());
	}

        function admin_add() {
		if (!empty($this->data)) {
			$this->AlertMessage->create();
			if ($this->AlertMessage->save($this->data)) {
				$this->Session->setFlash(__('The alertMessage has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The alertMessage could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		}
		$companies = $this->AlertMessage->Company->User->find('list');
		$this->set(compact('companies'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid alertMessage', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->AlertMessage->save($this->data)) {
				$this->Session->setFlash(__('The alertMessage has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The alertMessage could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AlertMessage->read(null, $id);
		}
		
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for alertMessage', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
                
		if ($this->AlertMessage->delete($id)) {
			$this->Session->setFlash(__('AlertMessage deleted', true), 'default', array('class' => 'success'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('AlertMessage was not deleted', true), 'default', array('class' => 'error'));
		$this->redirect(array('action' => 'index'));
	}
}
?>