<?php

/**
 * Albums Controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  Croogo
 * @version  1.4.4
 * @author   Edinei L. Cipriani <phpedinei@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.demoveo.com
 */
class AlbumsController extends AppController {

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'Albums';

    function admin_index() {
        $this->set('title_for_layout', __('Photo Album', 'Albums', true));

        $this->Album->recursive = 0;
        $this->paginate = array(
            'limit' => Configure::read('Gallery.album_limit_pagination'),
            'order' => 'Album.position ASC');
        $this->set('albums', $this->paginate());
    }

    function admin_add() {

        if (!empty($this->request->data)) {
            $this->Album->create();

            $this->Album->recursive = -1;

            $position = $this->Album->find('all', array(
                'fields' => 'MAX(Album.position) as position'
                    ));

            $this->request->data['Album']['position'] = $position[0][0]['position'] + 1;

            if ($this->Album->save($this->request->data)) {
                $this->Session->setFlash(__('Album is saved.', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('gallery', 'Album could not be saved. Please try again.', true));
            }
        }

        $this->set('types', $this->jslibs);

        $location = array('home' => 'Home', 'gallery' => 'Gallery', 'other' => 'Other');

        $this->set(compact('location'));
    }

    function admin_edit($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid album.', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Album->save($this->request->data)) {
                $this->Session->setFlash(__('gallery', 'Album is saved.', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('gallery', 'Album could not be saved. Please try again.', true));
            }
        }

        $this->request->data = $this->Album->read(null, $id);
        $this->set('types', $this->jslibs);

        $location = array('home' => 'Home', 'gallery' => 'Gallery', 'other' => 'Other');

        $this->set(compact('location'));
    }

    public function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Album'), 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'index'));
        }

        if ($this->Album->delete($id)) {
            $this->Session->setFlash(__('Album deleted'), 'default', array('class' => 'success'));
            $this->redirect(array('action' => 'index'));
        }
    }

    public function index() {
        $this->set('title_for_layout', __('gallery', "Albums", true));

        $this->paginate = array('order' => 'Album.id DESC', 'limit' => 20);
        $this->set('albums', $this->paginate());
        $this->set('link', $this->Link->find('all', array('conditions' => array('Link.menu_id' => '6'))));
    }

    public function view($slug = null) {
        if (!$slug) {
            $this->Session->setFlash(__('gallery', 'Invalid album. Please try again.', true));
            $this->redirect(array('action' => 'index'));
        }

        $album = $this->Album->find('first', array('conditions' => array('Album.slug' => $slug), 'contain' => 'Photo'));

        if (isset($this->params['requested'])) {
            return $album;
        }

        if (!count($album)) {
            $this->Session->setFlash(__('gallery', 'Invalid album. Please try again.', true));
            $this->redirect(array('action' => 'index'));
        }

        $this->set('title_for_layout', __('gallery', "Album", true) . $album['Album']['title']);
        $this->set(compact('album'));
    }

    public function getAlbumBySlug($slug = null) {
        if (!$slug) {
            return false;
        }

        $album = $this->Album->find('first', array('conditions' => array('Album.slug' => $slug), 'contain' => 'Photo'));

        if (isset($this->params['requested'])) {
            return $album;
        }

        return false;
    }

    public function getAlbumByLocation($location = null) {
        if (!$location) {
            return false;
        }

        $albums = $this->Album->find('all', array('conditions' => array('Album.location' => $location), 'contain' => 'Photo'));

        if (isset($this->params['requested'])) {
            return $albums;
        }

        return false;
    }

}

?>