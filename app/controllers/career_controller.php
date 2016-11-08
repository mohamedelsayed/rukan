<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
class CareerController  extends AppController {
	var $name = 'Career';
	var $uses = array('Career', 'Development');	
    var $vacancies = 'vacancies';
    var $developments = 'developments';
    var $career_model = 'Career';
    var $development_model = 'Development';
    var $components = array('Email');
	function index(){
		$this->redirect($this->referer($this->Session->read('Setting.url')));			
	}
	function all($type = ''){
	    $title = '';
        $selected = '';
	    if($type == $this->vacancies){
	        $limit = $this->getCareersPagingLimit();
            $model = $this->career_model;
            $cat_data = $this->get_cat_data(34);            
        }elseif($type == $this->developments){
            $limit = $this->getDevelopmentsPagingLimit();
            $model = $this->development_model;            
            $cat_data = $this->get_cat_data(35);
        }
        if(!empty($cat_data)){
            $title = $cat_data['Cat']['title'];
            $parent_cat_data = $this->get_cat_data($cat_data['Cat']['parent_id']);            
            $selected = strtolower(str_replace(' ', '', $parent_cat_data['Cat']['title']));  
        }
        if(isset($model)){
    	    $conditions = array($model.'.approved' => 1);
    		$count = $this->$model->find('count', array(
                    'conditions' => $conditions,
                )
            );
            $page_count = ceil($count / $limit);
            $this->set('pages_count', $page_count);        
    		$this->set('limit', $limit);		
    		$this->set('selected', $selected);
    		$this->set('title_for_layout' , $title);
            $this->set('title' , $title);
            $this->set('parent_title' , $parent_cat_data['Cat']['title']);	
            $this->set('model' , $model);
            $this->set('body' , $cat_data['Cat']['body']);	
            $this->render($type);	        
        }else{
            $this->redirect($this->referer($this->Session->read('Setting.url')));
        }
	}
	function item($id = ''){
	    $base_url = $this->Session->read('Setting.url');
	    $model = $this->development_model;	
		$this->loadModel($model);
		$item = $this->$model->find(
			'first', array(
				'conditions' => array($model.'.approved' => 1, $model.'.id' => $id),
			)	  	 	
		);
		$this->set('item',$item);
        $cat_data = $this->get_cat_data(35);
        $title = $cat_data['Cat']['title'];
        $parent_cat_data = $this->get_cat_data($cat_data['Cat']['parent_id']);            
        $selected = strtolower(str_replace(' ', '', $parent_cat_data['Cat']['title']));  
        $this->set('selected', $selected);        
		$this->set('title_for_layout' , $item[$model]['title']);	
		if(isset($item[$model]['image']) && $item[$model]['image'] != ''){
			$this->set('shareImage',$item[$model]['image']);
		}	    	
        $child_url = '/career/all/developments';
        $this->set('model' , $model); 
        $this->set('child_title' , $title);
        $this->set('child_url' , $child_url);
        $this->set('parent_title' , $parent_cat_data['Cat']['title']);  
	}
    function list_items(){
        $page = $_POST['page'];
        $limit = $_POST['limit'];
        $model = $_POST['model'];
        $conditions = array($model.'.approved' => 1);
        $this->paginate = array(
            $model => array(
                'conditions' => $conditions,
                'order'      => array($model.'.weight' => 'ASC', $model.'.id'=>'DESC'),
                'limit'      => $limit,
                'page'       => $page,
            )   
        );
        $items = $this->paginate($model);
        $count = $this->$model->find('count', array(
                'conditions' => $conditions,
            )
        );
        $page_count = ceil($count / $limit);    
        $data = '';
        if(!empty($items)){
            $i = 0;
            foreach($items as $item){
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = '';
                }
                if($model == $this->development_model){
                    $data .= $this->draw_development_item($item, $model, $class);
                }elseif($model == $this->career_model){
                    $data .= $this->draw_career_item($item, $model, $class);
                }
            }
        }
        $data .= '<script type="text/javascript">
                    $(document).ready(function() {
                        jQuery(\'#loadmoreitems\').attr("pagecount", "'.$page_count.'");
                    });
                </script>'; 
        echo $data;     
        $this->autoRender = false;          
    }
    function draw_development_item($item, $model, $class){
        $item_div = '';
        if(!empty($item)){
            $base_url = $this->Session->read('Setting.url');
            $item_id = $item[$model]['id']; 
            $item_link = $base_url.'/career/item/'.$item_id;
            $image = '';
            $div_ratio = 430/250;
            if(isset($item[$model]['image'])){
                $this->mainSmartResizeImage($item[$model]['image']);
                $image = $base_url.'/img/upload/'.$item[$model]['image'];
                $image_path = WWW_ROOT.'img'.DS.'upload'.DS.$item[$model]['image'];                           
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
            $body = $this->remove_unneeded_tags_from_string($item[$model]['body']);
            $body = $this->string_format_view($body, 'wordsCut', 50);
            $item_div .= '<div class="careers_groub">
                        <div class="adders_careers">'.$item[$model]['title'].'</div>
                        <div class="careers_groub_img">
                            <a href="'.$item_link.'">
                                <img style="'.$style.'" src="'.$image.'"/>
                            </a>
                        </div>
                        <div class="bottm_img">
                        <img src="'.$base_url.'/img/front/img_smill.jpg"/>
                        <div class="bottm_write">'.$item[$model]['sub_title'].'</div>
                        </div>
                        <div class="caeers_smill">'.$body.'</div>
                        <div class="bottm_reed"><a href="'.$item_link.'">Read More ></a>
                        </div></div>';
        }
        return $item_div;
    }
    function draw_career_item($item, $model, $class){
        $item_div = '';
        if(!empty($item)){
            $base_url = $this->Session->read('Setting.url');
            $item_id = $item[$model]['id']; 
            $image = '';
            $body = $this->remove_unneeded_tags_from_string($item[$model]['description']);
            //$body = $this->string_format_view($body, 'wordsCut', 50);
            $item_div .= '<div class="vacancies_groub" id="vacancy_div'.$item_id.'">
                            <div class="adders_vacancies vacancy_div_title">'.$item[$model]['title'].'</div>
                            <div class="write_vacancies">'.$body.'</div>
                            <div class="bottm_apply" onclick="open_vacancy($(this));">Apply Now ></div>
                            <input class="vacancy_div_to_email" type="hidden" value="'.$item[$model]['to_email'].'"">
                        </div>';
        }
        return $item_div;
    }
    function get_cat_data($cat_id = 0){
        $this->loadModel('Cat');
        $cat = $this->Cat->find(
            'first', array(
                'conditions' => array('Cat.approved' => 1, 'Cat.id' => $cat_id),
                'order' => array('Cat.weight' => 'ASC','Cat.id'=>'DESC')
            )           
        );
        return $cat;
    }
    function vacancyform($type = 'notajax'){
        $error = '';    
        if($this->data['vacancy']['name'] == ''){
            $error .= __('You must enter your Name.', true).'<br />';
        }       
        if(!filter_var($this->data['vacancy']['email'], FILTER_VALIDATE_EMAIL)) {
            $error .= __('You must enter valid Email.', true).'<br />';
        }
        if($this->data['vacancy']['message'] == ''){
            $error .= __('You must enter your Message.', true).'<br />';
        }   
        $upload_dir = ROOT.DS.APP_DIR.DS.'tmp'.DS.'tmpcv'.DS;
        if (!file_exists($upload_dir)) {
             mkdir($upload_dir, 0777);
        } 
        $current_year = date('Y');
        $current_month = date('m');
        $dir_name_with_year = $upload_dir.'/'.$current_year;
        if (!file_exists($dir_name_with_year)) {
            mkdir($dir_name_with_year, 0777);
        }
        $dir_name_with_month = $upload_dir.'/'.$current_year.'/'.$current_month;
        if (!file_exists($dir_name_with_month)) {
            mkdir($dir_name_with_month, 0777);
        }
        $final_upload_dir = $upload_dir.'/'.$current_year.'/'.$current_month.'/';
        $file_name = str_replace("#", "_", basename($_FILES['file']['name']));
        $file_name = str_replace("?", "_", $file_name);
        $file_name = str_replace(" ", "_", $file_name);
        $file = $final_upload_dir.$file_name; 
        if (file_exists($file)) {
            $file_name = time().$file_name;
        }
        $file = $final_upload_dir.$file_name; 
        $file_path = '';        
        if(move_uploaded_file($_FILES['file']['tmp_name'], $file)){
            $file_path = $file;
        }
        if($error != ''){
            echo $error;
        }else{
            $this->loadModel('Setting');
            $this->loadModel('Content');
            $settings = $this->Setting->read(null, 1);  
            $contents = $this->Content->read(null, 1);                  
            $subject = __('Apply for vacancy ',true).' "'.$this->data['vacancy']['title'].'"';
            $this->Email->to = $this->data['vacancy']['to_email'];
            $this->Email->subject = $subject;           
            $this->Email->replyTo = $this->data['vacancy']['email'];
            $this->Email->from = $this->data['vacancy']['name'].'<'.$this->data['vacancy']['email'].'>';                
            $this->Email->sendAs = 'html';
            //for arabic
            /*if(isset($this->params['named']['lang'])){
                $this->Email->template = 'vacancyar';
            }else{*/        
            $this->Email->template = 'vacancy';
            //}
            $this->set('subject', $subject);
            $this->set('name', $this->data['vacancy']['name']);
            //$this->set('phone', $this->data['vacancy']['phone']);           
            $this->set('email', $this->data['vacancy']['email']);
            //$this->set('adress', $this->data['vacancy']['adress']);
            $this->set('message', $this->data['vacancy']['message']); 
            $this->set('vacancy', $this->data['vacancy']['title']); 
            $this->set('url', $settings['Setting']['url']);    
            $this->Email->attachments = array($file_path);                                       
            if ($this->Email->send()){
                //echo __('<span style="color:#00FF00;">Email has been sent.</span>', true);
                //echo __('Email has been sent.', true);
                echo __('Thank you for applying for this vacancy. We will get back to you the soonest.', true);           
            }
            else{
                echo __('There was a problem sending the Email. Please try again.', true);
            }               
        }
        if($type == 'notajax'){
            //for arabic
            /*if(isset($this->params['named']['lang'])){
                $this->redirect($this->Session->read('Setting.url').'/career/all/vacancies/index/lang:'.$this->params['named']['lang']);
            }else{*/    
                $this->redirect($this->Session->read('Setting.url').'/career/all/vacancies');
            //}
        }elseif($type == 'ajax'){
            $this->autoRender = false;
        }        
    }
}