<?php

/**
 * Attendance
 * @version  1.2
 * @author  Reza Mamun
 */
class HalfAttendence extends AppModel {

    public $name = 'HalfAttendence';
    //public $belongsTo = array('StudentCycle');

    public $belongsTo = array(
        'StudentCycle' => array(
            'className' => 'StudentCycle',
            'foreignKey' => 'student_cycle_id'
        )
    );

    /* public $validate = array(
      'roll' => array(

      'isUnique' => array(
      'rule' => 'isUnique',
      'message' => 'This Roll  already in use.',
      'last' => true,
      ),

      'notEmpty' => array(
      'rule' => 'notEmpty',
      'message' => 'Rll Name cannot be empty.',
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
      ); */
    protected $_displayFields = array(
        'student_cycle_id',
        'attendence_date',
    );

}
