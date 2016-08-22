<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
class HomeController  extends AppController {
	var $name = 'Home';
	var $uses = null;
	var $components = array('Email');
	function index(){	    
		$this->set('selected','home');
        $this->set('is_home', 1);
		$this->set('title_for_layout' , 'Home');
		$this->loadModel('Widget');
		$widgets = $this->Widget->find(
			'all', array(
				'conditions' => array('Widget.approved' => 1, 'Widget.page_id' => 1),
				'order' => array('Widget.id'=>'ASC')
			)	  	 	
		);
		$this->set('widgets' , $widgets);
		$this->loadModel('Article');
		$articles = $this->Article->find(
			'all', array(
				'conditions' => array('Article.approved' => 1
				//, 'Article.featured' => 1
				),
				'order' => array('Article.id'=>'DESC'),
				'limit' => 5
			)	  	 	
		);
		$this->set('articles' , $articles);
		$this->loadModel('Album');
        $albums = $this->Album->find(
            'all', array(
                'conditions' => array('Album.approved' => 1
                ),
                'order' => array('Album.id'=>'DESC'),
                'limit' => 6
            )           
        );
        $this->set('albums' , $albums);
        /*$this->loadModel('Academic');
        $academics = $this->Academic->find(
            'all', array(
                'conditions' => array('Academic.approved' => 1
                ),
                'order' => array('Academic.id'=>'ASC'),
                'limit' => 5
            )           
        );
        $this->set('academics' , $academics);*/
        $this->loadModel('Event');
        $today = date("Y-m-d"); 
        $events = $this->Event->find(
            'all', array(
                'conditions' => array(
                    'Event.approved' => 1,
                    'Event.from_date >=' => $today,
                ),
                'order' => array('Event.from_date'=>'ASC','Event.id'=>'DESC'),
                'limit' => 4
            )           
        );
        $this->set('events' , $events);
        $agendas = array();
        if(!empty($events)){
            foreach ($events as $key => $event) {
                if(trim(strip_tags($event['Event']['agenda'])) != ''){
                    $agenda = $event['Event']['agenda'];
                }else{
                    $agenda = $this->get_realated_event_agenda($event['Event']['id'], strip_tags($event['Event']['title']));
                }
                $agendas[$event['Event']['id']] = $agenda;                
            }
        }
        $this->set('agendas' , $agendas);
        $this->loadModel('Cat');
        $education_cat = $this->Cat->find(
            'first', array(
                'conditions' => array('Cat.approved' => 1, 'Cat.id' => 3),
                'order' => array('Cat.weight' => 'ASC','Cat.id'=>'DESC')
            )           
        );
        $this->set('education_cat' , $education_cat);
	}
	function newsletter(){	
		$error = '';
		//print_r($this->data);
		/*if($this->data['newsletter']['name'] == ''){
			$error .= __('You must enter your Name.', true).'<br />';
		}*/
		if(!filter_var($this->data['newsletter']['email'], FILTER_VALIDATE_EMAIL)) {
			$error .= __('You must enter valid Email.', true).'<br />';
		}	
		/*if(!is_numeric($this->data['newsletter']['phone']) && $this->data['newsletter']['phone'] == ''){
			$error .= __('You must enter valid Mobile.', true).'<br />';
		}*/		
		if($error != ''){
			echo $error;
		}else{
			$this->loadModel('Subscriber');
			$this->data['Subscriber'] = $this->data['newsletter'];
			$this->Subscriber->create();			
			if ($this->Subscriber->save($this->data)) {
				$this->loadModel('Setting');
				$settings = $this->Setting->read(null, 1);				
				$subject = $settings['Setting']['title'].' Newsletter';
				$this->Email->to = $this->data['newsletter']['email'];
				$this->Email->subject = $subject;			
				$this->Email->replyTo = $settings['Setting']['email'];
				$this->Email->from = $settings['Setting']['title'].'<'.$settings['Setting']['email'].'>';				
				$this->Email->sendAs = 'html';
				$this->Email->template = 'newsletterwelcome';
				$this->set('subject', $subject);
				//$this->set('name', $this->data['newsletter']['name']);			
				$this->set('email', $this->data['newsletter']['email']);
				$this->set('site_title', $settings['Setting']['title']);
				//$this->set('phone', $this->data['newsletter']['phone']);
				//$this->set('message', $this->data['newsletter']['message']);    		
				if ($this->Email->send()){
					echo __('You have subscribed to our Newsletter.', true);
				}
				else{
					echo __('There was a problem sending the Email. Please try again.', true);
				}				
			}else{
				echo __('Your Email already added before.', true);
			}
		}
		$this->autoRender = false;
	}
	function maintenancemode(){
		$this->layout = 'ajax';
		$this->loadModel('Setting');
		$settings = $this->Setting->read(null, 1);				
		$maintenance_mode_text = $settings['Setting']['maintenance_mode_text'];		
		$this->set('maintenance_mode_text', $maintenance_mode_text);
	}
}