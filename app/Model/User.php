<?php

App::uses('AuthComponent', 'Controller/Component');

/**
 * User
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
class User extends AppModel {

    /**
     * Model name
     *
     * @var string
     * @access public
     */
    public $name = 'User';

    /**
     * Order
     *
     * @var string
     * @access public
     */
    public $order = 'name ASC';

    /**
     * Behaviors used by the Model
     *
     * @var array
     * @access public
     */
    public $actsAs = array(
        'Acl' => array(
            'className' => 'CroogoAcl',
            'type' => 'requester',
        ),
    );

    /**
     * Model associations: belongsTo
     *
     * @var array
     * @access public
     */
    public $belongsTo = array('Role');

    /* public $hasMany = array(
      'Capability' => array(
      'className'	=> 'Capability',
      'dependent'	=> true,
      //'foreignKey'=> 'pay_type'
      )
      ); */

    /**
     * Validation
     *
     * @var array
     * @access public
     */
    public $validate = array(
        'username' => array(
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'The username has already been taken.',
                'last' => true,
            ),
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'This field cannot be left blank.',
                'last' => true,
            ),
            'validAlias' => array(
                'rule' => 'validAlias',
                'message' => 'This field must be alphanumeric',
                'last' => true,
            ),
        ),
        'email' => array(
            'email' => array(
                'rule' => 'email',
                'message' => 'Please provide a valid email address.',
                'last' => true,
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Email address already in use.',
                'last' => true,
            ),
        ),
        'password' => array(
            'rule' => array('minLength', 6),
            'message' => 'Passwords must be at least 6 characters long.',
        ),
        'verify_password' => array(
            'rule' => 'validIdentical',
        ),
        'name' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'This field cannot be left blank.',
                'last' => true,
            ),
        ),
        'website' => array(
            'url' => array(
                'rule' => 'url',
                'message' => 'This field must be a valid URL',
                'allowEmpty' => true,
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
        'Role.title' => 'Role',
        'username',
        'name',
        //'capabilities'=>array('sort'=>false,'label'=>'Capability'),
        'status' => array('type' => 'boolean'),
        'email',
    );

    /**
     * Edit fields for this model
     *
     * @var array
     */
    protected $_editFields = array(
        'role_id',
        'username',
        'name',
        'email',
        'website',
        'status',
            //'capabilities'
    );

    /**
     * beforeDelete
     *
     * @param boolean $cascade
     * @return boolean
     */
    public function beforeDelete($cascade = true) {
        $this->Role->Behaviors->attach('Aliasable');
        $adminRoleId = $this->Role->byAlias('admin');

        $current = AuthComponent::user();
        if (!empty($current['id']) && $current['id'] == $this->id) {
            return false;
        }
        if ($this->field('role_id') == $adminRoleId) {
            $count = $this->find('count', array(
                'conditions' => array(
                    'User.id <>' => $this->id,
                    'User.role_id' => $adminRoleId,
                    'User.status' => true,
                )
                    ));
            return ($count > 0);
        }
        return true;
    }

    /**
     * beforeSave
     *
     * @param array $options
     * @return boolean
     */
    public function beforeSave($options = array()) {
        if (!empty($this->data['User']['password'])) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }
        return true;
    }

    /**
     * _identical
     *
     * @param string $check
     * @return boolean
     * @deprecated Protected validation methods are no longer supported
     */
    protected function _identical($check) {
        return $this->validIdentical($check);
    }

    /**
     * validIdentical
     *
     * @param string $check
     * @return boolean
     */
    public function validIdentical($check) {
        if (isset($this->data['User']['password'])) {
            if ($this->data['User']['password'] != $check['verify_password']) {
                return __('Passwords do not match. Please, try again.');
            }
        }
        return true;
    }

}
