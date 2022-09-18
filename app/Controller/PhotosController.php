<?php

class PhotosController extends AppController {

    public $name = 'Photos';
    public $components = array('ImageUpload');

    /**
     * Admin index
     *
     * @return void
     * @access public
     */
    public function admin_index() {
        $this->set('title_for_layout', __('Gallery Image'));

        $this->Photo->recursive = 0;
        $this->paginate['Photo']['order'] = "Photo.id ASC";
        $this->set('photos', $this->paginate());
    }

    public function index() {
        $this->set('title_for_layout', __('Gallery Image'));

        $this->Photo->recursive = 0;
        $this->paginate['Photo']['order'] = "Photo.id ASC";
        $this->set('photos', $this->paginate());
    }

    /**
     * Admin add
     *
     * @return void
     * @access public
     */
    public function admin_add() {
        $this->set('title_for_layout', __('Add Gallery Image'));
        if (!empty($this->request->data)) {
            $this->Photo->create();
            $photographName = $this->ImageUpload->uploadGalleryImage('large', IMAGE_LOCATION);

            $this->request->data['Photo']['large'] = $photographName['image'];
            $this->request->data['Photo']['thumbnail'] = $photographName['thumbnail'];

            if ($this->Photo->save($this->request->data)) {
                $this->Session->setFlash(__('The Gallery  Image has been saved'), 'default', array('class' => 'success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Gallery Image could not be saved. Please, try again.'), 'default', array('class' => 'error'));
            }
        }
        $this->set('albums', $this->Photo->Album->find('list'));
    }

    /**
     * Admin edit
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function admin_edit($id = null) {
        $this->set('title_for_layout', __('Edit Gallery Image'));

        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid Gallery Image'), 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            $photographName = $this->ImageUpload->uploadGalleryImage('large', IMAGE_LOCATION);

            if (!empty($photographName['image'])) {
                $this->request->data['Photo']['large'] = $photographName['image'];
                $this->request->data['Photo']['thumbnail'] = $photographName['thumbnail'];
            }else {
                unset( $this->request->data['Photo']['large']);
                unset( $this->request->data['Photo']['thumbnail']);
            }
            $phInfo = $this->Photo->find('all', array('conditions' => array('Photo.id' => $id)));
            if ($this->Photo->save($this->request->data)) {
                if (!empty($_FILES['large']['name'])) {
                    if (!empty($phInfo[0]['Photo']['thumbnail'])) {
                        if ($phInfo[0]['Photo']['thumbnail'] != $this->request->data['Photo']['thumbnail']) {
                            unlink(WWW_ROOT . "img" . DS . "gallery" . DS . "thumbnail" . DS . $phInfo[0]['Photo']['thumbnail']);
                        }
                    }
                }
                if (!empty($_FILES['large']['name'])) {
                    if (!empty($phInfo[0]['Photo']['large'])) {
                        if ($phInfo[0]['Photo']['large'] != $this->request->data['Photo']['large']) {
                            unlink(WWW_ROOT . "img" . DS . "gallery" . DS . "large" . DS . $phInfo[0]['Photo']['large']);
                        }
                    }
                }
                $this->Session->setFlash(__('The Gallery Image has been saved'), 'default', array('class' => 'success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Gallery Image could not be saved. Please, try again.'), 'default', array('class' => 'error'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Photo->read(null, $id);
            $this->set('albums', $this->Photo->Album->find('list'));
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
            $this->Session->setFlash(__('Invalid id for Gallery Image'), 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'index'));
        }
         $phInfo = $this->Photo->find('all', array('conditions' => array('Photo.id' => $id)));
        if ($this->Photo->delete($id)) {
            unlink(WWW_ROOT . "img" . DS . "gallery" . DS . "thumbnail" . DS . $phInfo[0]['Photo']['thumbnail']);
            unlink(WWW_ROOT . "img" . DS . "gallery" . DS . "large" . DS . $phInfo[0]['Photo']['large']);
            $this->Session->setFlash(__('Gallery Image deleted'), 'default', array('class' => 'success'));
            $this->redirect(array('action' => 'index'));
        }
    }

}

?>