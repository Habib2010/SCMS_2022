<?php

/**
 * Student Results Controller
 * @version  1.3
 * @author  TechPlexus Ltd.
 */
class StudentResultsController extends AppController {

    public $name = 'StudentResults';
    public $uses = array('StudentResult', 'StudentCourse', 'SchoolTerm', 'SchoolTermCycle', 'CourseCycleTopscore', 'CoursePartsCycle', 'CourseCycle', 'Course', 'Student', 'Level', 'Section', 'Shift', 'Group', 'StudentCycle', 'StudentMerit', 'SchoolSession', 'Employee', 'Text');
    public $components = array(
        'Akismet',
        'Email',
        'Recaptcha',
        'ImageUpload',
        'RequestHandler',
        'Acl',
        'Auth',
        'Session',
        'Security',
        'Cookie'
    );

    function beforeFilter() {
        parent::beforeFilter();
        $this->Security->blackHoleCallback = 'blackhole';
        $this->Security->csrfCheck = false;
        $this->Security->validatePost = false;
    }

    public function index($session = null, $termId = null, $roll = null, $deptId = null, $groupId = null) {
        $this->layout = 'default';
        $this->set('title_for_layout', __('Student Result'));
        $showSearchForm = TRUE;
        $withCaps = $this->limitCapabilities($level_id, $section_id);
        if (($this->request->is('post') && !empty($this->request->data['StudentResult'])) || (!empty($roll) || !empty($termId) || !empty($session) || !empty($deptId) || !empty($groupId))) {

            if ($this->request->is('post')) {
                $roll = trim($this->request->data['StudentResult']['roll']);
                $termId = trim($this->request->data['StudentResult']['term_id']);
                $session = trim($this->request->data['StudentResult']['school_session_id']);
                $deptId = trim($this->request->data['StudentResult']['level_id']);
                $groupId = trim($this->request->data['StudentResult']['group_id']);
            } else {
                //Just to make the $_GET variables available in the search form, nothing else :)
                $this->request->data['StudentResult']['roll'] = trim($roll);
                $this->request->data['StudentResult']['term_id'] = trim($termId);
                $this->request->data['StudentResult']['school_session_id'] = trim($session);
                $this->request->data['StudentResult']['level_id'] = trim($deptId);
                $this->request->data['StudentResult']['group_id'] = trim($groupId);
            }
            $roll = empty($roll) ? '' : trim($roll);
            $termId = empty($termId) ? '' : trim($termId);
            $session = empty($session) ? '' : trim($session);
            $deptId = empty($deptId) ? '' : trim($deptId);
            $groupId = empty($groupId) ? '' : trim($groupId);
            if (empty($roll) || empty($termId) || empty($session) || empty($deptId) || empty($groupId)) {
                $this->set('searchError', __('Please Enter/Select <b>All Fields</b>!'));
            } elseif (empty($roll)) {
                $this->set('searchError', __('Please Enter <b>Student Roll</b>!'));
            } elseif (strlen($session) != 4 || !is_numeric($session)) {
                $this->set('searchError', __('<b>Session Year</b> is not valid!'));
            } elseif (!in_array($termId, array(1, 2, 3)) || !is_numeric($termId)) { //@TODO: need to decide!!!!!!!!!
                $this->set('searchError', __('Selected <b>TERM</b> is not valid!'));
            } else {
                $conditions = array(
                    'StudentCycle.roll' => $roll,
                    'Student.status' => 1, //@TODO: what will happen if any student who took their TC, make a request for himself??
                    'StudentCycle.level_id' => $deptId,
                    'StudentCycle.group_id' => $groupId,
                    'StudentCycle.school_session_id' => $session
                );

                $student = $this->StudentCycle->find('first', array(
                    'conditions' => $conditions,
                    'fields' => array('StudentCycle.*'),
                    'order' => array('StudentCycle.level_id', 'StudentCycle.section_id', 'StudentCycle.roll'),
                    //'limit' => 1,
                    'recursive' => 0
                        ));
                // pr($student); die;
                //====Check Result Is Published or Not====:
                //if( 0 && $student['StudentCycle']['level_id'] == 10 && $termId==3 && '2013' == $session ){ //@TODO: WHY MANUAL!!!!!!!!!!!!!
                /* if( in_array($student['StudentCycle']['level_id'],array(3,4,6,7,9)) && $termId==2 && '2013' == $session ){
                  $this->set('searchError', __('The result is not published yet! Please try later.</br></br><b>THANK YOU</b>.'));

                  }else */
                if (empty($student['StudentCycle'])) {
                    $this->set('searchError', __('Invalid Roll or other inputs!'));
                } else {
                    $studentRslt = $this->StudentResult->find('first', array(
                        'fields' => array('StudentResult.id', 'SchoolTermCycle.id', 'SchoolTermCycle.is_published'),
                        'conditions' => array(
                            'StudentCycle.school_session_id' => $session,
                            //'Student.status' => 1,
                            //'Student.registration' => $registration,
                            //'StudentResult.term_id' => $termId,
                            'SchoolTermCycle.school_term_id' => $termId,
                            'SchoolTermCycle.is_published' => 1,
                            //'StudentResult.school_term_cycle_id' => $termId,

                            'StudentResult.student_cycle_id' => $student['StudentCycle']['id']
                        ),
                        //'limit' => 1,
                        'recursive' => 0
                            ));
                    //pr($studentRslt);
                    //die('??????');
                    $termInfos = $this->SchoolTermCycle->find('first', array('conditions' => array('SchoolTermCycle.school_term_id' => $termId, 'SchoolTermCycle.school_session_id' => $session, 'SchoolTermCycle.level_id' => $deptId, 'SchoolTermCycle.group_id' => $groupId), 'recursive' => -1));
                    if (empty($studentRslt['StudentResult']) || $termInfos['SchoolTermCycle']['is_published'] == 0) {
                        $this->set('searchError', __('Either the student did not appeared in this <b>TERM</b> or the result is not published yet! Please try later.</br></br><b>THANK YOU</b>.'));
                    } else {
                        if (!$this->request->is('post')) {//!empty($roll) ){
                            $this->layout = 'scms-result-print';
                            $this->set('title_for_layout', __('Marks Sheet'));
                            $showSearchForm = FALSE;
                        } else {
                            $this->set('bodyMinWidth', '1170px'); //public view in default.ctp;
                        }

                        //Enrich the conditions to find the requested student more accurately;
                        $conditions['StudentCycle.level_id'] = $level_id = $student['StudentCycle']['level_id'];
                        $conditions['StudentCycle.group_id'] = $group_id = $student['StudentCycle']['group_id'];
                        $conditions['StudentCycle.section_id'] = $section_id = $student['StudentCycle']['section_id'];

                        //Now Rock IT!
                        $termCycleId = $studentRslt['SchoolTermCycle']['id'];
                        $this->calculateResult($session, $termId, $termCycleId, $level_id, $section_id, $group_id, $conditions, true);
                    }
                }
            }
        }

        $this->set('showSearchForm', $showSearchForm);

        $this->set('schoolSessions', $this->SchoolSession->find('all', array(
                    'recursive' => -1
                )));
//        $allterms = array('1' => 'FINAL EXAMINATION');
//        $allterms = array('1' => 'FINAL EXAMINATION');
//        $this->set('terms', $allterms);  // to create dynamic terms unlock the next line
        $this->set('terms', $this->SchoolTerm->find('list', array('recursive' => -1, 'order' => array('SchoolTerm.id ASC'), 'limit' => 2)));
//        $this->set('terms', $this->SchoolTerm->find('list', array(
//                    /* 'conditions' => array(
//                      'SchoolTerm.school_session_id'=>date('Y')
//                      ), */
//                    //'fields' => array('Student.name','Student.roll','StudentCycle.roll'),
//                    'recursive' => -1
//                )));
        $this->setStudentFormAddEditVars($withCaps, array('levels', 'sections', 'groups', 'studentCourses'), compact('level_id', 'section_id', 'group_id'));
    }

