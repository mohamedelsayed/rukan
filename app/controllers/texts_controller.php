<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
class TextsController extends AppController {
	var $name = 'Texts';
	var $uses = array('Content');
	var $components = array('Email');
	//var $helpers = array('GoogleMapV3'); 	
	function index(){
		$this->redirect($this->referer(BASE_URL));		
	}	
	function display($id = null, $title = null){
		if(!$id){
			$this->redirect($this->referer(BASE_URL));
		}
		$content = $this->Content->read(null, $id);
		$this->set('title_for_layout', $content['Content']['title']);
		$this->set('content', $content);
		$this->set('selected', strtolower(str_replace(' ', '', $content['Content']['title'])));
        $body = $content['Content']['body'];
        $body = $this->linkify_mail($body);
        $this->set('body' , $body);
	}
	function contactusForm($type = 'notajax'){
		$error = '';	
		if($this->data['Contactus']['name'] == ''){
			$error .= __('You must enter your Name.', true).'<br />';
		}		
		if(!filter_var($this->data['Contactus']['email'], FILTER_VALIDATE_EMAIL)) {
			$error .= __('You must enter valid Email.', true).'<br />';
		}
		/*if($this->data['Contactus']['phone'] == '' || !is_numeric($this->data['Contactus']['phone'])){
			$error .= __('You must enter valid Phone.', true).'<br />';
		}	
		if($this->data['Contactus']['adress'] == ''){
			$error .= __('You must enter your Adress.', true).'<br />';
		}*/
		if($this->data['Contactus']['message'] == ''){
			$error .= __('You must enter your Message.', true).'<br />';
		}		
		if($error != ''){
			echo $error;
		}else{
			$this->loadModel('Setting');
			$this->loadModel('Content');
			$settings = $this->Setting->read(null, 1);	
			$contents = $this->Content->read(null, 1);					
			$subject = __('Contact Us',true);
			$this->Email->to = $contents['Content']['mail'];
			$this->Email->subject = $subject;			
			$this->Email->replyTo = $this->data['Contactus']['email'];
			$this->Email->from = $this->data['Contactus']['name'].'<'.$this->data['Contactus']['email'].'>';				
			$this->Email->sendAs = 'html';
			//for arabic
			/*if(isset($this->params['named']['lang'])){
				$this->Email->template = 'contactusar';
			}else{*/		
			$this->Email->template = 'contactus';
			//}
			$this->set('subject', $subject);
			$this->set('name', $this->data['Contactus']['name']);
			//$this->set('phone', $this->data['Contactus']['phone']);			
			$this->set('email', $this->data['Contactus']['email']);
			//$this->set('adress', $this->data['Contactus']['adress']);
			$this->set('message', $this->data['Contactus']['message']);	
			$this->set('url', $settings['Setting']['url']);			     		
			if ($this->Email->send()){
				//echo __('<span style="color:#00FF00;">Email has been sent.</span>', true);
				//echo __('Email has been sent.', true);
				echo __('Thank you for your message. We will get back to you the soonest.', true);			 
			}
			else{
				echo __('There was a problem sending the Email. Please try again.', true);
			}				
		}
		if($type == 'notajax'){
			//for arabic
			/*if(isset($this->params['named']['lang'])){
				$this->redirect(BASE_URL.'/contact-us/index/lang:'.$this->params['named']['lang']);
			}else{*/	
				$this->redirect(BASE_URL.'/contact-us');
			//}
		}elseif($type == 'ajax'){
			$this->autoRender = false;
		}
	}
    function sendmailform($type = 'notajax'){
        $error = '';    
        if($this->data['sendmail']['name'] == ''){
            $error .= __('You must enter your Name.', true).'<br />';
        }       
        if(!filter_var($this->data['sendmail']['email'], FILTER_VALIDATE_EMAIL)) {
            $error .= __('You must enter valid Email.', true).'<br />';
        }
        /*if($this->data['sendmail']['phone'] == '' || !is_numeric($this->data['sendmail']['phone'])){
            $error .= __('You must enter valid Phone.', true).'<br />';
        }   
        if($this->data['sendmail']['adress'] == ''){
            $error .= __('You must enter your Adress.', true).'<br />';
        }*/
        if($this->data['sendmail']['message'] == ''){
            $error .= __('You must enter your Message.', true).'<br />';
        }       
        if($error != ''){
            echo $error;
        }else{
            $this->loadModel('Setting');            
            $settings = $this->Setting->read(null, 1);              
            $subject = $this->data['sendmail']['subject'];
            $this->Email->to = $this->data['sendmail']['to_email'];
            $this->Email->subject = $subject;           
            $this->Email->replyTo = $this->data['sendmail']['email'];
            $this->Email->from = $this->data['sendmail']['name'].'<'.$this->data['sendmail']['email'].'>';                
            $this->Email->sendAs = 'html';
            //for arabic
            /*if(isset($this->params['named']['lang'])){
                $this->Email->template = 'sendmailar';
            }else{*/        
            $this->Email->template = 'sendmail';
            //}
            $this->set('subject', $subject);
            $this->set('name', $this->data['sendmail']['name']);
            //$this->set('subject', $this->data['sendmail']['subject']);           
            $this->set('email', $this->data['sendmail']['email']);
            //$this->set('adress', $this->data['sendmail']['adress']);
            $this->set('message', $this->data['sendmail']['message']); 
            $this->set('url', $settings['Setting']['url']);                     
            if ($this->Email->send()){
                //echo __('<span style="color:#00FF00;">Email has been sent.</span>', true);
                //echo __('Email has been sent.', true);
                echo __('Thank you for your message. He will get back to you the soonest.', true);           
            }
            else{
                echo __('There was a problem sending the Email. Please try again.', true);
            }               
        }
        if($type == 'notajax'){
            //for arabic
            /*if(isset($this->params['named']['lang'])){
                $this->redirect(BASE_URL.'/contact-us/index/lang:'.$this->params['named']['lang']);
            }else{*/    
                $this->redirect(BASE_URL.'/');
            //}
        }elseif($type == 'ajax'){
            $this->autoRender = false;
        }	
    }     
    function upload_image(){
        $absolute_webroot = ROOT.DS.APP_DIR.DS.WEBROOT_DIR;        
        $upload_dir = $absolute_webroot.DS.'img'.DS.'upload';
        if (!file_exists($upload_dir)) {
             mkdir($upload_dir, 0777);
        } 
        $current_year = date('Y');
        $current_month = date('m');
        $dir_name_with_year = $upload_dir.DS.$current_year;
        if (!file_exists($dir_name_with_year)) {
            mkdir($dir_name_with_year, 0777);
        }
        $dir_name_with_month = $upload_dir.DS.$current_year.DS.$current_month;
        if (!file_exists($dir_name_with_month)) {
            mkdir($dir_name_with_month, 0777);
        }
        $final_upload_dir = $upload_dir.DS.$current_year.DS.$current_month.DS;
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
        $final_path = str_replace($absolute_webroot, '', $file_path);
        $this->mainSmartResizeImage(str_replace($upload_dir, '', $file));
        echo $this->draw_image_box(0, $final_path, '', '');
        $this->autoRender = false; 
    }     
}