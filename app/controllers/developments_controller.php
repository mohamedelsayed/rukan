<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
require_once AUTH_CONTROLLER_PATH;
class DevelopmentsController extends AuthController {
	var $name = 'Developments';
	var $uses = array('Development');
	//use upload component.
	var $components = array('Upload');
	function index() {
		$this->Development->recursive = 0;
		if(isset($this->data['Development']['title'])){
			$this->paginate = array(
			'conditions' => array('Development.title LIKE' => "%".$this->data['Development']['title']."%"),
    		);
		}
		$this->set('developments', $this->paginate());       
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid development', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('development', $this->Development->read(null, $id));
	}
	function add() {
		if (!empty($this->data)) {
			//upload image
			$this->data['Development']['image']=$this->Upload->uploadImage($this->data['Development']['image']);
			$this->Development->create();
			if ($this->Development->save($this->data)) {
				$this->Session->setFlash(__('The development has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The development could not be saved. Please, try again.', true));
			}
		}
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid development', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image
			$this->Development->id = $id;
			if($this->data['Development']['image']['name']){
				$this->Upload->filesToDelete = array($this->Development->field('image'));
				$this->data['Development']['image']=$this->Upload->uploadImage($this->data['Development']['image']);
			}else
				unset($this->data['Development']['image']);
			if ($this->Development->save($this->data)) {
				$this->Session->setFlash(__('The development has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The development could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Development->read(null, $id);
		}
	}
	function delete($id = null) {
		$forbidden_ids = array();
		if(in_array($id, $forbidden_ids)){
			$this->Session->setFlash(__('You cannot delete this Development!', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for development', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Development->delete($id)) {
			$this->Session->setFlash(__('Development deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Development was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}	
	function deleteImage ($id){
		if (!$id) {
			$this->Session->setFlash(__('Invalid Development', true));
			$this->redirect($this->referer(array('action' => 'index')));
		}
		//to delete image file
		$this->Development->id = $id;
		$this->Upload->filesToDelete = array($this->Development->field('image'));
		if ($this->Development->saveField('image', '')) {
			$this->Upload->deleteFile();
			$this->Session->setFlash(__('The Development image has been deleted', true));
		} else {
			$this->Session->setFlash(__('The Development image could not be deleted. Please, try again.', true));
		}
		$this->redirect($this->referer(array('action' => 'index')));	
	}
}