    public function admin_index() {
        $this->layout = 'scms-esa';
        $this->set('title_for_layout', __('Result Sheet'));
        $level_id = $group_id = $section_id = $showCommonVers = NULL;
        $needPageRefresh = false;
        //Check Limit Access (whatever it is requested by form submission):
        $withCaps = $this->limitCapabilities($level_id, $section_id);
        if ($withCaps && empty($this->request->data['StudentResult']['level_id']) && empty($this->request->data['StudentResult']['section_id'])) {
            //Overwrite the form vars if any, otherwise set forcefully:
            $this->request->data['StudentResult']['level_id'] = $level_id;
            $this->request->data['StudentResult']['section_id'] = $section_id;
        }
        // searching
        if (!empty($this->request->data) && ($this->request->is('post'))) {
            $conditions = array();
            $conditions['StudentCycle.level_id'] = $level_id = $this->request->data['StudentResult']['level_id'];  //Here Tabulationsheet is only for form name not for model 
            $conditions['StudentCycle.section_id'] = $section_id = $this->request->data['StudentResult']['section_id'];
            $conditions['StudentCycle.group_id'] = $group_id = $this->request->data['StudentResult']['group_id'];
            $conditions['StudentCycle.school_session_id'] = $session = $this->request->data['StudentResult']['school_session_id']; //date('Y');
            $conditions['StudentCycle.roll'] = trim($this->request->data['StudentResult']['roll']);
            $conditions['Student.status'] = 1; //@TODO: need decessions here about the TC taken students !!!
            $conditions['Student.registration'] = trim($this->request->data['StudentResult']['registration']);
            $termId = $this->request->data['StudentResult']['term_id'];
            //$refered = $this->request->data['Tabulationsheet']['refered'];
            $conditions = array_filter($conditions);

            if (empty($level_id) || empty($session) || empty($termId) || empty($group_id) || (empty($section_id) && empty($conditions['Student.registration']))) {
                $this->Session->setFlash(__('Please select mendatory fields.'), 'default', array('class' => 'error'));
                $showCommonVers = TRUE;
            } elseif (!empty($conditions)) {
                //pr($this->request->data);
                $termCycleId = '';
                $needPageRefresh = $this->calculateResult($session, $termId, $termCycleId, $level_id, $section_id, $group_id, $conditions, false);
                $this->set('is_admin', 'admin');
                if (!$needPageRefresh) {
                    //pr($this->request->data);
                    //====== Marksheet Layout =========:
                    $sections = $this->Section->find('first', array('conditions' => array('Section.id' => $section_id), 'recursive' => -1));
                    $groups = $this->Group->find('first', array('conditions' => array('Group.id' => $this->request->data['StudentResult']['group_id']), 'recursive' => -1));
                    $this->layout = 'scms-result-print';
                    $this->view = 'index';
                    $this->set('sections', $sections);
                    $this->set('groups', $groups);
                    $this->set('title_for_layout', __('Student Result Sheet'));
                } else {
                    if (is_array($needPageRefresh))
                        $this->Session->setFlash(__('<b>Error-' . $needPageRefresh['status'] . '</b>:: ' . $needPageRefresh['msg']), 'default', array('class' => 'error'));
                    else
                        $this->Session->setFlash(__('The Result has been <b>Updated</b>; So please search again to get the recent changes.'), 'default', array('class' => 'success'));

                    //$this->redirect(array('action' => 'index'));
                    $showCommonVers = TRUE;
                }

                // All Courses in this section
                @$levelId = $this->request->data['StudentResult']['level_id'];
                $this->set('levelId', $levelId);
            }
        }else {
            $showCommonVers = TRUE;
        }

        if ($showCommonVers || $needPageRefresh) {
            //Get Non Related Info:
            $this->setStudentFormAddEditVars($withCaps, array('levels', 'sections', 'groups', 'studentCourses'), compact('level_id', 'section_id', 'group_id'));
        }

        //$this->set('school_sessions',array(date('Y')=>date('Y')));
        $this->set('schoolSessions', $this->SchoolSession->find('all', array(
                    'recursive' => -1
                )));
        $this->set('terms', $this->SchoolTerm->find('list', array('recursive' => -1, 'order' => array('SchoolTerm.id ASC'), 'limit' => 2)));
    }

