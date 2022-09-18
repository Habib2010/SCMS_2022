<select name="section">
<option value="Select Section"></option>

<?php 
//pr($union_list);
//$union_list =array( 'Select Union' => 'Select Union');
foreach($section as $key=>$val)
         
  echo '<option value="'.$key.'">'.$val.'</option>'."\n";
?>

</select>

<!--foreach($union_list as $option)
 
  echo '<option value="'.$option['id'].'">'.$option['name'].'</option>'."\n";-->