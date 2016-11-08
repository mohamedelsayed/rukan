<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
require_once 'elsayed_db.php';
class AppController extends Controller {
	public $helpers = array('Html', 'Form', 'Javascript', 'Ajax', 'Session', 'Lang', 'Resize');
	public $components = array('Session', 'Cookie', 'Email', 'Upload');
	public $settings;	
	public $clearProSession = true;
    public $lang = 'en';
    public $google_api_key = 'AIzaSyDGGlo0fNATzYKU761Fx-8VAIJDXu-b3QM';
	function beforeFilter() {
	    if(isset($this->params['language'])){
	        $this->lang = $this->params['language'];
        }	            
        if($this->lang == 'ar'){
            Configure::write('Config.language', 'ara');
        }else{
             Configure::write('Config.language', 'eng');
        }
		//write settings in session
		if(!$this->Session->check('Setting')){
			$this->setSettings();
		}
		$this->checkMaintenanceMode();
		//Set Cookie	
		$this->setCookie();
		//Set Header Quotes
		//$this->setHeaderQuotes();
		//$this->setAllArticlesTags();
		//$this->setRecentArticles();
		//$this->setParentCat();
	}	
	function beforeRender(){
		if($this->name == 'CakeError'){
			$page_not_found_text = 'Page Not Found';	
			$this->set('title_for_layout' , $page_not_found_text);
			$this->set('page_not_found_text', $page_not_found_text);
		}
		$this->setHeaderQuotes();
		$this->setAllArticlesTags();
		$this->setRecentArticles();
		$this->setParentCat();
		if($this->layout != 'ajax'){
			$this->layout = 'front/main';
        }
        $this->loadModel('Setting');
        $setting = $this->Setting->read(null, 1);
        $this->set('base_url', BASE_URL);
        $this->set('site_lang', $this->lang);
        $this->set('setting', $setting['Setting']);
        $this->loadModel('Setting');
        $settings = $this->Setting->read(null, 1);
        $this->set("minYearValue",$settings['Setting']['minimum_year']);
        $this->set("maxYearValue",$settings['Setting']['maximum_year']);
        $this->set('google_api_key', $this->google_api_key);
	}	
	function afterFilter(){
		//$this->Session->write('dontPopup', true);
	}	
	function setSettings(){
		$this->loadModel('Setting');
        $setting = $this->Setting->read(null, 1);
        $this->Session->write($setting);
	}
	function getPagingLimit(){
		$this->loadModel('Setting');
		$settings = $this->Setting->read(null, 1);
		return $settings['Setting']['paging_limit'];
	}
	function getCommentPagingLimit(){
		$this->loadModel('Setting');
		$settings = $this->Setting->read(null, 1);
		return $settings['Setting']['comment_paging_limit'];
	}	
	protected function setCookie(){
		//Set Cookie	
		$this->Cookie->name = 'ethos';
		$this->Cookie->key = '#MaT7sssssccesaAmOOR*';
		$this->Cookie->time = 3600; // or '1 hour'
	}	
	protected function setHeaderQuotes(){
		$this->loadModel('Content');
		$contact_us = $this->Content->read(null, 1);
		$this->set('header_contact_us_title',$contact_us['Content']['title']);	
		$this->loadModel('Quote');
		$quote = $this->Quote->find(
			'first', array(
				'conditions' => array('Quote.approved' => 1),
				'order' => 'RAND()',
			)	  	 	
		);
		$this->set('quote',$quote);		
	}	
	// clean Title
	function cleanTitle($title = null){		
    	if(!$title)
    		return '';
		return Inflector::slug(strtolower($title), '-');
		//return Inflector::slug($artistName, '');
    }
	/**
	 * @author Author "Mohamed Elsayed"  
	 * @author Author Email "me@mohamedelsayed.net"
	 * @copyright Copyright (c) 2014 Programming by "mohamedelsayed.net"
	 * this function was created to send newsletter on Shared Hosting that send 500 mail/hour
	 * so if you send all mails one time it will not work
	 * so I make it send limit mails (by set it from Settings) at one time & call it by Cron jobs every hour 
	 */
	function send_newsletter($key = null){
		if($key == 'hr3w2a4t1515s23w6pae'){
			$this->autoRender = false;				
			$this->loadModel('Setting');
			$settings = $this->Setting->read(null, 1);
			$limit = $settings['Setting']['newsletter_limit'];		
			$tempDomain = explode("/", $settings['Setting']['url']);		
			$currentDomain = $tempDomain[0]."//".$tempDomain[2]."/app/webroot/";
			$this->set('currentDomain', $currentDomain);
			$this->loadModel('Queue');
			$this->loadModel('Subscriber');
			$this->Subscriber->recursive = -1;
			$newsletter_sending = array();
			//get current newsletter
			$newsletter_sending = $this->Queue->find('first', array('conditions' => array('Queue.status' => 1)));
			if(empty($newsletter_sending)){
				$newsletter_pending = $this->Queue->find('first', array('conditions' => array('Queue.status' => 0),'order'=>array('Queue.id'=>'ASC')));
				if(!empty($newsletter_pending)){
					$this->Queue->updateAll(array('Queue.status' => 1), array('Queue.id'=>$newsletter_pending['Queue']['id']));
					if($newsletter_pending['Newsletter']['user_id'] != 0)
					$this->Subscriber->updateAll(array('Subscriber.sent' => 0), array('Subscriber.user_id'=>$newsletter_pending['Newsletter']['user_id']));
					else
					$this->Subscriber->updateAll(array('Subscriber.sent' => 0));					
					$newsletter_sending = $newsletter_pending;
				}			
			}		
			if(!empty($newsletter_sending)){			
				if($newsletter_sending['Newsletter']['user_id'] != 0){
					$subscribers = $this->Subscriber->find(
						'all', 
						array(
							'fields'     => array('Subscriber.id','Subscriber.email'),
							'conditions' => array('Subscriber.user_id' => $newsletter_sending['Newsletter']['user_id'],'Subscriber.sent' => 0),
				  	 		'order'      => array('Subscriber.id'=>'DESC'),
							'limit'      => $limit
				  	 	)
				  	);
				}
				else{
					$subscribers = $this->Subscriber->find(
						'all', 
						array(
							'fields'     => array('Subscriber.id','Subscriber.email'),
							'conditions' => array('Subscriber.sent' => 0),
				  	 		'order'      => array('Subscriber.id'=>'DESC'),
							'limit'      => $limit
				  	 	)
				  	);
				}
				if(empty($subscribers)){
					$this->Queue->updateAll(array('Queue.status' => 2), array('Queue.id'=>$newsletter_sending['Queue']['id']));
				}else{
					foreach($subscribers as $subscriber){
						$this->Email->reset();
						$this->Email->to = $subscriber['Subscriber']['email'];
						$this->Email->subject = $newsletter_sending['Newsletter']['subject'];
						$this->Email->replyTo = $newsletter_sending['Newsletter']['from_email'];
						$this->Email->return = $settings['Setting']['return_path_email'];
						$this->Email->additionalParams = '-f'.$settings['Setting']['return_path_email'];					
						$this->Email->from = $newsletter_sending['Newsletter']['from_name'].' <'.$newsletter_sending['Newsletter']['from_email'].'>';
						$this->Email->sendAs = 'html';
						$this->Email->template = 'newsletter';
						$newsletter_body = str_replace("/app/webroot/", $currentDomain, $newsletter_sending['Newsletter']['body']);
						$this->set('newsletter', $newsletter_body);
						//$this->set('signature', $settings['Setting']['signature']);
						if ($this->Email->send()) {
							$this->Subscriber->updateAll(array('Subscriber.sent' => 1), array('Subscriber.id' => $subscriber['Subscriber']['id']));
							echo 'The newsletter has been sent to '.$subscriber['Subscriber']['email'].'.<br/>';			
						}else{
							echo 'There was a problem sending The newsletter. Please try again<br/>';
						}
					}
					$this->autoRender = false;		
				}
			}
		}else {
			echo 'Wrong key!';
			$this->autoRender = false;	
		}
	}	
	// get All Articles Tags
	function setAllArticlesTags(){
		$all_tags = array();
		$this->loadModel('Article');
		$articles = $this->Article->find(
			'all', array(
				'fields'     => array('Article.id', 'Article.tags'),
				'conditions' => array('Article.approved' => 1),
				'order' => array('Article.date' => 'DESC','Article.id'=>'DESC')
			)	  	 	
		);
		foreach ($articles as $key => $article) {
			$tags = explode(",", $article['Article']['tags']);
			foreach ($tags as $key => $tag) {
				$tag = trim($tag);
				if($tag != ''){
					if(!in_array($tag, $all_tags)){
						$all_tags[] = $tag;
					}
				}
			}		
		}	
		$this->set('all_tags',$all_tags);	
	}
	// get Recent Articles 
	function setRecentArticles(){
		$this->loadModel('Article');
		$articles = $this->Article->find(
			'all', array(
				//'fields'     => array('Article.id', 'Article.tags'),
				'conditions' => array('Article.approved' => 1),
				'order' => array('Article.date' => 'DESC','Article.id'=>'DESC'),
				'limit' => 3
			)	  	 	
		);	
		$this->set('recent_articles',$articles);	
	}
	function setParentCat(){
		$this->loadModel('Cat');
		$cats = $this->Cat->find(
			'all', array(
				//'fields'     => array('Article.id', 'Article.tags'),
				'conditions' => array('Cat.approved' => 1, 'Cat.parent_id' => null),
				'order' => array('Cat.weight' => 'ASC','Cat.id'=>'DESC'),
				'limit' => 10
			)	  	 	
		);	
		$this->set('header_cats',$cats);		
	}
	function checkMaintenanceMode(){
		$front_controllers_list = array('Home','Page', 'Article', 'Faq', 'Texts');
		if(!$this->isAuthentic()){
			if(in_array($this->name, $front_controllers_list)){
				$this->loadModel('Setting');
				$settings = $this->Setting->read(null, 1);				
				$maintenance_mode = $settings['Setting']['maintenance_mode'];
				if($maintenance_mode == 1 && $this->action != 'maintenancemode'){
					$this->redirect(BASE_URL.'/maintenance');
				}		
			}
		}
	}
	//Check Authentication.
	protected function isAuthentic(){
		if($this->Session->check('userInfo')){
			//check if data in session (userInfo) existing in database.
			if($this->inDataBase()){
				//write settings in session and return
				if(!$this->Session->check('Setting'))
					$this->setSettings();
				return true;
			}else{
				$this->Session->destroy();
				return false;
			}
		}else
			return false;
	}
	//Check that session user in database.
	protected function inDataBase (){
		$this->loadModel('User');
		$this->User->recursive = -1;
		return $this->User->find('count', 
							  	  array('conditions' =>
								   	   array('username' => $this->Session->read('userInfo.User.username'),
								   	 	     'password' => $this->Session->read('userInfo.User.password'))));
	}
    function getGalleryPagingLimit(){
        $this->loadModel('Setting');
        $settings = $this->Setting->read(null, 1);
        return $settings['Setting']['gallary_paging_limit'];
    }
    function getCareersPagingLimit(){
        $this->loadModel('Setting');
        $settings = $this->Setting->read(null, 1);
        return $settings['Setting']['carrers_paging_limit'];
    }
    function getDevelopmentsPagingLimit(){
        $this->loadModel('Setting');
        $settings = $this->Setting->read(null, 1);
        return $settings['Setting']['carrers_developments_paging_limit'];
    }
    function remove_unneeded_tags_from_string($string = ''){
        $new_string = trim(trim($string, '<p>'), '</p>');
        return $new_string;          
    }
    function string_format_view($str = '', $type = '', $val = 0){
        if($type == 'wordsCut'){
            $str_without_tags = strip_tags($str);
            $strArr = split(" ", $str_without_tags);
            if(count($strArr) > $val){
                $data = '';
                for($index=0; $index<$val; $index++){
                    $data .= $strArr[$index].' ';
                }
                $data .= '...';
                return $data;
            }else{
                return $str;
            }
        }else{ 
            return $str;            
        }
    }
    function get_realated_event_agenda($id = 0, $title = ''){
        $agenda_final = '';
        $this->loadModel('Event');
        $title = trim($title);
        if($title != ''){
            $events = $this->Event->find('all', array(
                'conditions' => array(
                    'Event.title LIKE' => "%".$title."%", 
                    'Event.id <>' => $id),
                'order' => array('Event.from_date'=>'DESC','Event.id'=>'DESC'),
            ));
            if(!empty($events)){
                foreach ($events as $key => $event) {
                    $agenda = $event['Event']['agenda'];
                    if(trim(strip_tags($agenda)) != ''){
                        $agenda_final = $agenda;
                        break;
                    }
                }
            }
        }     
        return $agenda_final;   
    }
    function linkify_mail($str = ''){
        $pattern = '/([a-z0-9][-a-z0-9._]*[a-z0-9]*\@[a-z0-9][-a-z0-9_]+[a-z0-9]*\.[a-z0-9][-a-z0-9_-][a-z0-9]+)/i';
        $str = preg_replace ($pattern, '<a href="mailto:\\1">\\1</a>', $str);
        return $str;          
    }
    function draw_image_box($id = 0, $path = '', $cover = 0, $caption = ''){
        $tpl = '<div class="image_wrap" data-img-id="{{img_id}}">
            <div class="img_item">
            <img src="'.BASE_URL.'/{{img_path}}" style="max-width: 250px; max-height: 250px;">
            </div>
            <input type="hidden" name="img_path[{{img_id}}]" value="{{img_path}}" />
            <div class="caption">
            <label>Caption</label>
            <input type="text" name="img_caption[{{img_id}}]" value="{{img_caption}}" />
            </div>
            <div class="cover">
            <input type="radio" name="img_cover" value="{{img_id}}" {{img_cover}} />
            <label>Cover Image</label>
            </div>
            <div class="delete" data-img-id="{{img_id}}" >
                <a>Delete</a>
            </div>
        </div>';
        $html = '';
        $img_cover = '';
        if($cover == 1){
            $img_cover = 'checked="checked"';
        }
        if($path != ''){
            if($id == 0){
                $id = $this->generateRandomString();                
            }
            $html = str_replace(array('{{img_id}}', '{{img_path}}', '{{img_caption}}', '{{img_cover}}'), 
                                array($id, $path, $caption, $img_cover), $tpl);
        }
        return $html;
    }
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
    public function mainSmartResizeImage($image = ''){
        $imagePath = $this->Upload->imageUploadDir.$image;
        $maxImageWidth = 960;
        list($width, $height, $type, $attr) = getimagesize($imagePath);                
        if($width > $maxImageWidth){
            $this->Upload->smartResizeImage($imagePath, $maxImageWidth,0,true);
        }        
    }
}