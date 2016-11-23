<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net/
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
require_once AUTH_CONTROLLER_PATH;
class CategoriesController extends AuthController {
	var $name = 'Categories';
	var $uses = array('Category');
	//use upload component.
	var $components = array('Upload');
	function index() {
		$this->Category->recursive = 0;
		if(isset($this->data['Category']['title'])){
			$this->paginate = array(
			'conditions' => array('Category.title LIKE' => "%".$this->data['Category']['title']."%"),
    		);
		}
		$this->set('categories', $this->paginate());
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Category', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('category', $this->Category->read(null, $id));
	}
	function add() {
		if (!empty($this->data)) {
			$this->Category->create();			
			if ($this->Category->save($this->data)) {
				$this->Session->setFlash(__('The Category has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Category could not be saved. Please, try again.', true));
			}
		}
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Category', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Category->save($this->data)) {
				$this->Session->setFlash(__('The Category has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Category could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Category->read(null, $id);
		}		
	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Category', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Category->delete($id)) {
			$this->Session->setFlash(__('Category deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Category was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}