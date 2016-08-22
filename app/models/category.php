<?php
class Category extends AppModel {
	var $name = 'Category';
	var $displayField = 'title';
	var $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Title cannot be left blank',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
	);
	var $hasMany = array(
		'Event' => array(
			'className' => 'Event',
			'foreignKey' => 'category_id',
			'dependent' => false,
			'conditions' => array('Event.approved' => 1),
			'fields' => '',
			'order' => array('Event.from_date' => 'DESC', 'Event.id' => 'DESC'),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
}