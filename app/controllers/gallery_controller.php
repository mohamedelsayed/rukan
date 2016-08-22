<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
class GalleryController  extends AppController {
	var $name = 'Gallery';
	var $uses = array('Album');	
    //var $limit = 9;
	function index(){
		$this->redirect($this->referer(BASE_URL));			
	}
	function all($tag = ''){
	    $limit = $this->getGalleryPagingLimit();
	    //$limit = $this->limit;
	    $conditions = array('Album.approved' => 1);
		$count = $this->Album->find('count', array(
                'conditions' => $conditions,
            )
        );
        $page_count = ceil($count / $limit);
        $this->set('pages_count', $page_count);        
		$this->set('limit', $limit);		
		$this->set('selected','media');
		$this->set('title_for_layout' , 'Gallery');			
	}
	function item($id = ''){
		$this->loadModel('Album');
		$album = $this->Album->find(
			'first', array(
				'conditions' => array('Album.approved' => 1, 'Album.id' => $id),
			)	  	 	
		);
		$this->set('album',$album);
		$this->set('selected','media');
		$this->set('title_for_layout' , strip_tags($album['Album']['title']));	
		if(isset($album['Gal'][0]['image'])){
			$this->set('shareImage',$album['Gal'][0]['image']);
		}	    	
		$this->set(
			array(		
				'metaKeywords'     => $album['Album']['meta_keywords'],
				'metaDescription'  => $album['Album']['meta_description'],
			)
		);	
	}
    function list_albums(){
        $page = $_POST['page'];
        $limit = $_POST['limit'];
        $conditions = array('Album.approved' => 1);
        $this->paginate = array(
            'Album' => array(
                'conditions' => $conditions,
                'order'      => array('Album.id'=>'DESC'),
                'limit'      => $limit,
                'page'       => $page,
            )   
        );
        $albums = $this->paginate('Album');
        $count = $this->Album->find('count', array(
                'conditions' => $conditions,
            )
        );
        $page_count = ceil($count / $limit);    
        $data = '';
        if(!empty($albums)){
            $i = 0;
            foreach($albums as $album){
                $class = null;
                if ($i++ % 3 == 0) {
                    $class = 'img_gallery_left';
                }
                $data .= $this->draw_album($album, $class);
            }
        }
        $data .= '<script type="text/javascript">
                    $(document).ready(function() {
                        jQuery(\'#loadmorealbums\').attr("pagecount", "'.$page_count.'");
                    });
                </script>'; 
        echo $data;     
        $this->autoRender = false;          
    }
    function draw_album($album, $class){
        $album_div = '';
        if(!empty($album)){
            $base_url = BASE_URL;
            $album_id = $album['Album']['id']; 
            $album_link = $base_url.'/gallery/item/'.$album_id;            
            $image = '';
            $div_ratio = 264/177;
            if(isset($album['Gal'][0]['image'])){
                $this->mainSmartResizeImage($album['Gal'][0]['image']);
                $image = $base_url.'/img/upload/'.$album['Gal'][0]['image'];
                $image_path = WWW_ROOT.'img'.DS.'upload'.DS.$album['Gal'][0]['image'];    
                $image_size = getimagesize($image_path);          
                $max_height = 'max-height:100%;';
                $max_width  = 'max-width:100%;';
                $style = $max_width;
                if(!empty($image_size)){
                    $width = $image_size[0];
                    $height = $image_size[1];   
                    $image_ratio = $width/$height;
                    if($image_ratio > $div_ratio){                  
                        $style = $max_height;
                    }
                }            
                $album_div .= '<div class="img_gallery img_gallery_listing '.$class.'">
                            <a href="'.$album_link.'">
                            <img style="'.$style.'" src="'.$image.'"/>
                            </a>
                            <div class="img_gallery_write gallary_title_in">'.strip_tags($album['Album']['title']).'</div>
                            </div>';
            }
        }
        return $album_div;
    }
}