<?php
require_once AUTH_CONTROLLER_PATH;
class AudiosController extends AuthController {

	var $name = 'Audios';
	var $uses = array('Audio');
	//use upload component.
	var $components = array('Upload');

	function deleteAudio($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for video', true));
			$this->redirect($this->referer(array('controller'=>'admin/index')));
		}
		//Redirect if the user wrote the url by hand.
		$urlArr = explode('/', $this->referer());
		if( ($this->referer()=='/') || ($urlArr[2]!='edit') ){
			$this->Session->setFlash(__('Image was not deleted. Plz click the right link', true));
			$this->redirect(array('controller'=>'admin/index'));
		}
		//set the component var filesToDelete with an array of files should be deleted.
		$this->Audio->id = $id;
		$this->Upload->filesToDelete = array($this->Audio->field('file'));
		if ($this->Audio->delete($id)) {
			$this->Upload->deleteFile(); //delete old files.
			$this->Session->setFlash(__('Audio deleted', true));
			$this->redirect($this->referer(array('controller'=>'admin/index')));
		}
		$this->Session->setFlash(__('Audio was not deleted', true));
		$this->redirect($this->referer(array('controller'=>'admin/index')));
	}

}
?>