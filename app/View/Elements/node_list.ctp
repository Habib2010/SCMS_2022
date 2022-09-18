
	<ul>
		<?php
		$type = null;
		foreach ($nodesList as $n) { 
			if ($options['link']) {
				echo '<li>';
				
					/**For Month Display**/
				$month = substr($n['Node']['created'],5,2);
				$bangla_month = array('জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','অগাস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর');			
				foreach($bangla_month as $x=>$value){
						if($month==$x+1){
							$month_res = $value;												
						}
					}

				/**For Year Display**/
				$year = substr($n['Node']['created'],0,4);
				$replacements = array('০','১','২','৩','৪','৫','৬','৭','৮','৯');
				$patterns = array('0','1','2','3','4','5','6','7','8','9');		
				$year_res = str_replace($patterns, $replacements, $year);
				
				/**For Day Display**/
				$date = substr($n['Node']['created'],8,2); 
				$bangla_date = array('০১','০২','০৩','০৪','০৫','০৬','০৭','০৮','০৯','১০','১১','১২','১৩','১৪','১৫','১৬','১৭','১৮','১৯','২০','২১','২২','২৩','২৪','২৫','২৬','২৭','২৮','২৯','৩০','৩১');
				
				foreach($bangla_date as $x => $value){
					if($date == $x+1){
						$date_res = $value;												
					}
				}
				
				$span  = '';
				$span .= '<span class="acc_title">';
				$span .= '<span>';
				$span .= $date_res;
				$span .= $month_res;
				$span .= '</span>';
				$span .= $year_res;
				$span .= '</span>';
								
				echo $this->Html->link( $span . $n['Node']['title'], array(
					'plugin' => $options['plugin'],
					'controller' => $options['controller'],
					'action' => $options['action'],
					'type' => $n['Node']['type'],
					'slug' => $n['Node']['slug'],
				), array('escape' => false));
				echo '</li>';
			} else {
				echo '<li>' . $n['Node']['title'] . '</li>';
			}
			
			$type =  $n['Node']['type'];
		}
		?>
	</ul>
	<?php if($type): ?>
		<div class="lwrLink">
			<?php echo $this->Html->link('সবগুলো জানতে »','/'.$type); ?>
		</div>
	<?php endif; ?>
