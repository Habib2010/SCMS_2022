<?php 
$title = $lang == 'bn' ? 'স্কুল প্রশাসন' : 'Administration';
if(isset($role['Role']['title'])) {
	$title = $role['Role']['title']; 
}
$patterns = array('0','1','2','3','4','5','6','7','8','9');
$replacements = array('০','১','২','৩','৪','৫','৬','৭','৮','৯');	
?>
<?php if($count){ ?>
<h2><?= $lang == 'bn' ? 'প্রাক্তন' : 'Former'  ?> <?php echo $title; ?></h2>

<table width="100%" class="tbl1">
	<thead>
    	<tr>
        	<th><?= $lang == 'bn' ? 'সিরিয়াল' : 'Serial' ?></th>
            <th><?= $lang == 'bn' ? 'নাম' : 'Name' ?></th>
            <th><?= $lang == 'bn' ? 'পদবি' : 'Designation' ?></th>
            <th><?= $lang == 'bn' ? 'মেয়াদ' : 'Duration' ?></th>
        </tr>
    </thead>
	<tbody>
	<?php $i = 1; foreach($profiles as $profile): ?>
		<tr>
            <td><?php echo $lang == 'bn' ? str_replace($patterns,$replacements,$i) : $i; ?></td>
            <td><?php echo $lang == 'bn' ? $profile['Employee']['bn_name'] : $profile['Employee']['name']; ?></td>
            <td><?php echo $lang == 'bn' ? $profile['Employee']['bn_designation'] : $profile['Employee']['designation']; ?></td>
            <td><?php echo $lang == 'bn' ? (str_replace($patterns,$replacements,$profile['Employee']['join_date']) . ' হতে ' . str_replace($patterns,$replacements,$profile['Employee']['end_date']) . ' পর্যন্ত ') : ($profile['Employee']['join_date'] . ' - ' . $profile['Employee']['end_date'])?></td>
        </tr>
	<?php $i++; endforeach ; ?>	
	</tbody>
</table>
<?php $count = $this->request['paging']['Employee']['pageCount'];?>
<?php if($count >= 2): ?>
<?php if ($pagingBlock = $this->fetch('paging')): ?>
<?php echo $pagingBlock; ?>
<?php else: ?>
<?php if (isset($this->Paginator) && isset($this->request['paging'])): ?>
<div class="pagination">
	<?php echo $this->Paginator->first('< ' . __('first')); ?>
	<?php echo $this->Paginator->prev('< ' . __('prev')); ?>
	<?php echo $this->Paginator->numbers(array('separator'=>'-')); ?>
	<?php echo $this->Paginator->next(__('next') . ' >'); ?>
	<?php echo $this->Paginator->last(__('last') . ' >'); ?>
</div>			
	   <?php endif; ?>
	<?php endif; ?> 
<?php endif; ?>	

<?php } else { ?>
	<h2><?php echo $title; ?></h2>
	<p><?php echo 'কোন প্রাক্তন '.$title.' পাওয়া যায়নি'; ?></p>
<?php } ?>