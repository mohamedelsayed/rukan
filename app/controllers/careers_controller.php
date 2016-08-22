<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class CareersController extends AuthController {
	var $name = 'Careers';
	var $uses = array('Career');
	//use upload component.
	var $components = array('Upload');
    var $titleLabel = 'Postion Title';
	function index() {
		$this->Career->recursive = 0;
		if(isset($this->data['Career']['title'])){
			$this->paginate = array(
			'conditions' => array('Career.title LIKE' => "%".$this->data['Career']['title']."%"),
    		);
		}
		$this->set('careers', $this->paginate());     
        $this->set('titleLabel', $this->titleLabel);   
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid career', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('career', $this->Career->read(null, $id));
        $this->set('titleLabel', $this->titleLabel);
	}
	function add() {
		if (!empty($this->data)) {
			$this->Career->create();
			if ($this->Career->save($this->data)) {
				$this->Session->setFlash(__('The career has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The career could not be saved. Please, try again.', true));
			}
		}
        $this->set('titleLabel', $this->titleLabel);
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid career', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image
			$this->Career->id = $id;		
			if ($this->Career->save($this->data)) {
				$this->Session->setFlash(__('The career has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The career could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Career->read(null, $id);
		}
        $this->set('titleLabel', $this->titleLabel);
	}
	function delete($id = null) {
		$forbidden_ids = array();
		if(in_array($id, $forbidden_ids)){
			$this->Session->setFlash(__('You cannot delete this Career!', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for career', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Career->delete($id)) {
			$this->Session->setFlash(__('Career deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Career was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}		
}