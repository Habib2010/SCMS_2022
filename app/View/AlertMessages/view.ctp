<div class="contentiner">
        <div class="readmarked">
                <ul>
                        <li><?php echo $this->Html->link(__('<span>Inbox</span>', true), array('action' => 'index')); ?> </li>
                        <li><?php echo $this->Html->link(__('<span>Delete</span>', true), array('action' => 'delete', $alertMessage['AlertMessage']['id']), null, sprintf(__('Are you sure you want to delete this message?', true))); ?> </li>
                </ul>
        </div>
        <div class="adsmistrationtask adsmistrationtask2">
            <table width="100%" class="tbl" cellpadding="0" cellspacing="0">
                <tr>
                    <th>Subject: </th>
                    <td class="last"><?php echo $alertMessage['AlertMessage']['subject']; ?></td>
                </tr>
                <tr>
                    <th>From: </th>
                    <td class="last"><?php if(isset($alertMessage['Employee']['name'])) echo $alertMessage['Employee']['name']; else echo 'System Administrator'; ?></td>
                </tr>
                <tr>
                    <th>Received: </th>
                    <td class="last"><?php if(!empty($alertMessage['AlertMessage']['created']))  echo $time->format('d-m-Y h:i:s A', $alertMessage['AlertMessage']['created'], null, $time_zone); ?></td>
                </tr>
                <tr class="lastrow">
                    <th valign="top">Message: </th>
                    <td class="last">
                    <?php
                    echo $alertMessage['AlertMessage']['body'];
                    $application_id = $alertMessage['AlertMessage']['application_id']; 
                    if($application_id){
                        $status = $alertMessage['Application']['status']; 
                        if($status==0){
                            $actions = '<br/>';
                            $actions .= $this->Html->link(__('Approve', true), array('controller'=>'applications','action' => 'approve', $application_id)).' <i class="divider">|</i> ';
                            $actions .= $this->Html->link(__('Reject', true), array('controller'=>'applications','action' => 'reject', $application_id));
                            echo $actions;
                        }
                    }
                    ?>
                    </td>
                </tr>
            </table>
        </div>
</div>
