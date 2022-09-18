<?php

App::uses('AppModel', 'Model');

/**
 * Contact
 *
 * PHP version 5
 *
 * @category Model
 * @package  Croogo
 * @version  1.0
 * @author   esoftarena
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class CalendarEvent extends AppModel {

/**
 * Model name
 *
 * @var string
 * @access public
 */
	public $name = 'CalendarEvent';
	
/**
 * Validation
 *
 * @var array
 * @access public
 */
	public $validate = array(
	
		'title' => array(
			'notEmpty' => array ( 
				'rule' => 'notEmpty',
				'message' => 'Please Provide a Title.',
				'allowEmpty' => false,
      	  		'required' => true,
			),
		),
		
	    'description' => array(
			'notEmpty' => array ( 
				'rule' => 'notEmpty',
				'message' => 'Please Provide description.',
				'allowEmpty' => false,
      	  		'required' => true,
			),
		)	
			
	);
	
	protected $_displayFields = array(
                                     'id',
									 'title',
                                     'description',
									 'start_date',
									 'end_date',
									 'created',
									 'modified'
									);
	

}
