<?php
//pr($students);
//pr($courseCycles);
//pr($studentR);
//pr($courseType);
?>
<div class="blockWrapper">
    <div class="rollwraper">
        <center style="margin-top:30px; font-size:1.2em; text-transform:uppercase"><b><?php echo $termName . ' - ' . date('Y'); ?></b></center>
        <table class="tblIntro" style="width:45%; margin:30px auto">
            <col width="30%" />
            <col width="70%" />
            <tr>
                <th>Department</th>
                <td><?php echo $courseCycles['Level']['name']; ?></td>
            </tr>
            <tr>
                <th>Semister</th>
                <td><?php echo empty($courseCycles['Group']['name']) ? '--' : $courseCycles['Group']['name']; ?></td>
            </tr>
            <tr>
                <th>Shift</th>
                <td><?php echo $sectionRow['Section']['name']; ?></td>
            </tr>
            <tr>
                <th>Subject</th>
                <td><?php echo $courseCycles['Course']['name']; ?></td>
            </tr>

        </table>

        <table class="tblroll" id="myTable">
            <tr>
                <th class="tdset1">Registration</th>
                <th class="tdset1">Roll
		    <input type="text" id="sidInput" onkeyup="sidFilter()"  class="filter">
		</th>
                <th class="tdset1">Name</th>
                <?php
                $p = 0;
                if ($courseType == 0) {
                    foreach ($courseCycles['CoursePartsCycle'] as $course_part) {
                        ?>
                        <th class="tdset1" >
                            <?php echo $course_part['title'] . ' (' . $course_part['number'] . ')'; ?>
                            <input type="text" id="per<?php echo $p; ?>" alt="<?php echo $p . 'n-' . $course_part['number']; ?>" class="percent" value="100" readonly />
                        </th><?php
                    $p++;
                }
            } else {
                        ?>
                    <th class="tdset1"><?php
                echo $courseCycles['Course']['type'];
                $p++;
                        ?>
                    </th><?php }
                    ?>
                <th class="tdset1">Total</th>
            </tr>

            <?php if (empty($students)) { ?>
                <tr>
                    <td class="tdset1" colspan="<?php echo 3 + $p; ?>" style="padding:50px 0">Sorry, No student for this course!!</td>
                </tr><?php
        } else {
            $marks = array();
            foreach ((array) $studentR as $i => $stdR) {
                $marks[$stdR['StudentResult']['student_cycle_id']][$stdR['StudentResult']['course_parts_cycle_id']] = $stdR['StudentResult']['mark'];
                $ids[$stdR['StudentResult']['student_cycle_id']][$stdR['StudentResult']['course_parts_cycle_id']] = $stdR['StudentResult']['id'];
            }

            // search in StudentCycle!!
            foreach ($students as $i => $student) { //if($i>2) continue; 
                    ?>
                    <tr class="oddset">
                        <td class="tdset1"><?php echo $student['Student']['registration']; ?></td>
                        <td class="tdset1"><?php echo $student['StudentCycle']['roll']; ?></td>
                        <td class="tdset1"><?php echo $student['Student']['name']; ?></td>

                        <?php
                        //echo $this->Form->input("StudentCycle_id.{$i}.sc",array('type'=>'hidden','value'=>$student['StudentCycle']['id'], 'label'=>''));
                        //echo $this->Form->input("CoursePartsCycle_id.{$i}.cc",array('type'=>'hidden','value'=>$course_parts_cycle['CoursePartsCycle']['id'], 'label'=>''));
                        ?>

                        <?php
                        $options = array();
                        $chkd = false; //only for $courseType==2;
                        foreach ($courseCycles['CoursePartsCycle'] as $p => $course_parts) {
                            $mark = (empty($studentR) || !isset($marks[$student['StudentCycle']['id']][$course_parts['id']])) ? '' : $marks[$student['StudentCycle']['id']][$course_parts['id']];
                            $idR = (empty($studentR) || empty($ids[$student['StudentCycle']['id']][$course_parts['id']])) ? '' : $ids[$student['StudentCycle']['id']][$course_parts['id']];
                            ?>

                            <?php if ($courseType == 0 || $p == 0): ?>
                                <td class="tdset1">
                                <?php endif; ?>

                                <?php
                                if ($courseType == 0) {
                                    //Debug while religion settings are set wrong, this will help to delete student result marks: label="[id='.$idR.'][sc='.$student['StudentCycle']['id'].'][cp='.$course_parts['id'].']";
                                    echo $this->Form->input("mark.{$student['StudentCycle']['id']}.{$course_parts['id']}.v", array('type' => 'text', 'label' => '', 'class' => 'input_Txt', 'value' => $mark, 'onblur' => 'calNum(this,' . $p . ');', 'onkeypress' => 'return isNumberKey(event);', 'onclick' => 'isInsetPrev(this);'));
                                    echo $this->Form->input("mark.{$student['StudentCycle']['id']}.{$course_parts['id']}.id", array('type' => 'hidden', 'value' => $idR));
                                } else {
                                    if ($courseType == 1) {
                                        echo $this->Form->input("mark.{$student['StudentCycle']['id']}.{$course_parts['id']}.v", array('type' => 'checkbox', 'label' => $course_parts['title'], 'class' => 'input_Txt', 'format' => array('before', 'input', 'between', 'label', 'after', 'error'), 'checked' => !empty($mark)));
                                        echo $this->Form->input("mark.{$student['StudentCycle']['id']}.{$course_parts['id']}.id", array('type' => 'hidden', 'value' => $idR));
                                    } else {
                                        $options[$course_parts['id']] = $course_parts['title']; //.' ('.$student['StudentCycle']['id'].'-'.$course_parts['id'].')';
                                        if (!empty($mark) && !$chkd) //as it is radio, take only once;
                                            $chkd = $course_parts['id'];

                                        //Don't Print Every Loop other than the last:
                                        if (count($courseCycles['CoursePartsCycle']) == ($p + 1)) {
                                            echo $this->Form->input("mark.{$student['StudentCycle']['id']}.v", array(
                                                'type' => 'radio',
                                                'default' => empty($chkd) ? $lastCpId : $chkd,
                                                //'label'=>$course_parts['title'],
                                                'legend' => false,
                                                'options' => $options, //$cTypes[2][$p],//array('à¦…à¦¤à¦¿ à¦‰à¦¤à§�à¦¤à¦®','à¦‰à¦¤à§�à¦¤à¦®','à¦­à¦¾à¦²à§‹','à¦…à¦—à§�à¦°à¦—à¦¤à¦¿ à¦ªà§�à¦°à¦¯à¦¼à§‹à¦œà¦¨'),
                                                'div' => 'radioSet',
                                                'before' => '<div class="radioRow">',
                                                'after' => '</div>',
                                                //'between' => '--between---',
                                                'separator' => '</div><div class="radioRow">'
                                            ));
                                        }
                                        //default radio selected, otherwise it creats authentication error!!!
                                        $lastCpId = $course_parts['id'];
                                    }
                                    echo $this->Form->input("mark.{$student['StudentCycle']['id']}.{$course_parts['id']}.id", array('type' => 'hidden', 'value' => $idR));
                                }


                                if ($courseType == 0 || count($courseCycles['CoursePartsCycle']) == ($p + 1)):
                                    ?>
                                </td><!-- end course_parts_cycle foreach here !!--> <?php
                endif;
            }
                            ?>
                        <td class="totalMark">&nbsp;</td>
                    </tr><?php
            }
            echo $this->Form->input("Course.ctype", array('type' => 'hidden', 'value' => $courseType));
            echo $this->Form->input("term_cycle_id", array('type' => 'hidden', 'value' => $term));
        }
                    ?>
        </table>
    </div><!-- end of rollwraper-->
    <div class="clear_both">&nbsp;</div>

</div><!-- end of blockWrapper-->

<div class="leftTop btmPrintwrapper">
    <div class="editwraper">
        <?php //echo $this->Form->submit('Export', array( 'div' => false , 'class' => 'forword submit1' , 'value' => 'Print') );  ?>
        <?php //echo $this->Form->submit('Print', array( 'div' => false , 'class' => 'print submit1' , 'value' => 'Print') );  ?>
        <?php echo $this->Form->submit('Save', array('div' => false, 'class' => 'submit1', 'value' => 'Save')); ?>
        <?php //echo $this->Form->submit('Save & Next', array( 'div' => false , 'class' => 'submit1' , 'value' => 'Save') );  ?>
    </div><!-- end of editwraper-->
</div><!-- end of leftTop-->

<script>
function sidFilter() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("sidInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
