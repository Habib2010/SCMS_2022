<?php

/**
 * Configuration
 */
Configure::write('Tinymce.actions', array(
    'Nodes/admin_add' => array(
        array(
            'elements' => 'NodeBody',
        ),
    ),
    'Nodes/admin_edit' => array(
        array(
            'elements' => 'NodeBody',
        ),
    ),
    'Translate/admin_edit' => array(
        array(
            'elements' => 'NodeBody',
        ),
    ),
    'Employees/admin_add' => array(
        array(
            'elements' => 'EmployeeProfile',
        ),
    ),
    'Employees/admin_edit' => array(
        array(
            'elements' => 'EmployeeProfile',
        ),
    ),
    'Employees/edit' => array(
        array(
            'elements' => 'EmployeeProfile',
        ),
    ),
    'Courses/admin_edit' => array(
        array(
            'elements' => 'CourseDescription',
        ),
    ),
    'Courses/admin_add' => array(
        array(
            'elements' => 'CourseDescription',
        ),
    ),
    'Levels/admin_edit' => array(
        array(
            'elements' => 'LevelDescription',
        ),
    ),
    'Levels/admin_add' => array(
        array(
            'elements' => 'LevelDescription',
        ),
    ),
    'Syllabi/admin_edit' => array(
        array(
            'elements' => 'SyllabusDescription',
        ),
    ),
    'Syllabi/admin_add' => array(
        array(
            'elements' => 'SyllabusDescription',
        ),
    ),
));

/**
 * Hook helper
 */
foreach (Configure::read('Tinymce.actions') as $action => $settings) {
    $actionE = explode('/', $action);
    Croogo::hookHelper($actionE['0'], 'Tinymce.Tinymce');
}
Croogo::hookHelper('Attachments', 'Tinymce.Tinymce');

