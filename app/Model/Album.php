<?php
/**
 * Album
 *
 *
 * @category Model
 * @package  Croogo
 * @version  1.4.4
 * @author   Edinei L. Cipriani <phpedinei@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.edineicipriani.com.br
 */
class Album extends AppModel {
/**
 * Model name
 *
 * @var string
 * @access public
 */
	var $name = 'Album';

public $validate = array(
		'title' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Gallery Name cannot be empty.',
				'last' => true,
			),
		),
		'slug' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Gallery Slug cannot be empty.',
				'last' => true,
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This Gallery Slug has already been taken.',
				'last' => true,
			),
		),
		'description' => array(			
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Gallery Description cannot be empty.',
				'last' => true,
			),
		),
	);

/**
 * Model associations: hasMany
 *
 * @var array
 * @access public
 */
	
	public $hasMany = array(
			'Photo' => array('className' => 'Photo',
							 'foreignKey' => 'album_id',
							 'dependent' => true,								
			),
	);
	
}
?>