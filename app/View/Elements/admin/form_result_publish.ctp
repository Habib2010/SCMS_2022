<?php
//pr($terms);
//pr($schoolSessions);
//pr($termDetails);
?>
<div class="blockWrapper">
    <div class="rollwraper">
        <?php /* ?><center style="margin-top:30px; font-size:1.2em; text-transform:uppercase"><b><?php echo $termName.' - '.date('Y'); ?></b></center><?php */ ?>
        <table class="tblIntro" style="width:45%; margin:30px auto">
            <col width="30%" />
            <col width="70%" />
            <tr>
                <th>Term ID</th>
                <td><?php echo $this->request->data['StudentResult']['term_id']; ?></td>
            </tr>
            <tr>
                <th>Term Name</th>
                <td><?php echo $terms[$this->request->data['StudentResult']['term_id']]; ?></td>
            </tr>
            <tr>
                <th>Term Session</th>
                <td><?php echo $schoolSessions[$this->request->data['StudentResult']['school_session_id']]; ?></td>
            </tr>
        </table>

        <table class="tblroll">
            <tr>
                <th style="text-align:center">ID</th>
                <th style="text-align:center">Department</th>
                <th style="text-align:center">Semister</th>
                <th style="text-align:center">Start Date</th>
                <th style="text-align:center">End Date</th>
                <th style="text-align:center">Publish</th>
                <th style="text-align:center">SMS Sent</th>
            </tr>

            <?php if (empty($termDetails)) { ?>
                <tr>
                    <td class="tdset1" colspan="6" style="padding:50px 0">Sorry, No sub term is created for this Term!!</td>
                </tr><?php
        } else {
            foreach ($termDetails as $i => $termDetail) {
                
                $rowData = $termDetail['SchoolTermCycle'];
                    ?>
                    <tr class="oddset">
                        <td class="tdset1"><?php
                        echo $rowData['id'];
                        echo $this->Form->input("pub.$i.id", array('type' => 'hidden', 'value' => $rowData['id']));
                        echo $this->Form->input("pub.$i.level_id", array('type' => 'hidden', 'value' => $rowData['level_id']));
                        echo $this->Form->input("pub.$i.group_id", array('type' => 'hidden', 'value' => $rowData['group_id']));
                    ?></td>
                        <td class="tdset1"><b><?php echo $scmsClassNames[$rowData['level_id']]; ?></b></td>
                        <td class="tdset1"><b><?php echo $termDetail['Group']['name']; ?></b></td>
                        <td class="tdset1"><?php echo $rowData['start_date']; ?></td>
                        <td class="tdset1"><?php echo $rowData['end_date']; ?></td>
                        <td class="tdset1"><?php
                    echo $this->Form->input("pub.$i.is_published", array('type' => 'checkbox', 'label' => (empty($rowData['published_on']) ? 'Never Published' : 'Last Published On: ' . $rowData['published_on']), 'class' => 'input_Txt', 'format' => array('before', 'input', 'between', 'label', 'after', 'error'), 'checked' => !empty($rowData['is_published'])));
                    echo $this->Form->input("pub.$i.published_on", array('type' => 'hidden', 'value' => $rowData['published_on']));
                    ?></td>
                        <td class="tdset1"><?php
                    echo $this->Form->input("pub.$i.is_sms_sent", array('type' => 'checkbox', 'label' => (empty($rowData['sms_sent_on']) ? 'Never Sent' : 'Last Sent On: ' . $rowData['sms_sent_on']), 'class' => 'input_Txt', 'format' => array('before', 'input', 'between', 'label', 'after', 'error'), 'checked' => !empty($rowData['is_sms_sent'])));
                    echo $this->Form->input("pub.$i.sms_sent_on", array('type' => 'hidden', 'value' => $rowData['sms_sent_on']));
                    ?></td>
                    </tr><?php
                }
            }
            ?>
        </table>
    </div><!-- end of rollwraper-->
    <div class="clear_both">&nbsp;</div>

</div><!-- end of blockWrapper-->

<div class="leftTop btmPrintwrapper">
    <div class="editwraper">
        <?php //echo $this->Form->submit('Export', array( 'div' => false , 'class' => 'forword submit1' , 'value' => 'Print') );  ?>
        <?php //echo $this->Form->submit('Print', array( 'div' => false , 'class' => 'print submit1' , 'value' => 'Print') ); ?>
        <?php echo $this->Form->submit('Update Status', array('div' => false, 'class' => 'submit1', 'value' => 'Save')); ?>
        <?php //echo $this->Form->submit('Save & Next', array( 'div' => false , 'class' => 'submit1' , 'value' => 'Save') ); ?>
    </div><!-- end of editwraper-->
</div><!-- end of leftTop-->