    private function calculateResult($session, $termId, $termCycleId, $level_id, $section_id, $group_id, $conditions, $withFront) {
        $needPageRefresh = false;
        if ($termId != 1) {
            $mergedTerms = array(1);
        } else {
            $mergedTerms = array($termId);
        }

        $conditions = array_filter($conditions);

        $termDetails = $this->SchoolTermCycle->find('all', array(
            'conditions' => array(
                'SchoolTermCycle.school_term_id' => $mergedTerms,
                'SchoolTermCycle.school_session_id' => $session,
                'SchoolTermCycle.level_id' => $level_id,
                'SchoolTermCycle.group_id' => $group_id
            ),
            //'limit' => 1,
            'recursive' => 0,
            'order' => array('SchoolTermCycle.id' => 'asc') //'ASC' is very important!!
                ));

        $termInfos = $this->SchoolTermCycle->find('all', array(
            'conditions' => array(
                'SchoolTermCycle.school_term_id' => $termId,
                'SchoolTermCycle.school_session_id' => $session,
                'SchoolTermCycle.level_id' => $level_id,
                'SchoolTermCycle.group_id' => $group_id
            ),
            //'limit' => 1,
            'recursive' => 0,
            'order' => array('SchoolTermCycle.id' => 'asc') //'ASC' is very important!!
                ));
        //pr($termDetails);die;
        // if($termId==2){}
        //echo '===============termDetails===='; pr($termDetails);

        $textInfos = $this->Text->find('all', array(
            'conditions' => array(
                'Text.school_term_id' => $termId,
                'Text.school_session_id' => $session,
                'Text.level_id' => $level_id,
                'Text.group_id' => $group_id
            ),
            //'limit' => 1,
            'recursive' => 0,
            'order' => array('Text.id' => 'asc') //'ASC' is very important!!
                ));

        if (empty($termDetails))
            return array('status' => '002', 'msg' => 'The term is not available for this class!');

        if (empty($termCycleId))
            $termCycleId = $termDetails[count($termDetails) - 1]['SchoolTermCycle']['id'];

        $termList = array();
        foreach ($termDetails as $termDetail) {
            $termList[$termDetail['SchoolTerm']['id']] = $termDetail['SchoolTermCycle']['id'];
        }
        //pr($termList);die;
        //echo '===============termList===='; pr($termList);
        $this->StudentCycle->Behaviors->load('Containable', array('autoFields' => false));
        $students = $this->StudentCycle->find('all', array(//@TODO:: shouldnt be 'all' for the frontend visitors!!
            'conditions' => $conditions,
            'contain' => array(
                'Level', 'Group', 'SchoolSession',
                'Section' => array(
                    'Shift'
                ),
                'Student' => array(
                    'fields' => array('id', 'registration', 'name', 'gender', 'religion', 'date_of_birth', 'status'),
                    'Guardian' => array(
                        'fields' => array('id', 'student_id', 'name', 'rtype')
                    )
                ),
                'StudentResult' => array(
                    'fields' => array('id', 'student_cycle_id', 'course_parts_cycle_id', 'school_term_cycle_id', 'mark'),
                    'conditions' => array(
                        //'StudentResult.term_id' => $mergedTerms //@TODO: Need to find a better way;
                        'StudentResult.school_term_cycle_id' => $termList
                    ),
                    'CoursePartsCycle' => array(
                        'fields' => array('id', 'course_cycle_id', 'title', 'number', 'pass_number'),
                    //'CourseCycle'=>array(
                    //	'Course'
                    //)
                    )
                ),
                'StudentCourse',
                'StudentMerit' => array(
                    'conditions' => array('StudentMerit.school_term_cycle_id' => $termCycleId),
                )
            ),
            'order' => array('StudentCycle.level_id', 'StudentCycle.section_id', 'StudentCycle.roll'),
                //'recursive' => 1
                ));
        //echo '============$STUDENTS============'; pr($students);
        //echo count($students); die();

        if (empty($students) || empty($termDetails))
            return array('status' => '000', 'msg' => 'No student is found! Please refine your search!');

        //================== Student Compulsory Courses Here ==================
        $this->CourseCycle->Behaviors->load('Containable', array('autoFields' => false));
        $allCourses = $this->CourseCycle->find('all', array(
            'conditions' => array(
                'CourseCycle.level_id' => $level_id,
                'CourseCycle.group_id' => $group_id,
                'CourseCycle.school_session_id' => $session,
            // 'CourseCycle.group_id' => $group_id,
            //'Course.type'=> array('Compulsory','Islam','Hindu','Christian','Buddhist','Optional') //'Compulsory','Selective','Optional','Islam','Hindu','Christian','Buddhist'
            ),
            'contain' => array(
                //'Level', 'Section', 'Group','SchoolSession',//'CoursePartsCycle'
                'Course', 'CourseCycleTopscore'
            ),
            //'field'=>'',
            'order' => 'Course.code', //This order is important for merged course;
            'recursive' => 1 //it should be '0'; only to get 'CourseCycleTopscore', it is now '1';
                ));
        //  pr($allCourses); die;
        $courseNonGroupIDs = array();
        foreach ($allCourses as $course):
            if (!empty($course['CourseCycle']['group_id']) && ($course['Course']['type'] == 'Optional' || $course['Course']['type'] == 'Selective') && $course['CourseCycle']['group_id'] != $group_id) {
                $courseNonGroupIDs[] = $course['CourseCycle']['id'];
            }
        endforeach;
        $courses = $this->CourseCycle->find('all', array(
            'conditions' => array(
                'NOT' => array(
                    'CourseCycle.id' => $courseNonGroupIDs
                ),
                'CourseCycle.level_id' => $level_id,
                'CourseCycle.group_id' => $group_id,
                'CourseCycle.school_session_id' => $session,
                'Course.status' => 1
            // 'CourseCycle.group_id' => $group_id,
            //'Course.type'=> array('Compulsory','Islam','Hindu','Christian','Buddhist','Optional') //'Compulsory','Selective','Optional','Islam','Hindu','Christian','Buddhist'
            ),
            'contain' => array(
                //'Level', 'Section', 'Group','SchoolSession',//'CoursePartsCycle'
                'Course', 'CourseCycleTopscore'
            ),
            //'field'=>'',
            'order' => 'Course.code', //This order is important for merged course;
            'recursive' => 1 //it should be '0'; only to get 'CourseCycleTopscore', it is now '1';
                ));
        // pr($courses);
        //die;
        $this->set('allcourse', $courses); // EDITED FOR TABULATION SHEET @DIN 
        //echo '============$COURSES============'; pr($courses); die;
        //======================================================================
        $allMarks = array();
        $studentMerit = array();
        $highestCourseTotal = array();
        $highestCourseTotalMerged = array();
        $courseId = array();
        foreach ($courses as $coursesvalue) {
            $courseId[] = $coursesvalue['CourseCycle']['id'];
        }
        //pr($courseId);die;
        $stdId = 0;
        foreach ($students as $i => $student) {
            $stdId = $student['StudentCycle']['id'];
            $allMarks[$i]['StudentCycle'] = $student['StudentCycle'];
            $allMarks[$i]['Student'] = $student['Student']; //@TODO: minimize this array;
            $allMarks[$i]['Level'] = $student['Level']; //array('id'=>$student['Level']['id'],'name'=>$student['Level']['name']);
            $allMarks[$i]['Section'] = $student['Section']; //array('name'=>$student['Section']['name'],'shift'=>$student['Section']['shift']);
            $allMarks[$i]['Group'] = $student['Group']; //array('id'=>$student['Group']['id'],'name'=>$student['Group']['name']);
            //$allMarks[$i]['Attendence'] = $student['Attendence'];
            $profileAttributes = array();
            $myCourses = $courseMerged = $hasCourseMerged = array();
            //$totalMarks = $totalGP = $totalCr = $totalCrGp = $totalLetGpa = $totalLetterGrade = $optionalCount = $countMerged = $loop = $divBy = $failedCourse = array();
            $tk = 0; //just for counting Terms Loop;
            //pr($student);die;
            foreach ($termList as $termPrnt => $term) {
                $tk++;
                //===MAKE MARKS====
                $result = array();
                foreach ($student['StudentResult'] as $stResult) {
                    if ($stResult['school_term_cycle_id'] == $term && !empty($stResult['CoursePartsCycle'])) {
                        $courseCycleId = $stResult['CoursePartsCycle']['course_cycle_id'];
                        $courseCycleType = $stResult['CoursePartsCycle']['title']; //@TODO: make them('Written'|'MCQ'|'SBA'|'Practical') with a dropdown in view, so they don't varry;
                        $result[$courseCycleId][$courseCycleType] = array(
                            'course_parts_cycle_id' => $stResult['course_parts_cycle_id'],
                            'total_number' => $stResult['CoursePartsCycle']['number'],
                            'pass_number' => $stResult['CoursePartsCycle']['pass_number'],
                            'mark' => $stResult['mark']
                        );
                    }
                }
                $totalMarks[$term] = $totalGP[$term] = $optionalCount[$term] = $countMerged[$term] = $loop[$term] = $divBy[$term] = $failedCourse[$term] = 0;
                $totalCr = $totalCrGp = $totalLetterGrade = $totalLetGpa = 0;
                $courseMerged[$term]['bn']['pass'] = $courseMerged[$term]['en']['pass'] = TRUE; //????????????
                //$hasCourseMerged[$term] = FALSE;
                $highestCourseTotalMergedStdnt = $highestCourseTotalMergedDB = array();

                //===LOOP COURSES===

                foreach ($courses as $course) {
                    //pr($course); die;
                    //echo '================COURSE NAME: '. $course['Course']['name'].'========<br />';
                    $hasCourseMerged[$term] = FALSE;
                    //$resmidcontainer .= '<tr><td colspan="8">'.$course['Course']['type'].'>>>['.$course['Course']['id'].']-'.$course['Course']['name'].'</td></tr>';
                    $studentCourseIds = array();
                    $studentCourse3rdIds = array();
                    //pr(0);
                    if ($course['Course']['type'] == 'Optional') {
                        if (empty($student['StudentCourse'])) {
                            continue;
                        } else {
                            foreach ($student['StudentCourse'] as $scr) {
                                $studentCourseIds[$scr['type']][] = $scr['course_cycle_id'];
                            }
                            if (isset($studentCourseIds['3rd'])) {
                                foreach ($studentCourseIds['3rd'] as $third):
                                    $studentCourse3rdIds[] = $third;
                                endforeach;
                            }
                            if (isset($studentCourseIds['4th'])) {
                                foreach ($studentCourseIds['4th'] as $fourth):
                                    $studentCourse3rdIds[] = $fourth;
                                endforeach;
                            }
                            if (isset($studentCourseIds['5th'])) {
                                foreach ($studentCourseIds['5th'] as $fifth):
                                    $studentCourse3rdIds[] = $fifth;
                                endforeach;
                            }
                            if (isset($studentCourseIds['6th'])) {
                                foreach ($studentCourseIds['6th'] as $sixth):
                                    $studentCourse3rdIds[] = $sixth;
                                endforeach;
                            }
                            if (isset($studentCourseIds['7th'])) {
                                foreach ($studentCourseIds['7th'] as $seventh):
                                    $studentCourse3rdIds[] = $seventh;
                                endforeach;
                            }
                            if (!in_array($course['CourseCycle']['id'], $studentCourse3rdIds))
                                continue; //SKIP NON TAKEN OPTIONALs;
                        }
                    }

                    elseif ($course['Course']['type'] == 'Selective') {
                        if ($student['Group']['id'] != $course['CourseCycle']['group_id']) //Need to create same course for multiple groups !! Example: G.Science for Class-10, we will hav eto create 2 separate Course for Arts and Commerce; ?????????????
                            continue; //SKIP OTHER GROUPS;
                    }

                    else if (in_array($course['Course']['type'], array('Islam', 'Hindu', 'Christian', 'Buddhist'))) {
                        if ($student['Student']['religion'] != $course['Course']['type'])
                            continue; //SKIP OTHER RELIGIONAL Subjects;
                    }

                    else if (in_array($course['Course']['type'], array('Co-Activites', 'Characteristics'))) {
                        /*                      // EDITED FOR TABULATION SHEET @DIN  
                          if ($tk == 1) {
                          $profileAttributes[$course['Course']['type']]['Course'] = $course['Course'];
                          $profileAttributes[$course['Course']['type']]['CourseCycle'] = $course['CourseCycle']; //this is unnecessary, just to keep track;
                          }
                          if (!isset($result[$course['CourseCycle']['id']])) //No result is added for this course!!
                          return array('status' => '001', 'msg' => 'The result for the course <b>' . $course['Course']['name'] . '</b> is not inserted!!');
                          else
                          $profileAttributes[$course['Course']['type']]['marks'][$term] = $result[$course['CourseCycle']['id']]; */
                        continue; //SKIP Co-Curicular Activities/Achievements;
                    } elseif ($course['Course']['type'] != 'Compulsory') { //if above conditions fail, then it must be 'Compulsory';
                        continue; //SKIP NON MENDATORIES;
                    }

                    $loop[$term]++; //don't place it before the above IF/ELSE conditions;
                    //======Calculations=====
                    $crsCode = $course['Course']['code'];
                    $is3rd = $is4th = $isBangla = $isEnglish = FALSE;
                    if ($course['Course']['type'] == 'Optional') {
                        foreach ($studentCourseIds['4th'] as $fourth):
                            if ($fourth == $course['CourseCycle']['id'])
                                $is4th = TRUE;
                        endforeach;
                    }elseif ($level_id > 20 && !in_array($level_id, range(90, 100))) { //@TODO: Need to be dynamic for Nursery/Play range!!!			
                        if (in_array($crsCode, array('101', '102'))) //@TODO: is there any dynamic way?
                            $isBangla = TRUE;
                        elseif (in_array($crsCode, array('107', '108'))) //@TODO: is there any dynamic way?
                            $isEnglish = TRUE;
                        //pr($crsCode); die();
                    }
                    $curCCId = $course['CourseCycle']['id'];

                    //foreach( (array)$mergedTerms as $term ){
                    $addGP = 0.00;
                    $total = $subjectTotal = $addTotal = 0;
                    $addCr = 0.00;
                    $addCrGp = 0.00;
                    $subPartFailed = FALSE;
                    $GP = array('-', '-'); //array('F', 0.0); //  EDITED FOR TABULATION SHEET @DIN 
                    //$grade = '';
                    $marks = array('tc' => '--', 'tf' => '--', 'pc' => '--', 'pf' => '--');
                    if (empty($result) || !array_key_exists($curCCId, $result)) {
                        if (!$is4th)
                            $failedCourse[$term]++;
                        // else //No result is added for this course!!
                        // return array('status' => '001', 'msg' => 'The result set for the course <b>' . $course['Course']['name'] . '</b> is empty!!');
                    }else {
                        foreach (array('tc' => 'TC', 'tf' => 'TF', 'pc' => 'PC', 'pf' => 'PF') as $k => $part) {
                            if (!empty($result[$curCCId][$part])) {
                                $marks[$k] = array();
                                $marks[$k]['mark'] = trim($result[$curCCId][$part]['mark']);
                                if ($marks[$k]['mark'] == 'A') { //Absent;
                                    $marks[$k]['pass'] = 0;
                                } else { //Present:: so check Pass/Fail;
                                    $marks[$k]['mark'] = (float) $marks[$k]['mark'];
                                    $marks[$k]['pass'] = ($marks[$k]['mark'] >= $result[$curCCId][$part]['pass_number']);
                                    $marks[$k]['pass_number'] = $result[$curCCId][$part]['pass_number'];
                                    $marks[$k]['total_number'] = $result[$curCCId][$part]['total_number'];
                                    $subjectTotal += $result[$curCCId][$part]['total_number'];

                                    //total mark:
                                    if (!empty($marks[$k]['mark']))
                                        $total += $marks[$k]['mark'];
                                }

                                if ($level_id != 6 && !$subPartFailed && !$marks[$k]['pass']) {
                                    $subPartFailed = TRUE;
                                } elseif ($level_id == 6 && !$subPartFailed && in_array($k, array('pc', 'pf')) && !$marks[$k]['pass']) {
                                    $subPartFailed = TRUE;
                                }
                            }
                        }//endforeach;
                        if ($level_id == 6) {
                            if (isset($result[$curCCId]['TC']) || isset($result[$curCCId]['TF'])) {
                                if (isset($marks['tc']) || isset($marks['tf'])) {
                                    $totalMark = $marks['tc']['mark'] + $marks['tf']['mark'];
                                    $totalPass = $result[$curCCId]['TC']['pass_number'] + $result[$curCCId]['TF']['pass_number'];
                                    if ($totalMark < $totalPass) {
                                        $subPartFailed = TRUE;
                                    }
                                }
                            }
                        }

                        $GP = $subPartFailed ? array('F', 0.00) : $this->calcGradePoints($total, $subjectTotal, $GP);
                        $addCr = ($subjectTotal / 50);
                        $addCrGp = ($GP[1] * $addCr);
                        //$GP[1] = (float)$GP[1]; //?????
                        if ($GP[0] == 'F') {
                            $failedCourse[$term]++;
                        } else { //Skip scoring if the mendatories are failed;
                            $divBy[$term]++;
                            //$addTotal = $total;
                            $addGP = $GP[1];
                        }
                        $addTotal = $total; //added on 4th Oct;
                        $totalMarks[$term] += $addTotal;
                        $totalGP[$term] += $addGP;
                        $totalCr += $addCr;
                        $totalCrGp += $addCrGp;
                    }

                    //echo '>>>>>'.$crsCode.'-'.$GP[1].'-'.$addGP;
                    //======Calculate Course Highest================
                    //=============================================

                    if (empty($myCourses[$crsCode])) {
                        $myCourses[$crsCode] = array(
                            'Course' => $course['Course'],
                            'GP' => $GP,
                            'total' => $total,
                            'subjectTotal' => $subjectTotal,
                            'marks' => $marks
                        );
                    }
                } //end foreach::$courses;
            }//end foreach::$mergedTerms;
            $failStatus = FALSE;
            if ($failedCourse[$term] > 0) {
                //$totalGPA[$term] = 0.00;
                // $totalCr = 0.00;
                //$totalCrGp = 0.00;
                $failStatus = TRUE;
            } else {
                $divBy[$term] = $divBy[$term]; //$loop-$failedCourse-$optionalCount-$countMerged; //Don't be surprised!!
                $totalGPA[$term] = ($totalGP[$term] > 0 && $divBy[$term] > 0) ? round($totalGP[$term] / $divBy[$term], 2) : $totalGP[$term];
                $totalGPA[$term] = $totalGPA[$term] > 5.0 ? 5.00 : $totalGPA[$term];
            }
            //$totalGrade[$term] = $this->calculateGradeFromPoints($totalGPA[$term]);
            //$totalGpa = 0;
            if (!$failStatus) {
                $totalLetGpa = ($totalCrGp / $totalCr);
            } else {
                $totalLetGpa = 0.00;
            }

            $totalLetterGrade = $this->calculateGradeFromPoints($totalLetGpa);
            $allMarks[$i]['course'] = array(
                'gpa' => $totalLetGpa,
                'totalLetterGrade' => $totalLetterGrade,
                'myCourses' => $myCourses
            );

            /*       --------- code for refered student -----  written by arifur rahman -------- */
            $totaltermDetails = $this->SchoolTermCycle->find('all', array(
                'conditions' => array(
                    'SchoolTermCycle.school_session_id' => $session,
                    'SchoolTermCycle.level_id' => $level_id,
                    'SchoolTermCycle.group_id' => $group_id
                ),
                'recursive' => 0,
                'order' => array('SchoolTermCycle.id' => 'asc') //'ASC' is very important!!
                    ));
            // pr($totaltermDetails);die;
            unset($totaltermDetails[0]);
            //pr($termId);die;
            if ($termId != 1) {
                $stdGpa = $allMarks[$i]['course']['totalLetterGrade'];
                $improvementStatus = FALSE;
                if (!empty($totaltermDetails)) { // if refered term is created
                    $totaltermList = array();
                    foreach ($totaltermDetails as $totaltermDetail) {
                        $totaltermList[$totaltermDetail['SchoolTerm']['id']] = $totaltermDetail['SchoolTermCycle']['id'];
                    }
                    foreach ($totaltermList as $termPrnt => $refterm) {
                        $finalReferedResult = array(); // if refered mark is entry; save the array
                        foreach ($courseId as $courseid) { // all courses in current term
                            $individualcourses = $this->CourseCycle->find('all', array(
                                'conditions' => array(
                                    'CourseCycle.id' => $courseid,
                                ),
                                'contain' => array(
                                    'CoursePartsCycle' => array(
                                        'fields' => array('id', 'course_cycle_id', 'title', 'number', 'pass_number'),
                                        'conditions' => array(
                                            'CoursePartsCycle.course_cycle_id' => $courseid
                                        ),
                                    ),
                                ),
                                'recursive' => 1));
                            $individualcourse = $individualcourses[0]['CoursePartsCycle'];
                            foreach ($individualcourse as $individualcourseValue) {
                                $courseValue = array();
                                $type = array();
                                $coursecycleId = $individualcourseValue['course_cycle_id'];
                                $type = $individualcourseValue['title'];
                                $courseValue = $individualcourseValue['id'];
                                $stdReferedResult = array();
                                $stdReferedResult = $this->StudentResult->find('all', array('conditions' =>
                                    array('StudentResult.student_cycle_id' => $stdId, 'StudentResult.course_parts_cycle_id' => $courseValue,
                                        'StudentResult.school_term_cycle_id' => $refterm),
                                    'recursive' => -1));
                                if (!empty($stdReferedResult)) {
                                    $finalReferedResult[$coursecycleId][$type] = array(
                                        'course_parts_cycle_id' => $stdReferedResult['0']['StudentResult']['course_parts_cycle_id'],
                                        'total_number' => $individualcourseValue['number'],
                                        'pass_number' => $individualcourseValue['pass_number'],
                                        'mark' => $stdReferedResult['0']['StudentResult']['mark']);
                                }
                            }
                        }
                        if (!empty($finalReferedResult)) {  // if refered mark give entry
                            //pr($finalReferedResult);die;
                            $improvementStatus = TRUE;
                            foreach ($courses as $course) {
                                $refcurCCId = $course['CourseCycle']['id'];
                                if (!array_key_exists($refcurCCId, $finalReferedResult)) {
                                    continue;
                                } else {
                                    $addGP = 0.00;
                                    $addCr = 0.00;
                                    $addCrGp = 0.00;
                                    $addcurCrGp = 0.00;
                                    $total = $subjectTotal = $addTotal = 0;
                                    $subPartFailed = FALSE;
                                    $GP = array('F', 0.0);
                                    $rcCode = $course['Course']['code'];
                                    $refcrsCode = $course['Course']['code'];
                                    $marks = array('tc' => '--', 'tf' => '--', 'pc' => '--', 'pf' => '--');
                                    foreach (array('tc' => 'TC', 'tf' => 'TF', 'pc' => 'PC', 'pf' => 'PF') as $k => $part) {
                                        if (!empty($finalReferedResult[$refcurCCId][$part])) {
                                            $marks[$k] = array();
                                            $marks[$k]['mark'] = trim($finalReferedResult[$refcurCCId][$part]['mark']);
                                            $marks[$k]['mark'] = (float) $marks[$k]['mark'];
                                            $marks[$k]['pass'] = ($marks[$k]['mark'] >= $finalReferedResult[$refcurCCId][$part]['pass_number']);
                                            $marks[$k]['pass_number'] = $finalReferedResult[$refcurCCId][$part]['pass_number'];
                                            $marks[$k]['total_number'] = $finalReferedResult[$refcurCCId][$part]['total_number'];
                                            $subjectTotal += $finalReferedResult[$refcurCCId][$part]['total_number'];
                                            //total mark:
                                            if (!empty($marks[$k]['mark']))
                                                $total += $marks[$k]['mark'];

                                            if ($level_id != 6 && !$subPartFailed && !$marks[$k]['pass']) {
                                                $subPartFailed = TRUE;
                                            } elseif ($level_id == 6 && !$subPartFailed && in_array($k, array('pc', 'pf')) && !$marks[$k]['pass']) {
                                                $subPartFailed = TRUE;
                                            }
                                        }
                                    }
                                    if ($level_id == 6) {
                                        if (isset($finalReferedResult[$refcurCCId]['TC']) || isset($finalReferedResult[$refcurCCId]['TF'])) {
                                            if (isset($marks['tc']) || isset($marks['tf'])) {
                                                $totalMark = $marks['tc']['mark'] + $marks['tf']['mark'];
                                                $totalPass = $finalReferedResult[$refcurCCId]['TC']['pass_number'] + $finalReferedResult[$refcurCCId]['TF']['pass_number'];
                                                if ($totalMark < $totalPass) {
                                                    $subPartFailed = TRUE;
                                                }
                                            }
                                        }
                                    }
                                    $GP = $subPartFailed ? array('F', 0.00) : $this->calcGradePoints($total, $subjectTotal, $GP);
                                    //  foreach ($myCourses as $orgterm => $orgvalue) {

                                    $prevTotal = $prevGpa = 0;
                                    foreach ($myCourses as $orgkey => $orgval) {
                                        if ($rcCode == $orgkey) {
                                            if ($GP[1] >= $orgval['GP'][1]) {
                                                $addCr = ($myCourses[$orgkey]['subjectTotal'] / 50);
                                                $addCrGp = ($myCourses[$orgkey]['GP'][1] * $addCr);
                                                //$totalCr = $addCr;
                                                $totalCrGp -= $addCrGp; // necesssary for improvement
                                                $addcurCrGp = ($GP[1] * $addCr);
                                                $totalCrGp += $addcurCrGp;
                                                //pr($totalCrGp); die;
                                                unset($myCourses[$orgkey]);
                                                $myCourses[$rcCode] = array(
                                                    'Course' => $course['Course'],
                                                    'GP' => $GP,
                                                    'total' => $total,
                                                    'subjectTotal' => $subjectTotal,
                                                    'marks' => $marks
                                                );
                                            }
                                            break;
                                        }
                                    }
                                    //    }
                                }
                            }//end course;
                        }
                    }//end refered termlist;
                    //pr($myCourses);die;
                    if ($improvementStatus == FALSE && $stdGpa != 'F') {
                        // pr($allMarks[$i]);die;
                        unset($allMarks[$i]);
                    } else {
                        $obtainGp = array();
                        foreach ($myCourses as $calcourse) {
                            if ($calcourse['GP'][0] == 'F') {
                                $obtainGp[] = $calcourse['GP'][0];
                            }
                        }
                        if (!in_array('F', $obtainGp)) {
                            $totalGpa = $totalCrGp / $totalCr;
                        } else {
                            $totalGpa = 0.00;
                        }
                        $totalLetterGrade = $this->calculateGradeFromPoints($totalGpa);
                        $allMarks[$i]['course'] = array(
                            'gpa' => $totalGpa,
                            'totalLetterGrade' => $totalLetterGrade,
                            'myCourses' => $myCourses
                        );
                    }
                }
            }
        }
        foreach ($allMarks as $k=>$student):
            $i = 0;
            $failedCourse = array();
            foreach ($student['course']['myCourses'] as $course) {
                if ($course['GP'][0] == 'F') {
                    $failedCourse[] = substr($course['Course']['code'], 3);
                    $i++;
                }
            }
            if ($i > 2 && $termInfos[0]['SchoolTerm']['id']) {
               unset($allMarks[$k]);
            }
        endforeach;
        //pr($allMarks);die;
        unset($students);
        unset($courses);

        $this->set('termId', $termId);
        //$this->set('termCycleId', $termCycleId);
        $this->set(compact('allMarks'));
        $this->set('SchoolTerm', $termInfos);
        $this->set('textInfos', $textInfos);
        unset($allMarks);
        return $needPageRefresh;
    }

