<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class CatsController extends AuthController {
	var $name = 'Cats';
	var $uses = array('Cat');
	//use upload component.
	var $components = array('Upload');
	function index() {
	    $conditions = array();
		$this->Cat->recursive = 0;   
        $title = '';     
        if(isset($_REQUEST['title']) && trim($_REQUEST['title']) != ''){
            $title = $_REQUEST['title'];
		    $conditions['Cat.title LIKE'] = "%".$title."%";
		}
        $parent_id_get = 0;
        if(isset($_REQUEST['parent_id']) && $_REQUEST['parent_id'] != 0){
            $parent_id_get = $_REQUEST['parent_id'];
            $conditions['Cat.parent_id'] = $parent_id_get;            
        }
        if(!empty($conditions)){
            $this->paginate = array('conditions' => $conditions);
        }
		$this->set('cats', $this->paginate());
        $parents_data = $this->Cat->find('all', array('conditions' => array('Cat.parent_id != ' => 0)));
        $parents = array(0 => 'All');
        foreach ($parents_data as $key => $value) {
            $parent_id = $value['Cat']['parent_id'];
            if(!in_array($parent_id, $parents)){
                $parents[$parent_id] = $value['ParentCat']['title'];
            }            
        }
        ksort($parents);
        $this->set(compact('parents'));
        $this->set('parent_id', $parent_id_get);
        $this->set('title', $title);
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Category', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('cat', $this->Cat->read(null, $id));
	}
	function add() {
		if (!empty($this->data)) {
			//upload image
			$this->data['Cat']['image'] = $this->Upload->uploadImage($this->data['Cat']['image']);
            if($this->data['Cat']['pdf_file']){
                $this->Upload->fileTypes = 'pdf';//set file types.
                $this->data['Cat']['pdf_file'] = $this->Upload->uploadFile($this->data['Cat']['pdf_file']);
            }else{
                unset($this->data['Cat']['pdf_file']); 
            }
			$this->Cat->create();
			if ($this->Cat->save($this->data)) {
				$this->Session->setFlash(__('The Category has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Category could not be saved. Please, try again.', true));
			}
		}
		$parents = $this->Cat->ParentCat->find('list');
		$this->set(compact('parents'));
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Category', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//upload image
			$this->Cat->id = $id;
			if($this->data['Cat']['image']['name']){
				$this->Upload->filesToDelete = array($this->Cat->field('image'));
				$this->data['Cat']['image']=$this->Upload->uploadImage($this->data['Cat']['image']);
			}else{
				unset($this->data['Cat']['image']);
			}
            if($this->data['Cat']['pdf_file']){
                $this->Upload->fileTypes = 'pdf';//set file types.
                $this->data['Cat']['pdf_file'] = $this->Upload->uploadFile($this->data['Cat']['pdf_file']);
            }else{
                unset($this->data['Cat']['pdf_file']); 
            }            
			if ($this->Cat->save($this->data)) {
				$this->Session->setFlash(__('The Category has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Category could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Cat->read(null, $id);
		}
		$parents = $this->Cat->ParentCat->find('list',array('conditions'=>array('ParentCat.id <>'=>$id)));
		$this->set(compact('parents'));
	}
	function delete($id = null) {
		//$forbidden_ids = array();
		//if(in_array($id, $forbidden_ids)){
	    if($id <= 36){
			$this->Session->setFlash(__('You cannot delete this Category!', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Category', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Cat->delete($id)) {
			$this->Session->setFlash(__('Category deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Cat was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function deleteImage ($id){
		if (!$id) {
			$this->Session->setFlash(__('Invalid Category', true));
			$this->redirect($this->referer(array('action' => 'index')));
		}
		//to delete image file
		$this->Cat->id = $id;
		$this->Upload->filesToDelete = array($this->Cat->field('image'));
		if ($this->Cat->saveField('image', '')) {
			$this->Upload->deleteFile();
			$this->Session->setFlash(__('The Category image has been deleted', true));
		} else {
			$this->Session->setFlash(__('The Category image could not be deleted. Please, try again.', true));
		}
		$this->redirect($this->referer(array('action' => 'index')));	
	}
    function deleteFile($id){
        if (!$id) {
            $this->Session->setFlash(__('Invalid Category', true));
            $this->redirect($this->referer(array('action' => 'index')));
        }
        //to delete pdf file
        $this->Cat->id = $id;
        $this->Upload->filesToDelete = array($this->Cat->field('pdf_file'));
        if ($this->Cat->saveField('pdf_file', '')) {
            $this->Upload->deleteFile();
            $this->Session->setFlash(__('The Category pdf has been deleted', true));
        } else {
            $this->Session->setFlash(__('The Category pdf could not be deleted. Please, try again.', true));
        }
        $this->redirect($this->referer(array('action' => 'index')));
    }
}