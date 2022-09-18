<?php

/**
 * Attendance
 * @version  1.2
 * @author  Reza Mamun
 */
class Text extends AppModel {

    public $name = 'Text';
    public $validate = array(
        'level_id' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Department Can not be empty',
                'last' => true,
            )
        )
    );
    public $belongsTo = array(
        'Level' => array(
            'className' => 'Level',
        ),
        'Group' => array(
            'className' => 'Group',
        ),
        'SchoolTerm' => array(
            'className' => 'SchoolTerm',
        )
    );

}
