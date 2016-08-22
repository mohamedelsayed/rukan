<?php
class Career extends AppModel {
	var $name = 'Career';
	var $displayField = 'title';
	//Validation rules
	var $validate = array(
	    'title' => array(
	        'rule' => 'notEmpty',
	        'message' => 'Title cannot be left blank'
	    )	    
	);		
}