    public function admin_refered_addedit() {
        $this->layout = 'scms-esa';
        $title = 'Search';
        $level_id = $section_id = $group_id = NULL;
        //Check Limit Access (whatever it is requested by form submission):
        $withCaps = $this->limitCapabilities($level_id, $section_id);
        if ($withCaps && empty($this->request->data['StudentResult']['level_id']) && empty($this->request->data['StudentResult']['section_id'])) {
            //Overwrite the form vars if any, otherwise set forcefully:
            $this->request->data['StudentResult']['level_id'] = $level_id;
            $this->request->data['StudentResult']['section_id'] = $section_id;
        }
        //Set Default cTypes From Courses Controller;
        App::import('Controller', 'Courses');
        $CourseCont = new CoursesController();
        $cTypes = $CourseCont->cTypes;
        $courseType = 0; //default;
        if (!empty($this->request->data) && ($this->request->is('post'))) {
            //echo '==========$this->request->data=============='; 
            // pr($this->request->data); die();
            $term_id = $this->request->data['StudentResult']['term_id'];
            $course_id = $this->request->data['StudentResult']['studentCourse_id'];
            $courseInfo = $this->CourseCycle->find('first', array('conditions' => array('CourseCycle.id' => $course_id)));
            $this->set('courseInfo', $courseInfo);
            $level_id = $this->request->data['StudentResult']['level_id'];
            @$group_id = $this->request->data['StudentResult']['group'];
            $section_id = $this->request->data['StudentResult']['section_id'];
            $session = $this->request->data['StudentResult']['school_session_id'];
            $this->set('sesId', $session);
            $termDetails = $this->SchoolTermCycle->find('first', array(
                //'fields' => array('SchoolTermCycle.school_term_id','SchoolTermCycle.id'),
                'conditions' => array(
                    //'SchoolTerm.id' => $termId,
                    'SchoolTermCycle.school_term_id' => $term_id,
                    'SchoolTermCycle.school_session_id' => $session,
                    'SchoolTermCycle.level_id' => $level_id,
                    'SchoolTermCycle.group_id' => $group_id
                ),
                //'limit' => 1,
                'recursive' => -1
                    ));
            //echo '==========$termDetails========'; 
//            pr($termDetails);
//            die();
            if (!empty($this->request->data['mark'])) {
                $courseType = $this->request->data['Course']['ctype']; //should be similar as in view;
                //PROCESS Student Results:
                $arr = array();
                $this->StudentResult->create();
                foreach ($this->request->data['mark'] as $student_cycle_id => $courtsParts) {

                    if (!empty($courtsParts)) {
                        if ($courseType == 2) {
                            $cpcId = $courtsParts['v'];
                            unset($courtsParts['v']);
                        }

                        if (!empty($courtsParts)) {
                            foreach ($courtsParts as $cpc_id => $mark) {
                                if ($courseType == 2)
                                    $mark['v'] = $cpcId == $cpc_id ? 1 : 0;
                                if (!empty($mark['v']) || is_numeric($mark['v'])) {    // to omit the blank cell 
                                    $arr[] = array('StudentResult' => array(
                                            'id' => (empty($mark['id']) ? 0 : $mark['id']),
                                            'student_cycle_id' => $student_cycle_id,
                                            'course_parts_cycle_id' => $cpc_id,
                                            //'term_id' => $term_id,
                                            'school_term_cycle_id' => $termDetails['SchoolTermCycle']['id'], //$term_id,
                                            'mark' => $mark['v']
                                            ));
                                }
                            }
                        }
                    }
                }
                //echo '============$arr==========='; 
                if (!empty($arr))
                    $this->StudentResult->saveAll($arr);

                $this->Session->setFlash(__('The Student Result has been saved'), 'default', array('class' => 'success'));
                //$this->redirect(array('action' => 'addedit'));
            }
//            else {
            //============PREPARE FORM VARS================
            if (empty($level_id) || empty($section_id) || empty($session) || empty($course_id) || empty($term_id)) {
                $this->Session->setFlash(__('Please select all fields.'), 'default', array('class' => 'error'));
            } else {
                $title = 'Add';
                $noStudent = false;
                $group_id = $this->Session->read('group');
                //pr($group_id);die;
                $this->CourseCycle->Behaviors->load('Containable', array('autoFields' => false));
                $courseCycle = $this->CourseCycle->find('first', array(
                    'conditions' => array(
                        'CourseCycle.course_id' => $course_id,
                        'CourseCycle.level_id' => $level_id,
                        'CourseCycle.group_id' => $group_id,
                        'CourseCycle.school_session_id' => $session//date('Y')
                    ),
                    'contain' => array(
                        'Level', 'Group', 'Course', 'SchoolSession', 'CourseCycleTopscore', 'StudentCourse', 'TeacherCourse',
                        'CoursePartsCycle' => array(
                            'conditions' => array('NOT' => array(
                                    'CoursePartsCycle.number' => 0,
                                    'CoursePartsCycle.pass_number' => 0
                                ),
                            ),
                        )
                    ),
                    //'fields' => array('Student.sid'),
                    //'order' => array('Student.sid DESC'),
                    'recursive' => 1
                        ));
                //echo "==========courseCycle========";
                // pr($courseCycle); die;

                $cond = array(
                    'StudentCycle.level_id' => $level_id,
                    'StudentCycle.section_id' => $section_id,
                    'StudentCycle.group_id' => $group_id,
                    'StudentCycle.school_session_id' => $session, //date('Y'),
                    'Student.status' => 1 //?????????????? Added on 4th Oct'2013; Before publishing exam result if any student take TC, thene there will be a problem. Teachers won't be able to enter his result;
                );

                if (empty($courseCycle['Course']['type'])) {
                    $this->Session->setFlash(__('The course setting is invalid! Course Type should not be EMPTY!!'), 'default', array('class' => 'error'));
                } else {
                    //========If subject is Religious=======:
                    if (($crseType = preg_replace(array('/Compulsory/', '/Selective/', '/Optional/', '/,/'), '', $courseCycle['Course']['type']))
                            && in_array($crseType, array('Islam', 'Hindu', 'Christian', 'Buddhist'))
                    ) {
                        $cond['Student.religion'] = $crseType;
                    }
                    //======================================

                    if ($courseCycle['Course']['type'] == 'Co-Activites')
                        $courseType = 1; //should be similar as in view;
                    elseif ($courseCycle['Course']['type'] == 'Characteristics')
                        $courseType = 2; //should be similar as in view;                     
//===If subject is Selective/Optional===:
                    elseif (false === strpos($courseCycle['Course']['type'], 'Compulsory')) {
                        if (false !== strpos($courseCycle['Course']['type'], 'Selective')) {
                            if (empty($courseCycle['CourseCycle']['group_id'])) {
                                $noStudent = true;
                                $this->Session->setFlash(__('The course is Selective, but the course has no group!!'), 'default', array('class' => 'error'));
                            } else {
                                $cond['StudentCycle.group_id'] = $courseCycle['CourseCycle']['group_id'];
                            }
                        } elseif (false !== strpos($courseCycle['Course']['type'], 'Optional')) {
                            if (empty($courseCycle['StudentCourse'])) {
                                $noStudent = true;
                                $this->Session->setFlash(__('The course is Optional, but none of the student has chossen it!!'), 'default', array('class' => 'error'));
                            } else {
                                $cond['StudentCycle.id'] = array();
                                foreach ($courseCycle['StudentCourse'] as $std) {
                                    $cond['StudentCycle.id'][] = $std['student_cycle_id'];
                                }
                            }
                        }
                    }
                    //======================================
                }
                //  pr($cond); die;
                //echo "==========cond========"; 
                $students = $noStudent ? array() : $this->StudentCycle->find('all', array(
                            'conditions' => $cond,
                            'fields' => array('Student.name', 'Student.registration', 'StudentCycle.roll'),
                            'order' => array('StudentCycle.level_id', 'StudentCycle.section_id', 'StudentCycle.roll'),
                            'recursive' => 0,
                                //'limit'=>4 //????????????????????????????????????????????/
                        ));
                // pr($students);die;
                //echo "==========students========"; pr($students);
                //=============ONLY FOR EDIT=====================
                $cpIds = array();
                foreach ($courseCycle['CoursePartsCycle'] as $c) {
                    $cpIds[] = array('StudentResult.course_parts_cycle_id' => $c['id']);
                }
                $studentR = $this->StudentResult->find('all', array(
                    'conditions' => array(
                        'OR' => $cpIds,
                        'StudentResult.school_term_cycle_id' => $termDetails['SchoolTermCycle']['id'], //$term_id,
                        'CoursePartsCycle.course_cycle_id' => $courseCycle['CourseCycle']['id']
                    ),
                    //'fields' => array('StudentResult.mark','StudentResult.student_cycle_id'),
                    'recursive' => 0
                        ));
                //echo "==========studentR========"; pr($studentR);
                //$db = $this->StudentResult->getDataSource();
                //$studentR = $db->fetchAll('SELECT * FROM student_results WHERE term_id = ? AND course_parts_cycle_id = ? ',array($term_id,$courseCycle['CoursePartsCycle'][0]['id']));
                if (!empty($studentR)) {
                    $title = 'Edit';
                }
                $this->set('studentR', $studentR);
                //=================================================
                $this->set('students', $students);
                //$this->set('course_parts_cycles',$course_parts_cycles);
                $this->set('courseCycles', $courseCycle);
                $this->SchoolTerm->id = $term_id;
                $this->set('termName', $this->SchoolTerm->field('name'));
                $this->set('sectionRow', $this->Section->find('first', array('conditions' => array('id' => $section_id), 'recursive' => -1)));
            }
            //}
        }
        $this->set('title_for_layout', __($title . ' Result'));
        $this->set('schoolSessions', $this->SchoolSession->find('list', array(
                    'recursive' => -1
                )));
        $allterms = $this->SchoolTerm->find('list', array('recursive' => -1, 'order' => array('SchoolTerm.id ASC'), 'limit' => 2));
        unset($allterms[1]);
        $this->set('terms', $allterms);

        //Get Non Related Info:
        $type = '';
        $this->setStudentFormAddEditVars($withCaps, array('levels', 'sections', 'shifts', 'groups', 'studentCourses'), compact('level_id', 'section_id', 'group_id', 'type'));
        $this->set('cTypes', $cTypes);
        $this->set('courseType', $courseType);
        $this->set('schoolSessions', $this->SchoolSession->find('all', array(
                    'recursive' => -1
                )));
    }

