<?php
$title = $lang == 'bn' ? 'স্কুল প্রশাসন' : 'All Administrations';
if (isset($role['Role']['title'])) {
    $title = $role['Role']['title'];
}
?>
<?php if ($count > 1) { ?>
    <h2><?php echo $title; ?></h2>
    <ul class="teachers_list">
        <?php foreach ($profiles as $profile): ?>
            <li>                
                <div class="teachers_img">
                    <a href="<?php echo $this->base ?>/employees/view/<?php echo $profile['Employee']['id']; ?>">
                        <?php echo $this->Html->image("employee/thumbnail/" . $profile['Employee']['thumbnail'] . "", array("title" => $profile['Employee']['name'], 'div' => false)); ?>
                    </a>
                </div><!-- End of teachers_img-->					
                <div style="height:39px" class="teachers_name">
                    <h3><?php echo $lang == 'bn' ? $profile['Employee']['bn_name'] : $profile['Employee']['name']; ?></h3>
                    <span><?php echo $lang == 'bn' ? $profile['Employee']['bn_designation'] : $profile['Employee']['designation']; ?></span>
                </div><!-- End of teachers_name-->
            </li> 
        <?php endforeach; ?>	
    </ul>

    <?php $count = $this->request['paging']['Employee']['pageCount']; ?>
    <?php if ($count >= 2): ?>
        <?php if ($pagingBlock = $this->fetch('paging')): ?>
            <?php echo $pagingBlock; ?>
        <?php else: ?>
            <?php if (isset($this->Paginator) && isset($this->request['paging'])): ?>
                <div class="pagination">
                    <?php echo $this->Paginator->first('< ' . __('first')); ?>
                    <?php echo $this->Paginator->prev('< ' . __('prev')); ?>
                    <?php echo $this->Paginator->numbers(array('separator' => '-')); ?>
                    <?php echo $this->Paginator->next(__('next') . ' >'); ?>
                    <?php echo $this->Paginator->last(__('last') . ' >'); ?>
                </div>			
            <?php endif; ?>
        <?php endif; ?> 
    <?php endif; ?>	

<?php } elseif ($count == 1) { ?>

    <?php foreach ($profiles as $profile): ?>
        <h2><?php echo $lang == 'bn' ? $profile['Employee']['bn_designation'] : $profile['Employee']['designation']; ?></h2>
        <div class="details">
            <div class="details_left">
                <?php echo $this->Html->image("employee/large/" . $profile['User']['image'] . "", array("title" => $profile['Employee']['name'], 'div' => false)); ?>
            </div><!-- End of details_left-->

            <div class="details_right">                	              	
                <?php echo $this->Html->image("/images/teachers/details_right_img_left.png", array("alt" => $profile['Employee']['name'], 'div' => false, 'class' => 'details_right_img_left')); ?>
                <h2><?php echo $lang == 'bn' ? $profile['Employee']['bn_name'] : $profile['Employee']['name']; ?></h2>
                <address><?php if ($profile['Employee']['designation']):
                        echo $lang == 'bn' ? 'পদবী : ' : 'Designation : ';
                        echo $lang == 'bn' ? $profile['Employee']['bn_designation'] : $profile['Employee']['designation']; ?><br/><?php endif; ?>
<!--                    --><?php //if ($profile['Employee']['father_name']): ?><!-- পিতার নাম : --><?php //echo $profile['Employee']['father_name']; ?><!--<br/>--><?php //endif; ?>
                    <?php if ($profile['Employee']['degree']): ?> শিক্ষাগত যোগ্যতা : <?php echo $profile['Employee']['degree']; ?><br/><?php endif; ?>
                    <?php if ($profile['Employee']['training']): ?> ট্রেনিং : <?php echo $profile['Employee']['training']; ?><br/><?php endif; ?>
                    <?php if ($profile['User']['email']): ?> ইমেইল : <?php echo $profile['User']['email']; ?><br/><?php endif; ?>
                    <?php if ($profile['Employee']['blood_group']): ?> রক্তের গ্রুপ : <?php echo $profile['Employee']['blood_group']; ?><br/><?php endif; ?>
<!--                    --><?php //if ($profile['Employee']['nationality']): ?><!-- জাতীয়তা : --><?php //echo $profile['Employee']['nationality']; ?><!--<br/>--><?php //endif; ?>
<!--                    --><?php //if ($profile['Employee']['national_id']): ?><!-- জাতীয় পরিচয় নং : --><?php //echo $profile['Employee']['national_id']; ?><!--<br/>--><?php //endif; ?>
                    <?php if ($profile['Employee']['phone']): ?> ফোন : <?php echo $profile['Employee']['phone']; ?><br/><?php endif; ?>
<!--                    --><?php //if ($profile['Employee']['address']): ?><!-- ঠিকানা : --><?php //echo $profile['Employee']['address']; ?><!--<br/>--><?php //endif; ?>
<!--                    --><?php //if ($profile['Employee']['date_of_birth']): ?><!-- জন্মতারিখ : --><?php //echo $profile['Employee']['date_of_birth']; ?><!--<br/>--><?php //endif; ?>
<!--                    --><?php //if ($profile['Employee']['join_date']): ?><!-- যোগদানের তারিখ : --><?php //echo $profile['Employee']['join_date']; ?><!--<br/>--><?php //endif; ?>
<!--                    --><?php //if ($profile['Employee']['mpo_date']): ?><!-- এমপিও তারিখ : --><?php //echo $profile['Employee']['mpo_date']; ?><!--<br/>--><?php //endif; ?>
<!--                    --><?php //if ($profile['Employee']['join_as']): ?><!-- প্রথম যোগদান : --><?php //echo $profile['Employee']['join_as']; ?><!--<br/>--><?php //endif; ?>
<!--                    --><?php //if ($profile['Employee']['hobby']): ?><!-- শখ : --><?php //echo $profile['Employee']['hobby']; ?><!----><?php //endif; ?>
                </address>
            </div><!-- End of details_right-->
        </div><!-- End of details-->

        <div class="details_packet">
            <h3 style="margin-bottom:10px"><?php echo $profile['Employee']['quote_heading']; ?></h3>
            <p><?php echo $profile['Employee']['quote']; ?></p>
        </div><!-- End of details_packet-->               
    <?php endforeach; ?>

<?php } else { ?>
    <h2><?php echo $title; ?></h2>
    <p><?php echo 'কোন ' . $title . ' পাওয়া যায়নি'; ?></p>
<?php } ?>
