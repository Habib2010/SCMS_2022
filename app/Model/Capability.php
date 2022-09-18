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
class Capability extends AppModel {

/**
 * Model name
 *
 * @var string
 * @access public
 */
	public $name = 'Capability';
	
	//public $actsAs = array('Containable');
	
	public $belongsTo = array('User');
	
	/*public $hasMany = array(
        'Payment' => array(
			'className'	=> 'Payment',
            'dependent'	=> true,
			'foreignKey'=> 'pay_type'
        )
    );*/
	



/**
 * Validation
 *
 * @var array
 * @access public
 */
	public $validate = array(
		/*'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Name cannot be empty.',
				'last' => true
			),
			'rule-1' => array(
                'rule'    => array('minLength', 4),
                'message' => 'Name must be at least 4 characters long',
				'last' => true
            ),
			'between' => array(
                'rule'    => array('between', 4, 20),
                'message' => 'Between 4 to 20 characters'
            ),
			'Rule-2' => array(
            	'rule' => '/[A-Za-z ]+/',
            	'message' => 'Only letters.'
        	 )
		)*/
	);

/**
 * Display fields for this model
 *
 * @var array
 */
	protected $_displayFields = array(
		/*'id',
		'ref',
		'trx_id',
		'name',
		'dob',
		'level',
		'status'*/
	);

}