    public function admin_addedit() {
        $this->layout = 'scms-esa';
        $title = 'Search';
        $level_id = $section_id = $group_id = NULL;
        //Check Limit Access (whatever it is requested by form submission):
        $withCaps = $this->limitCapabilities($level_id, $section_id);
        if ($withCaps && empty($this->request->data['StudentResult']['level_id']) && empty($this->request->data['StudentResult']['section_id'])) {
            //Overwrite the form vars if any, otherwise set forcefully:
            $this->request->data['StudentResult']['level_id'] = $level_id;
            $this->request->data['StudentResult']['section_id'] = $section_id;
        }
        //Set Default cTypes From Courses Controller;
        App::import('Controller', 'Courses');
        $CourseCont = new CoursesController();
        $cTypes = $CourseCont->cTypes;
        $courseType = 0; //default;
        if (!empty($this->request->data) && ($this->request->is('post'))) {
            //echo '==========$this->request->data=============='; 
            // pr($this->request->data); die();
            $term_id = $this->request->data['StudentResult']['term_id'];
            $course_id = $this->request->data['StudentResult']['studentCourse_id'];
            $courseInfo = $this->CourseCycle->find('first', array('conditions' => array('CourseCycle.id' => $course_id)));
            $this->set('courseInfo', $courseInfo);
            $level_id = $this->request->data['StudentResult']['level_id'];
            @$group_id = $this->request->data['StudentResult']['group'];
            $section_id = $this->request->data['StudentResult']['section_id'];
            $session = $this->request->data['StudentResult']['school_session_id'];
            $this->set('sesId', $session);
            $termDetails = $this->SchoolTermCycle->find('first', array(
                //'fields' => array('SchoolTermCycle.school_term_id','SchoolTermCycle.id'),
                'conditions' => array(
                    //'SchoolTerm.id' => $termId,
                    'SchoolTermCycle.school_term_id' => $term_id,
                    'SchoolTermCycle.school_session_id' => $session,
                    'SchoolTermCycle.level_id' => $level_id,
                    'SchoolTermCycle.group_id' => $group_id
                ),
                //'limit' => 1,
                'recursive' => -1
                    ));
            //echo '==========$termDetails========'; 
            if (!empty($this->request->data['mark'])) {
                $courseType = $this->request->data['Course']['ctype']; //should be similar as in view;
                //PROCESS Student Results:
                $arr = array();
                $this->StudentResult->create();
                foreach ($this->request->data['mark'] as $student_cycle_id => $courtsParts) {
                    if (!empty($courtsParts)) {
                        if ($courseType == 2) {
                            $cpcId = $courtsParts['v'];
                            unset($courtsParts['v']);
                        }

                        if (!empty($courtsParts)) {
                            foreach ($courtsParts as $cpc_id => $mark) {
                                if ($courseType == 2)
                                    $mark['v'] = $cpcId == $cpc_id ? 1 : 0;

                                $arr[] = array('StudentResult' => array(
                                        'id' => (empty($mark['id']) ? 0 : $mark['id']),
                                        'student_cycle_id' => $student_cycle_id,
                                        'course_parts_cycle_id' => $cpc_id,
                                        //'term_id' => $term_id,
                                        'school_term_cycle_id' => $termDetails['SchoolTermCycle']['id'], //$term_id,
                                        'mark' => (empty($mark['v']) ? '0' : $mark['v'])
                                        ));
                            }
                        }
                    }
                }
                //echo '============$arr==========='; 
                pr($arr); die;
                if (!empty($arr))
                    $this->StudentResult->saveAll($arr);

                $this->Session->setFlash(__('The Student Result has been saved'), 'default', array('class' => 'success'));
                //$this->redirect(array('action' => 'addedit'));
            }
//            else {
            //============PREPARE FORM VARS================
            if (empty($level_id) || empty($section_id) || empty($session) || empty($course_id) || empty($term_id)) {
                $this->Session->setFlash(__('Please select all fields.'), 'default', array('class' => 'error'));
            } else {
                $title = 'Add';
                $noStudent = false;
                $group_id = $this->Session->read('group');
                //pr($group_id);die;
                $this->CourseCycle->Behaviors->load('Containable', array('autoFields' => false));
                $courseCycle = $this->CourseCycle->find('first', array(
                    'conditions' => array(
                        'CourseCycle.course_id' => $course_id,
                        'CourseCycle.level_id' => $level_id,
                        'CourseCycle.group_id' => $group_id,
                        'CourseCycle.school_session_id' => $session//date('Y')
                    ),
                    'contain' => array(
                        'Level', 'Group', 'Course', 'SchoolSession', 'CourseCycleTopscore', 'StudentCourse', 'TeacherCourse',
                        'CoursePartsCycle' => array(
                            'conditions' => array('NOT' => array(
                                    'CoursePartsCycle.number' => 0,
                                    'CoursePartsCycle.pass_number' => 0
                                ),
                            ),
                        )
                    ),
                    //'fields' => array('Student.sid'),
                    //'order' => array('Student.sid DESC'),
                    'recursive' => 1
                        ));
                //echo "==========courseCycle========";
                $cond = array(
                    'StudentCycle.level_id' => $level_id,
                    'StudentCycle.section_id' => $section_id,
                    'StudentCycle.group_id' => $group_id,
                    'StudentCycle.school_session_id' => $session, //date('Y'),
                    'Student.status' => 1 //?????????????? Added on 4th Oct'2013; Before publishing exam result if any student take TC, thene there will be a problem. Teachers won't be able to enter his result;
                );
                //pr($cond); die;
                if (empty($courseCycle['Course']['type'])) {
                    $this->Session->setFlash(__('The course setting is invalid! Course Type should not be EMPTY!!'), 'default', array('class' => 'error'));
                } else {
                    //========If subject is Religious=======:
                    if (($crseType = preg_replace(array('/Compulsory/', '/Selective/', '/Optional/', '/,/'), '', $courseCycle['Course']['type']))
                            && in_array($crseType, array('Islam', 'Hindu', 'Christian', 'Buddhist'))
                    ) {
                        $cond['Student.religion'] = $crseType;
                    }
                    //======================================

                    if ($courseCycle['Course']['type'] == 'Co-Activites')
                        $courseType = 1; //should be similar as in view;
                    elseif ($courseCycle['Course']['type'] == 'Characteristics')
                        $courseType = 2; //should be similar as in view;                     
//===If subject is Selective/Optional===:
                    elseif (false === strpos($courseCycle['Course']['type'], 'Compulsory')) {
                        if (false !== strpos($courseCycle['Course']['type'], 'Selective')) {
                            if (empty($courseCycle['CourseCycle']['group_id'])) {
                                $noStudent = true;
                                $this->Session->setFlash(__('The course is Selective, but the course has no group!!'), 'default', array('class' => 'error'));
                            } else {
                                $cond['StudentCycle.group_id'] = $courseCycle['CourseCycle']['group_id'];
                            }
                        } elseif (false !== strpos($courseCycle['Course']['type'], 'Optional')) {
                            if (empty($courseCycle['StudentCourse'])) {
                                $noStudent = true;
                                $this->Session->setFlash(__('The course is Optional, but none of the student has chossen it!!'), 'default', array('class' => 'error'));
                            } else {
                                $cond['StudentCycle.id'] = array();
                                foreach ($courseCycle['StudentCourse'] as $std) {
                                    $cond['StudentCycle.id'][] = $std['student_cycle_id'];
                                }
                            }
                        }
                    }
                    //======================================
                }
                //  pr($cond); die;
                //echo "==========cond========"; 
                $students = $noStudent ? array() : $this->StudentCycle->find('all', array(
                            'conditions' => $cond,
                            'fields' => array('Student.name', 'Student.registration', 'StudentCycle.roll'),
                            'order' => array('StudentCycle.level_id', 'StudentCycle.section_id', 'StudentCycle.roll'),
                            'recursive' => 0,
                                //'limit'=>4 //????????????????????????????????????????????/
                        ));
                 //pr($students);die;
                //echo "==========students========"; pr($students);
                //=============ONLY FOR EDIT=====================
                $cpIds = array();
                foreach ($courseCycle['CoursePartsCycle'] as $c) {
                    $cpIds[] = array('StudentResult.course_parts_cycle_id' => $c['id']);
                }
                //pr($cpIds);die;
                $studentR = $this->StudentResult->find('all', array(
                    'conditions' => array(
                        'OR' => $cpIds,
                        'StudentResult.school_term_cycle_id' => $termDetails['SchoolTermCycle']['id'], //$term_id,
                        'CoursePartsCycle.course_cycle_id' => $courseCycle['CourseCycle']['id']
                    ),
                    //'fields' => array('StudentResult.mark','StudentResult.student_cycle_id'),
                    'recursive' => 0
                        ));
                //pr($studentR);die;
                //echo "==========studentR========"; pr($studentR);
                //$db = $this->StudentResult->getDataSource();
                //$studentR = $db->fetchAll('SELECT * FROM student_results WHERE term_id = ? AND course_parts_cycle_id = ? ',array($term_id,$courseCycle['CoursePartsCycle'][0]['id']));
                if (!empty($studentR)) {
                    $title = 'Edit';
                }
                $this->set('studentR', $studentR);
                //=================================================
                $this->set('students', $students);
                //$this->set('course_parts_cycles',$course_parts_cycles);
                $this->set('courseCycles', $courseCycle);
                $this->SchoolTerm->id = $term_id;
                $this->set('termName', $this->SchoolTerm->field('name'));
                $this->set('sectionRow', $this->Section->find('first', array('conditions' => array('id' => $section_id), 'recursive' => -1)));
            }
            //}
        }

        //else {
        //$this->Session->setFlash(__('The Student Result could not be saved. Please, try again.'), 'default', array('class' => 'error'));
        //$this->redirect(array('action' => 'index'));
        //}

        $this->set('title_for_layout', __($title . ' Result'));
        $this->set('schoolSessions', $this->SchoolSession->find('list', array(
                    'recursive' => -1
                )));
        //$allterms = array('1' => 'FINAL EXAMINATION');
        //$this->set('terms', $allterms);  // to create dynamic terms unlock the next line
        $this->set('terms', $this->SchoolTerm->find('list', array('recursive' => -1, 'order' => array('SchoolTerm.id ASC'), 'limit' => 1)));
        //Get Non Related Info:
        $type = '';
        $this->setStudentFormAddEditVars($withCaps, array('levels', 'sections', 'shifts', 'groups', 'studentCourses'), compact('level_id', 'section_id', 'group_id', 'type'));
        $this->set('cTypes', $cTypes);
        $this->set('courseType', $courseType);
        $this->set('schoolSessions', $this->SchoolSession->find('all', array(
                    'recursive' => -1
                )));
    }

