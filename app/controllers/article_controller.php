<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
class ArticleController  extends AppController {
	var $name = 'Article';
	var $uses = array('Article');	
	function index(){
		$this->redirect($this->referer($this->Session->read('Setting.url')));			
	}
	function all($tag = ''){
	    $limit = $this->getPagingLimit();
	    $conditions = array('Article.approved' => 1);
		$count = $this->Article->find('count', array(
                'conditions' => $conditions,
            )
        );
        $page_count = ceil($count / $limit);
        $this->set('pages_count', $page_count);
        
		$this->set('limit', $limit);		
		$this->set('selected','media');
		$this->set('title_for_layout' , 'News');			
	}
	function item($id = ''){
		//$limit = $this->getCommentPagingLimit();
		//$this->set('commentLimit',$limit);
		$this->Article->updateAll(array('Article.hits'=>'Article.hits+1'), array('Article.id'=>$id));
		$this->loadModel('Article');
		$article = $this->Article->find(
			'first', array(
				'conditions' => array('Article.approved' => 1, 'Article.id' => $id),
			)	  	 	
		);
		$this->set('article',$article);
		$this->set('selected','media');
		$this->set('title_for_layout' , $article['Article']['title']);	
		//get article comments
    	/*$this->Article->Comment->recursive = -1;
    	$this->paginate = array(
    		'Comment'=>array(
	    		'conditions' => array('Comment.article_id' => $article['Article']['id'], 'Comment.approved' => 1),
				'order'      => array('Comment.created'=>'DESC'),
		    	'limit'      => $limit
    		)
    	);*/	
		if(isset($article['Gal'][0]['image'])){
			$this->set('shareImage',$article['Gal'][0]['image']);
		}	    	
    	// Set data to view
		$this->set(
			array(
				//'comments'		   => $this->paginate('Comment'),
				'metaKeywords'     => $article['Article']['meta_keywords'],
				'metaDescription'  => $article['Article']['meta_description'],
			)
		);	
	}
    function list_articles(){
        $page = $_POST['page'];
        $limit = $_POST['limit'];
        $conditions = array('Article.approved' => 1);
        $this->paginate = array(
            'Article' => array(
                'conditions' => $conditions,
                'order'      => array('Article.date' => 'DESC','Article.id'=>'DESC'),
                'limit'      => $limit,
                'page'       => $page,
            )   
        );
        $articles = $this->paginate('Article');
        $count = $this->Article->find('count', array(
                'conditions' => $conditions,
            )
        );
        $page_count = ceil($count / $limit);    
        $data = '';
        if(!empty($articles)){
            $i = 0;
            foreach($articles as $article){
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = 'news_list_left_box';
                }
                $data .= $this->draw_article($article, $class);
            }
        }
        $data .= '<script type="text/javascript">
                    $(document).ready(function() {
                        jQuery(\'#loadmorearticles\').attr("pagecount", "'.$page_count.'");
                    });
                </script>'; 
        echo $data;     
        $this->autoRender = false;          
    }
    function draw_article($article, $class){
        $article_div = '';
        if(!empty($article)){
            $base_url = $this->Session->read('Setting.url');
            $article_id = $article['Article']['id']; 
            $article_link = $base_url.'/article/item/'.$article_id;
            $article_date = date('F d, Y', strtotime($article['Article']['date'])); 
            $image = '';
            $div_ratio = 432/274;
            if(isset($article['Gal'])){
                $this->mainSmartResizeImage($article['Gal'][0]['image']);
                $image = $base_url.'/img/upload/'.$article['Gal'][0]['image'];
                $image_path = WWW_ROOT.'img'.DS.'upload'.DS.$article['Gal'][0]['image'];                      
                $max_height = 'max-height:100%;';
                $max_width  = 'max-width:100%;';
                $style = $max_width;
				$image_size = array();
				if(file_exists($image_path)){   
	            	$image_size = getimagesize($image_path);          
				}else{
					$image = DEFAULT_IMAGE;
					$style = 'width:100%;';
				} 
                if(!empty($image_size)){
                    $width = $image_size[0];
                    $height = $image_size[1];   
                    $image_ratio = $width/$height;
                    if($image_ratio > $div_ratio){                  
                        $style = $max_height;
                    }
                }
            }
            $body = '';
            $body = $article['Article']['body'];
            //$body = $this->remove_unneeded_tags_from_string($body);
            $body = $this->string_format_view($body, 'wordsCut', 30);
            $article_div .= '<div class="news_groub '.$class.'">
                            <div class="adders_news"><a href="'.$article_link.'">'.$article['Article']['title'].'</a></div>
                            <div class="date_big">
                            <div class="date">
                                <a><img src="'.$base_url.'/img/front/data.png"/></a>
                            </div>
                            <div class="date_witer">'.$article_date.'</div>
                            </div>
                            <div class="news_groub_img">
                            <a href="'.$article_link.'">
                            <img style="'.$style.'" src="'.$image.'"/></a></div>
                            <div class="data_smill" style="float:left;">'.$body.'</div>
                            <div class="data_reed"><a href="'.$article_link.'">Read More ></a></div>
                            </div>';
        }
        return $article_div;
    }
    //add comment used by ajax
    /*function addComment(){
        $this->Article->Comment->create();
        if ($this->Article->Comment->save($this->data)) {
            echo __('Your comment has been added successfully, and will be viewed soon after approving.', true);
        } else {
            echo __('Your comment could not be added.', true);
            echo '<br />';
            foreach($this->Article->Comment->validationErrors as $key=>$val){
                echo $val.',<br />';
            }
            echo 'and try again.';
        }
        $this->autoRender = false;
    }*/
}