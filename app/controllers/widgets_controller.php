<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
require_once AUTH_CONTROLLER_PATH;
class WidgetsController extends AuthController {
	var $name = 'Widgets';
	var $uses = array('Widget');
    public $pages = array(1 => 'Home');    
	//use upload component.
	var $components = array('Upload');
	function index() {
		$this->Widget->recursive = 0;
		if(isset($this->data['Widget']['title'])){
			$this->paginate = array(
			'conditions' => array('Widget.title LIKE' => "%".$this->data['Widget']['title']."%"),
    		);
		}
		$this->set('widgets', $this->paginate());
        $pages = $this->pages;
        $this->set(compact('pages'));
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid widget', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('widget', $this->Widget->read(null, $id));
        $pages = $this->pages;
        $this->set(compact('pages'));
	}
	function add() {
		if (!empty($this->data)) {
			//upload image
			$this->data['Widget']['image']=$this->Upload->uploadImage($this->data['Widget']['image']);
			$this->Widget->create();
			if ($this->Widget->save($this->data)) {
				$this->Session->setFlash(__('The widget has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The widget could not be saved. Please, try again.', true));
			}
		}
		$pages = $this->pages;
		$this->set(compact('pages'));
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid widget', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image
			$this->Widget->id = $id;
			if($this->data['Widget']['image']['name']){
				$this->Upload->filesToDelete = array($this->Widget->field('image'));
				$this->data['Widget']['image']=$this->Upload->uploadImage($this->data['Widget']['image']);
			}else
				unset($this->data['Widget']['image']);
			if ($this->Widget->save($this->data)) {
				$this->Session->setFlash(__('The widget has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The widget could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Widget->read(null, $id);
		}
        $pages = $this->pages;
		$this->set(compact('pages'));
	}
	function delete($id = null) {
		$forbidden_ids = array(1, 2);
		if(in_array($id, $forbidden_ids)){
			$this->Session->setFlash(__('You cannot delete this Widget!', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for widget', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Widget->delete($id)) {
			$this->Session->setFlash(__('Widget deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Widget was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}	
	function deleteImage ($id){
		if (!$id) {
			$this->Session->setFlash(__('Invalid Widget', true));
			$this->redirect($this->referer(array('action' => 'index')));
		}
		//to delete image file
		$this->Widget->id = $id;
		$this->Upload->filesToDelete = array($this->Widget->field('image'));
		if ($this->Widget->saveField('image', '')) {
			$this->Upload->deleteFile();
			$this->Session->setFlash(__('The Widget image has been deleted', true));
		} else {
			$this->Session->setFlash(__('The Widget image could not be deleted. Please, try again.', true));
		}
		$this->redirect($this->referer(array('action' => 'index')));	
	}
}