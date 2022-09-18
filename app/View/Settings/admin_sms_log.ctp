<?php //$this->extend('/Common/admin_index');     ?>
<div class="formWrapper">
    <div class="parentwrapper attendenceWrapper">

        <?php echo $this->element('admin/search/sms_search'); ?></br></br>
        <table cellpadding="0" cellspacing="0">

            <?php
            $tableHeaders = $this->Html->tableHeaders(array(
                $this->Paginator->sort('date'),
                $this->Paginator->sort('type'),
                $this->Paginator->sort('body'),
                $this->Paginator->sort('total'),
                    ));
            echo $tableHeaders;

            $total = 0;
            foreach ($smsInfos as $smsInfo) {
                ?>

                <tr>
                    <td><?php echo $smsInfo['SmsLog']['date'] ?></td>
                    <td><?php echo $smsInfo['SmsLog']['type'] ?></td>
                    <td><?php echo $smsInfo['SmsLog']['body'] ?></td>
                    <td align="right"><?php echo $smsInfo['SmsLog']['total'] ?></td>
                </tr>
                <?php
                $total += $smsInfo['SmsLog']['total'];
            }
//echo $this->Html->tableCells($rows);
            ?>
            <?php if (!empty($smsInfos)) { ?>
                <tr>
                    <td colspan="4" align="right"><?php echo $total; ?></td>
                </tr>
            <?php } ?>
            <?php echo $tableHeaders;
            ?>
        </table>
    </div>
</div>

