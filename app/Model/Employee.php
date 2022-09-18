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
class Employee extends AppModel {

    /**
     * Model name
     *
     * @var string
     * @access public
     */
    public $name = 'Employee';
    //public $belongsTo = array('Guardian');
    /**
     * Model associations: belongsTo
     *
     * @var array
     * @access public
     */
    public $belongsTo = array(
        'User'
            //'Levels'
    );
    public $hasMany = array('Credit', 'Debit');
    public $actsAs = array(
        'Ordered' => array(
            'field' => 'weight',
            'foreign_key' => false,
        ),
        'Cached' => array(
            'prefix' => array(
                'setting_',
            ),
        ),
    );
    protected $_displayFields = array(
        'id',
        'name',
        'address',
        'phone',
        'User.email',
        'thumbnail',
        'profile',
        'age',
        'gender',
        'marital_status',
        'status',
    );

}
