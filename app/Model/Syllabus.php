<?php
/**
 * Role
 *
 * PHP version 5
 *
 * @category Model
 * @package  Croogo
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class Syllabus extends AppModel {

/**
 * Model name
 *
 * @var string
 * @access public
 */
	public $name = 'Syllabus';
	
	public $belongsTo = array('Course');


/**
 * Validation
 *
 * @var array
 * @access public
 */
	public $validate = array(
		'title' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Syllabus Name cannot be empty.',
				'last' => true,
			),
			
		),
		'course_id' => array(			
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please Select Course.',
				'last' => true,
			),
			
		),
	);

/**
 * Display fields for this model
 *
 * @var array
 */
	protected $_displayFields = array(
		'id',
		'title'		
	);

}
