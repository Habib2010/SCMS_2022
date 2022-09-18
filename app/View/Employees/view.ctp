<h2><?php echo $role['Role']['title']; 
//pr($profile); die;
?></h2>
<div class="details">
    <div class="details_left">
        <?php echo $this->Html->image("employee/large/" . $profile['User']['image'] . "", array("title" => $profile['Employee']['name'], 'div' => false)); ?>
    </div><!-- End of details_left-->

    <div class="details_right">                	              	
        <?php echo $this->Html->image("/images/teachers/details_right_img_left.png", array("alt" => $profile['Employee']['name'], 'div' => false, 'class' => 'details_right_img_left')); ?>
        <h2><?php echo $profile['Employee']['name']; ?></h2>
        <address>
            <?php if ($profile['Employee']['designation']): ?> পদবী: <?php echo $profile['Employee']['designation']; ?><br/><?php endif; ?>
<!--            --><?php //if ($profile['Employee']['father_name']): ?><!-- পিতার নাম : --><?php //echo $profile['Employee']['father_name']; ?><!--<br/>--><?php //endif; ?>
            <?php if ($profile['Employee']['degree']): ?> শিক্ষাগত যোগ্যতা : <?php echo $profile['Employee']['degree']; ?><br/><?php endif; ?>
            <?php if ($profile['Employee']['training']): ?> ট্রেনিং : <?php echo $profile['Employee']['training']; ?><br/><?php endif; ?>
            <?php if ($profile['User']['email']): ?> ইমেইল : <?php echo $profile['User']['email']; ?><br/><?php endif; ?>
            <?php if ($profile['Employee']['blood_group']): ?> রক্তের গ্রুপ : <?php echo $profile['Employee']['blood_group']; ?><br/><?php endif; ?>
<!--            --><?php //if ($profile['Employee']['nationality']): ?><!-- জাতীয়তা : --><?php //echo $profile['Employee']['nationality']; ?><!--<br/>--><?php //endif; ?>
<!--            --><?php //if ($profile['Employee']['national_id']): ?><!-- জাতীয় পরিচয় নং : --><?php //echo $profile['Employee']['national_id']; ?><!--<br/>--><?php //endif; ?>
            <?php if ($profile['Employee']['phone']): ?> ফোন : <?php echo $profile['Employee']['phone']; ?><br/><?php endif; ?>
<!--            --><?php //if ($profile['Employee']['address']): ?><!-- ঠিকানা : --><?php //echo $profile['Employee']['address']; ?><!--<br/>--><?php //endif; ?>
<!--            --><?php //if ($profile['Employee']['date_of_birth']): ?><!-- জন্মতারিখ : --><?php //echo $profile['Employee']['date_of_birth']; ?><!--<br/>--><?php //endif; ?>
<!--            --><?php //if ($profile['Employee']['join_date']): ?><!-- যোগদানের তারিখ : --><?php //echo $profile['Employee']['join_date']; ?><!--<br/>--><?php //endif; ?>
<!--            --><?php //if ($profile['Employee']['join_as']): ?><!-- প্রথম যোগদান : --><?php //echo $profile['Employee']['join_as']; ?><!--<br/>--><?php //endif; ?>
<!--            --><?php //if ($profile['Employee']['hobby']): ?><!-- শখ : --><?php //echo $profile['Employee']['hobby']; ?><!----><?php //endif; ?>
        </address>
    </div><!-- End of details_right-->
</div><!-- End of details-->

<div class="details_packet">
    <h3 style="margin-bottom:10px"><?php echo $profile['Employee']['quote_heading']; ?></h3>
    <p><?php echo $profile['Employee']['quote']; ?></p>
</div><!-- End of details_packet-->               