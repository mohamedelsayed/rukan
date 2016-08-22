<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class AcademicsController extends AuthController {
	var $name = 'Academics';
	var $uses = array('Academic');
    public $pages = array(1 => 'Home', 2 => 'In page');    
	//use upload component.
	var $components = array('Upload');
	function index() {
		$this->Academic->recursive = 0;
		if(isset($this->data['Academic']['title'])){
			$this->paginate = array(
			'conditions' => array('Academic.title LIKE' => "%".$this->data['Academic']['title']."%"),
    		);
		}
		$this->set('academics', $this->paginate());
        $pages = $this->pages;
        $this->set(compact('pages'));
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid academic', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('academic', $this->Academic->read(null, $id));
        $pages = $this->pages;
        $this->set(compact('pages'));
	}
	function add() {
		if (!empty($this->data)) {
			//upload image
			$this->data['Academic']['image']=$this->Upload->uploadImage($this->data['Academic']['image']);
			$this->Academic->create();
			if ($this->Academic->save($this->data)) {
				$this->Session->setFlash(__('The academic has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The academic could not be saved. Please, try again.', true));
			}
		}
		$pages = $this->pages;
		$this->set(compact('pages'));
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid academic', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image
			$this->Academic->id = $id;
			if($this->data['Academic']['image']['name']){
				$this->Upload->filesToDelete = array($this->Academic->field('image'));
				$this->data['Academic']['image']=$this->Upload->uploadImage($this->data['Academic']['image']);
			}else
				unset($this->data['Academic']['image']);
			if ($this->Academic->save($this->data)) {
				$this->Session->setFlash(__('The academic has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The academic could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Academic->read(null, $id);
		}
        $pages = $this->pages;
		$this->set(compact('pages'));
	}
	function delete($id = null) {
		$forbidden_ids = array();
		if(in_array($id, $forbidden_ids)){
			$this->Session->setFlash(__('You cannot delete this Academic!', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for academic', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Academic->delete($id)) {
			$this->Session->setFlash(__('Academic deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Academic was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}	
	function deleteImage ($id){
		if (!$id) {
			$this->Session->setFlash(__('Invalid Academic', true));
			$this->redirect($this->referer(array('action' => 'index')));
		}
		//to delete image file
		$this->Academic->id = $id;
		$this->Upload->filesToDelete = array($this->Academic->field('image'));
		if ($this->Academic->saveField('image', '')) {
			$this->Upload->deleteFile();
			$this->Session->setFlash(__('The Academic image has been deleted', true));
		} else {
			$this->Session->setFlash(__('The Academic image could not be deleted. Please, try again.', true));
		}
		$this->redirect($this->referer(array('action' => 'index')));	
	}
}