    public function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Result'), 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->StudentResult->delete($id)) {
            $this->Session->setFlash(__('Result deleted'), 'default', array('class' => 'success'));
            $this->redirect(array('action' => 'index'));
        }
    }

    public function admin_publish() {
        $this->layout = 'scms-esa';
        $this->set('title_for_layout', __('Result Publish'));
        $level_id = $showCommonVers = NULL;
        $withCaps = $this->limitCapabilities($level_id, $group_id);
        if ($withCaps && empty($this->request->data['StudentResult']['level_id']) && empty($this->request->data['StudentResult']['group_id'])) {
            $this->request->data['StudentResult']['level_id'] = $level_id;
            //$this->request->data['StudentResult']['group_id'] = $group_id;
        }
        if (!empty($this->request->data) && ($this->request->is('post'))) {
            //pr($this->request->data); die();
            $term_id = $this->request->data['StudentResult']['term_id'];
            $session = $this->request->data['StudentResult']['school_session_id'];

            if (!empty($this->request->data['pub'])) {
                //pr($this->request->data['pub']);
                $subTerms = $levels = array();
                foreach ($this->request->data['pub'] as $k => $pub) {
                    if ($pub['is_published'] && empty($pub['published_on']))
                        $this->request->data['pub'][$k]['published_on'] = date('Y-m-d H:i:s');
                    if ($pub['is_sms_sent'] && empty($pub['sms_sent_on'])) {
                        $this->request->data['pub'][$k]['sms_sent_on'] = date('Y-m-d H:i:s');

                        //Send SMS only for these classes:
                        $subTerms[] = $pub['id'];
                        $levels = $pub['level_id'];
                        $groups[] = $pub['group_id'];
                    }
                }
                //pr($this->request->data['pub']);
                $this->SchoolTermCycle->create();
                $this->SchoolTermCycle->saveMany($this->request->data['pub']);
                $fMsg = 'Sub Terms are saved.';
                //pr($levels); 
                //pr($groups); die;
                //=====SEND SMS=====
                if (!(empty($levels) || empty($groups) || empty($subTerms))) {
                    $students = $this->StudentCycle->find('all', array(
                        'conditions' => array(
                            //'StudentCycle.section_id'=>$section_id,
                            'StudentCycle.level_id' => $levels,
                            'StudentCycle.group_id' => 7,
                            'StudentCycle.school_session_id' => 2018, //date('Y'),
                            //'Student.active_guardian'=>1, //[1='Father'|2='Mother'|3='Other']
                            'Guardian.rtype = Student.active_guardian', //only active guardians;
                        //'Attendence.id IS NULL' //select only absent student;
                        ),
                        'fields' => array('Student.name', 'Student.registration', 'StudentCycle.id', 'StudentCycle.roll', 'StudentMerit.*', 'Guardian.mobile', 'Level.name', 'Section.name', 'Group.name'), //==>DEBUG;
                        //'fields' => array('Guardian.mobile','Student.name'),
                        'joins' => array(
                            array(
                                'table' => 'guardians',
                                'alias' => 'Guardian',
                                'type' => 'INNER',
                                'conditions' => array(
                                    'Guardian.student_id = StudentCycle.student_id',
                                    'Guardian.mobile IS NOT NULL' //if there is no number, SKIP it;
                                )
                            ),
                            array(
                                'table' => 'student_merits',
                                'alias' => 'StudentMerit',
                                'type' => 'INNER',
                                'conditions' => array(
                                    'StudentMerit.student_cycle_id = StudentCycle.id',
                                    'StudentMerit.school_term_cycle_id' => $subTerms
                                )
                            )
                        ),
                        //'limit' => 5,
                        'recursive' => 0
                            ));
                    //echo '============$STUDENTS============'; 
                    if (!empty($students)) {
                        $termName = $this->SchoolTerm->field('name', array('id' => $term_id), null);
                        $smsCnt = $this->sendSMS('result-publish', $students, array('term-name' => $termName, 'levels' => $levels));
                    }

                    $fMsg .= " [" . (empty($smsCnt) ? 0 : $smsCnt) . " SMS request is sent]";
                } else {
                    $fMsg .= " [No SMS request is made/sent]";
                }

                $this->Session->setFlash(__($fMsg), 'default', array('class' => 'success'));
            }

            $termDetails = $this->SchoolTermCycle->find('all', array(
                //'fields' => array('SchoolTermCycle.school_term_id','SchoolTermCycle.id'),
                'conditions' => array(
                    //'SchoolTerm.id' => $termId,
                    'SchoolTermCycle.level_id' => @$this->request->data['StudentResult']['level_id'],
                    //'SchoolTermCycle.group_id' => $group_id,
                    'SchoolTermCycle.school_term_id' => $term_id,
                    'SchoolTermCycle.school_session_id' => $session
                ),
                //'limit' => 1,
                'recursive' => 0
                    ));
            //pr($term_id); die;
            $this->set('termDetails', $termDetails);
        }

        $this->set('scmsClassNames', $this->scmsClassNames);
        $this->set('schoolSessions', $this->SchoolSession->find('list', array(
                    'recursive' => -1
                )));
        $allterms = $this->SchoolTerm->find('list', array('recursive' => -1, 'order' => array('SchoolTerm.id ASC'), 'limit' => 2));
        //unset($allterms[1]);
        $this->set('terms', $allterms);
        $this->setStudentFormAddEditVars($withCaps, array('levels', 'sections', 'groups', 'studentCourses'), compact('level_id', 'section_id', 'group_id'));
    }

    public function dept_ajax() {
        $depId = $_GET['deptId'];
        $groups = $this->Group->find('list', array('conditions' => array('Group.level_id' => $depId)));
        $this->set('groups', $groups);
        $this->layout = 'ajax';
    }

    public function group_ajax() {
        $groupId = $_GET['groupId'];
        $this->Session->write('group', $groupId);
        $depId = $_GET['depId'];
        $sesId = $_GET['sesId'];
        $opts = array(
            'CourseCycle.level_id' => $depId,
            'CourseCycle.group_id' => $groupId,
            'CourseCycle.permission' => 1,
            'CourseCycle.school_session_id' => $sesId
        );
        //pr($opts); die;
        $courses = $this->CourseCycle->find('list', array(
            'conditions' => $opts,
            //'fields' => array('Course.id','Course.name'),
            'fields' => array('CourseCycle.course_id', 'Course.name'),
            'recursive' => 0
                ));
        //pr($courses);
        //die;
        $this->set('courses', $courses);
        $this->layout = 'ajax';
    }

    public function ref_group_ajax() {
        $groupId = $_GET['rgroupId'];
        $this->Session->write('group', $groupId);
        $depId = $_GET['depId'];
        $sesId = $_GET['sesId'];
        $opts = array(
            'CourseCycle.level_id' => $depId,
            'CourseCycle.group_id' => $groupId,
            'CourseCycle.ref_permission' => 1,
            'CourseCycle.school_session_id' => $sesId
        );
        //pr($opts); die;
        $courses = $this->CourseCycle->find('list', array(
            'conditions' => $opts,
            //'fields' => array('Course.id','Course.name'),
            'fields' => array('CourseCycle.course_id', 'Course.name'),
            'recursive' => 0
                ));
        //pr($courses);
        //die;
        $this->set('courses', $courses);
        $this->layout = 'ajax';
    }
    
    public function session_ajax() {
        $session = $_GET['session'];
        $this->Session->write('session', $session);
        $this->layout = 'ajax';
    }

    private function calculateGradeFromPoints($GPA) {
        $grade = '';

        if ($GPA >= 4.00)
            $grade = 'A+';
        elseif ($GPA >= 3.75)
            $grade = 'A';
        elseif ($GPA >= 3.50)
            $grade = 'A-';
        elseif ($GPA >= 3.25)
            $grade = 'B+';
        elseif ($GPA >= 3.00)
            $grade = 'B';
        elseif ($GPA >= 2.75)
            $grade = 'B-';
        elseif ($GPA >= 2.50)
            $grade = 'C+';
        elseif ($GPA >= 2.25)
            $grade = 'C';
        elseif ($GPA >= 2.00)
            $grade = 'D';
        else
            $grade = 'F';

        return $grade;
    }

    /**
     * Admin viewall
     *
     * @return void
     * @access public
     */
    public function admin_viewall() {
        $this->layout = 'scms-result-print';
        $this->set('title_for_layout', __('Student Result'));
    }

}
