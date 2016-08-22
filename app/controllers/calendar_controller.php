<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net/
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
class CalendarController extends AppController {
	var $name = 'Calendar';
	var $uses = 'Event';	
	function index($type=null){
		$this->set('selected','calendar');
        $this->loadModel('Category');
        $categories = $this->Category->find(
            'all', array(
                'conditions' => array('Category.approved' => 1),
                'order' => array('Category.id'=>'ASC')
            )           
        );
        $this->set('categories' , $categories);
        $year = isset($this->params['named']['year'])?$this->params['named']['year']:date("Y");
        $month = isset($this->params['named']['month'])?$this->params['named']['month']:date("m");
        $category = isset($this->params['named']['category'])?$this->params['named']['category']:0;
        $current_month = $month;
        $current_year = $year;
        $condition = '';
        if($category != 0 && is_numeric($category)){
            $condition = 'Event.category_id = '.$category;            
        }
        $events = $this->Event->find('all', array(
            'conditions' => array(
                'AND' => array(
                    'OR' => array(
                        array('AND' => array(
                                'YEAR(Event.from_date) = '.$year,
                                'MONTH(Event.from_date) = '.$month
                            )
                        ),     
                        array('AND' => array(
                                'YEAR(Event.to_date) = '.$year,
                                'MONTH(Event.to_date) = '.$month
                            )
                        )                        
                    )
                ),
                $condition              
            ),
            'order' => array('Event.from_date'=>'ASC','Event.id'=>'DESC'),
        ));
        $events_by_days = array();
        if(!empty($events)){
            foreach ($events as $key => $event) {
                $date = $event['Event']['from_date'];
                $to_date = $event['Event']['to_date'];
                if(strtotime($to_date) >= strtotime($date)){
                    $day = date('j', strtotime($date));
                    $month = date('n', strtotime($date));
                    $year = date('Y', strtotime($date));
                    $to_day = date('j', strtotime($to_date));
                    $to_month = date('n', strtotime($to_date));                    
                    $to_year = date('Y', strtotime($to_date));     
                    if($month == $current_month){
                        if($to_month == $current_month){
                            for ($i = $day; $i <= $to_day; $i++) {
                                $events_by_days[$i][] = $event;                       
                            }                    
                        }else{
                            for ($i = $day; $i <= 31; $i++) {                                
                                $events_by_days[$i][] = $event;                       
                            } 
                        }                                                    
                    }elseif($to_month == $current_month){                        
                        for ($i = $to_day; $i >= 1; $i--) {
                            $events_by_days[$i][] = $event;
                        }                    
                    }                    
                }
            }
        }
        $this->set('events_by_days' , $events_by_days);
	}	
    function get_event($id = 0){
        $data = '';
        if($id != 0){
            $event = $this->Event->find(
                'first', array(
                    'conditions' => array('Event.approved' => 1, 'Event.id' => $id),
                )           
            );
            if(!empty($event)){
                $date = date('F d, Y', strtotime($event['Event']['from_date']));
                $to_date = date('F d, Y', strtotime($event['Event']['to_date']));
                $timing = date('g:i a', strtotime($event['Event']['timing']));      
                $color = 'color:#000000;';
                if(isset($event['Category']['color']) && $event['Category']['color'] != ''){
                    $color = 'color:'.$event['Category']['color'].';';
                }   
                if(trim(strip_tags($event['Event']['agenda'])) != ''){
                    $agenda = $event['Event']['agenda'];
                }else{
                    $agenda = $this->get_realated_event_agenda($id, strip_tags($event['Event']['title']));
                }    
                $data .= '<h4 style="'.$color.'">'.strip_tags($event['Event']['title']).'<div id="closeeventpopoup" class="closeeventpopoup">X</div></h4>
                            <div class="eventpopoupbody">
                            <div class="eventpopouphead eventpopoupdate">From Date: </div><div class="eventpopoupcontent">'.$date.'</div>
                            <div class="eventpopouphead eventpopoupdate">To Date: </div><div class="eventpopoupcontent">'.$to_date.'</div>
                            <div class="eventpopouphead eventpopouptiming">Timing: </div><div class="eventpopoupcontent">'.$timing.'</div>';
                if(trim($event['Event']['location']) != ''){
                    $data .= '<div class="eventpopouphead eventpopouplocation">Location: </div><div class="eventpopoupcontent">'.$event['Event']['location'].'</div>';
                }
                if(isset($event['Category']['title'])){
                    if($event['Category']['title'] != ''){
                        $data .= '<div class="eventpopouphead eventpopoupcategory">Category: </div><div class="eventpopoupcontent">'.$event['Category']['title'].'</div>';
                    }
                }
                $data .= '<div class="eventpopouphead eventpopoupagenda">Agenda:  </div><div class="eventpopoupcontent">'.$agenda.'</div>
                            </div>';
            }
        }
        echo $data;     
        $this->autoRender = false;          
    }
}