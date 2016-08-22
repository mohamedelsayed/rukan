<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net/
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
class Event extends AppModel {
	var $name = 'Event';
	var $displayField = 'title';
	var $validate = array(
	    'title' => array(
	        'rule' => 'notEmpty',
	        'message' => 'Title cannot be left blank'
	    ),
	   	'to_date' => array(
	        'rule' => 'date_diff',
	        'message' => 'From date must be less than To date.'
	    ), 	    
	);	
	var $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
    public function date_diff($check1, $ckeck2){
        $check1 = $this->data['Event']['from_date'];
        $check2 = $this->data['Event']['to_date'];
        if(strtotime($check2) >= strtotime($check1)){
            return true;            
        }else{
            return false;
        }
    }
}