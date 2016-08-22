<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class AlbumsController extends AuthController {
	var $name = 'Albums';
	var $uses = array('Album');
	//use upload component.
	var $components = array('Upload');	
	function index() {
    	$this->Album->recursive = 0;
        if(isset($this->data['Album']['title'])){
            $this->paginate = array(
                'conditions' => array('Album.title LIKE' => "%".$this->data['Album']['title']."%"),
                'order'      => array('Album.id'=>'DESC')
            );
        }else{
        	$this->paginate = array(    			
    			'order'      => array('Album.id'=>'DESC')
        	);
        }		
		$this->set('albums', $this->paginate());
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Album', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('album', $this->Album->read(null, $id));
	}
	function add() {
		if (!empty($this->data)) {
		    $post_data = $_POST;
		    unset($this->data['images']);
		    /*if(!empty($this->data['images'])){
                $images = $this->data['images'];
                foreach ($images as $key => $value) {
                    $this->data['Gal'][$key]['image'] = $this->Upload->uploadImage($value); 
                    $this->data['Gal'][$key]['caption'] = $this->data['Gal'][0]['caption'];                     
                }                
                unset($this->data['images']);
            }else{
                unset($this->data['images']);
            }*/
			//upload image and then add it to Gal.
			//$this->data['Gal'][0]['image']=$this->Upload->uploadImage($this->data['Gal'][0]['image']);
			//if($this->data['Gal'][0]['image']=='')unset($this->data['Gal']);	
			/*$this->Upload->fileTypes = 'mp3';//set file types.
			$this->data['Audio'][0]['file'] = $this->Upload->uploadFile($this->data['Audio'][0]['file']);
			if($this->data['Audio'][0]['file'] =='' ) unset($this->data['Audio']);			
			//upload image and video file then add them to Videos.
			$this->data['Video'][0]['image']=$this->Upload->uploadImage($this->data['Video'][0]['image']);
			$this->Upload->fileTypes = 'flv';//set file types.
			$this->data['Video'][0]['file']=$this->Upload->uploadFile($this->data['Video'][0]['file']);
			if($this->data['Video'][0]['file']=='' && $this->data['Video'][0]['url']=='')unset($this->data['Video']);*/
			//save data
			$this->Album->create();
			if ($this->Album->saveAll($this->data, array('validate'=>'first'))) {
			    $this->save_images($post_data, $this->Album->id);				
				//set flash
				$this->Session->setFlash(__('The Album has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Album could not be saved. Please, try again.', true));
			}
		}
		//$sections = $this->Album->Section->find('list');
		//$issues = $this->Album->Issue->find('list',array('order'  => array('Issue.date'=>'DESC','Issue.status' => 'ASC')));
		//$this->set(compact('sections', 'issues'));
		$images_div = '';
        $this->set('images_div', $images_div);
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Album', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		    $post_data = $_POST;
		    unset($this->data['images']);		    
		    /*if(!empty($this->data['images'])){
                $images = $this->data['images'];
                foreach ($images as $key => $value) {
                    $this->data['Gal'][$key]['image'] = $this->Upload->uploadImage($value); 
                    $this->data['Gal'][$key]['caption'] = $this->data['Gal'][0]['caption'];                     
                }                
                unset($this->data['images']);
            }else{
                unset($this->data['images']);
            }*/
			//upload image and then add it to Gal.
			//pr($this->data['images']);exit;
			//$this->data['Gal'][0]['image']=$this->Upload->uploadImage($this->data['Gal'][0]['image']); 
			//if($this->data['Gal'][0]['image']=='')unset($this->data['Gal']);            
			/*$this->Upload->fileTypes = 'mp3';//set file types.
			$this->data['Audio'][0]['file'] = $this->Upload->uploadFile($this->data['Audio'][0]['file']);
			if($this->data['Audio'][0]['file'] =='' ) unset($this->data['Audio']);
			//upload image and video file then add them to Videos.
			$this->data['Video'][0]['image']=$this->Upload->uploadImage($this->data['Video'][0]['image']);
			$this->Upload->fileTypes = 'flv';//set file types.
			$this->data['Video'][0]['file']=$this->Upload->uploadFile($this->data['Video'][0]['file']);
			if($this->data['Video'][0]['file']=='' && $this->data['Video'][0]['url']=='')unset($this->data['Video']);*/				
			//save data
			if ($this->Album->saveAll($this->data, array('validate'=>'first'))) {
			    $this->save_images($post_data, $this->data['Album']['id']); 
				//set flash
				$this->Session->setFlash(__('The Album has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Album could not be saved. Please, try again.', true));
			}
		}
		//hold validation erros then load it again aftre reading data.
		$holdErrors = $this->Album->validationErrors;
        $album = $this->Album->read(null, $id);
		$this->data = $album;
		$this->Album->validationErrors = $holdErrors;		
		//$sections = $this->Album->Section->find('list');
		//$issues = $this->Album->Issue->find('list',array('order'  => array('Issue.date'=>'DESC','Issue.status' => 'ASC')));
		//$this->set(compact('sections', 'issues'));
		$images_div = '';
        if(!empty($album['Gal'])){
            foreach ($album['Gal'] as $key => $value) {
                $this->mainSmartResizeImage($value['image']);
                $images_div .= $this->draw_image_box($value['id'], DS.'img'.DS.'upload'.DS.$value['image'], $value['cover'], $value['caption']);
            }
        }
        $this->set('images_div', $images_div);
	}	
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Album', true));
			$this->redirect(array('action'=>'index'));
		}
		//set the component var filesToDelete with an array of files should be deleted.
		$relatedImgs    = $this->Album->Gal->find('list', array('fields'=>'Gal.image' ,'conditions' => array('album_id' => $id)));
		//$relatedVids    = $this->Album->Video->find('list', array('fields'=>'Video.file' ,'conditions' => array('album_id' => $id)));
		//$relatedThumb   = $this->Album->Video->find('list', array('fields'=>'Video.image' ,'conditions' => array('album_id' => $id)));					  	 					   
		//$this->Upload->filesToDelete = array_merge($relatedVids, $relatedThumb);
        $this->Upload->filesToDelete = array_merge($relatedImgs);		
		//delete
		if ($this->Album->delete($id)) {
			$this->Upload->deleteFile(); //delete old files.			
			//set flash
			$this->Session->setFlash(__('Album deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Album was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}	
    function save_images($data, $id = 0){
        if(!empty($data) && $id != 0){
            $cover = 0;
            if(isset($data['img_cover'])){
                $cover = $data['img_cover'];
            }
            $album = $this->Album->read(null, $id);
            $gals = $album['Gal'];
            $this->loadModel('Gal');
            $old_imgs = array();
            $new_imgs =  array();
            if(!empty($gals)){
                foreach ($gals as $key => $gal) {
                    $old_imgs[] = $gal['id'];
                }
            }
            $new_imgs = array_keys($data['img_path']);
            $intersect = array_intersect($new_imgs, $old_imgs);
            $to_add = array_diff($new_imgs, $intersect);
            $to_delete = array_diff($old_imgs, $intersect);
            $i = 0;
            foreach ($data['img_path'] as $key => $value) {
                $cover_val = 0;
                $path = '';
                $caption = '';
                if($cover != 0){
                    if($cover == $key){
                        $cover_val = 1;
                    }  
                }else{
                    if($i == 0){
                        $cover = $key;                        
                        $i++;
                    }                    
                }
                if(isset($data['img_caption'][$key])){
                    $caption = $data['img_caption'][$key];
                }               
                if($value != ''){
                    $path = str_replace(DS.'img'.DS.'upload', '', $value);              
                }
                if(trim($path) != ''){
                    if(in_array($key, $to_add)){
                        $sql = "INSERT INTO `gals` (
                            `id` ,
                            `caption` ,
                            `image` ,
                            `node_id` ,
                            `content_id` ,
                            `position` ,
                            `article_id` ,
                            `album_id` ,
                            `cover`
                            )
                            VALUES (
                            NULL , '".$caption."', '".$path."', '0', '0', '0', '0', '".$id."', '".$cover_val."');";
                        $temp = $this->Album->query($sql);
                    }elseif(in_array($key, $intersect)){
                        $sql = "UPDATE `gals` SET `caption` = '".$caption."',
                            `cover` = '".$cover_val."' WHERE `id` =".$key;
                        $temp = $this->Album->query($sql);
                    }                    
                }                
            }  
            if(!empty($to_delete)){
                foreach ($to_delete as $key => $value) {
                    $this->Gal->delete($value);                                        
                }
            }          
        }        
    }	
}