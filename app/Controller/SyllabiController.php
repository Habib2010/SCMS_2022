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
class SyllabiController extends AppController {

/**
 * Controller name
 *
 * @var string
 * @access public
 */
	public $name = 'Syllabi';

/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
	public $uses = array('Syllabus');

/**
 * Admin index
 *
 * @return void
 * @access public
 */
	public function admin_index() {
		$this->set('title_for_layout', __('Syllabus'));

		$this->Syllabus->recursive = 0;
		$this->paginate['Syllabus']['order'] = "Syllabus.id DESC";
		$this->set('syllabuses', $this->paginate());
		$this->set('displayFields', $this->Syllabus->displayFields());
	}

/**
 * Admin add
 *
 * @return void
 * @access public
 */
	public function admin_add() {
		$this->set('title_for_layout', __('Add Syllabus'));

		if (!empty($this->request->data)) {
		
			$this->Syllabus->create();
			if ($this->Syllabus->save($this->request->data)) {
				$this->Session->setFlash(__('The Syllabus has been saved'), 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Syllabus could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
		$this->set('courses',$this->Syllabus->Course->find('list'));
	}

/**
 * Admin edit
 *
 * @param integer $id
 * @return void
 * @access public
 */
	public function admin_edit($id = null) {
		$this->set('title_for_layout', __('Edit Syllabus'));

		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid Syllabus'), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {	
			
			if ($this->Syllabus->save($this->request->data)) {
				$this->Session->setFlash(__('The Syllabus has been saved'), 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Syllabus could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
		if (empty($this->request->data)) {
		
			$this->request->data = $this->Syllabus->read(null, $id);
			$this->set('courses',$this->Syllabus->Course->find('list'));
			
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
			$this->Session->setFlash(__('Invalid id for Syllabus'), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Syllabus->delete($id)) {
			$this->Session->setFlash(__('Syllabus has been deleted'), 'default', array('class' => 'success'));
			$this->redirect(array('action' => 'index'));
		}
	}

}
