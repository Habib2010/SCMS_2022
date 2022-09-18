<?php
class CalendarHelper extends AppHelper {
	
	public $helpers = array('Html', 'Form', 'Js', 'Time');
	
	public function calendar($year = '', $month = '', $event_data = '', $weekends = '', $time_zone = 0){
        $str = ''; 
        
		$month_list = array('january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december');
        $bangla_month = array('জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'অগাস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর');	
		
		$day_list = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
		$bangla_day = array('সোম', 'মঙ্গল', 'বুধ', 'বৃহ:', 'শুক্র', 'শনি', 'রবি'); 
		
		$patterns = array('0','1','2','3','4','5','6','7','8','9');
		$replacements = array('০','১','২','৩','৪','৫','৬','৭','৮','৯');			
		
        $day = 1;
        $today = 0;

        if($year == '' || $month == ''){ // just use current year & month
			$year = date('Y');
			$month = date('M');
        }
		
		$year_res = str_replace($patterns, $replacements, $year);
	
        $flag = 0;
	
        for($i = 0; $i < 12; $i++)
        {
            if(strtolower($month) == $month_list[$i]){
                if(intval($year) != 0){
                	$flag = 1;
					$month_num = $i + 1;
					break;
                }
			}
        }
			
        if($flag == 0){
            $year = date('Y');
			$month = date('F');
			$month_num = date('m');
        }
				
        $next_year = $year;
        $prev_year = $year;
			
        $next_month = intval($month_num) + 1;
        $prev_month = intval($month_num) - 1;
			
        if($next_month == 13){
			$next_month = 'january';
			$next_year = intval($year) + 1;
        } else {
           	$next_month = $month_list[$next_month -1];
        }
				
        if($prev_month == 0){
			$prev_month = 'december';
            $prev_year = intval($year) - 1;
        } else {
            $prev_month = $month_list[$prev_month - 1];
        }
				
        if($year == date('Y') && strtolower($month) == strtolower(date('F'))){	// set the flag that shows todays date but only in the current month - not past or future...
            $mydate = date('Y-m-d h:i:s A');
            $today = $this->Time->format('j', $mydate, null, $time_zone);
        }
		
        $days_in_month = date("t", mktime(0, 0, 0, $month_num, 1, $year));
        $first_day_in_month = date('D', mktime(0, 0, 0, $month_num, 1, $year));
		if(isset($bangla_month[(int)$month_num - 1])){
			$month = $bangla_month[(int)$month_num - 1];
		}
		$str .= '<div class="cal_hdr">' . $month . ' ' . $year_res . $this->Html->image('ajax/loadingAnimation.gif',array('style'=>'display:none;position:absolute;left:0px;top:3px;','id'=>'load_calendar'));
			$str .= $this->Js->link(__($this->Html->image('bullet5.gif'), true),array('controller'=>'calendar_events','action'=>'calendar', 'plugin' => false, $prev_year,$prev_month),array('update'=>'#calendarCont','escape' => false));
			$str .= $this->Js->link(__($this->Html->image('bullet7.gif'), true),array('controller'=>'calendar_events','action'=>'calendar', 'plugin' => false, $next_year,$next_month),array('class'=>'next', 'update'=>'#calendarCont','escape' => false));                   
		$str .= '</div>';
     
		$str .= '<table border="1" cellpadding="0" cellspacing="2" width="100%" id="eventTable" class="cal_table">';
			$str .= '<thead>';
				$str .= '<tr>';
                
				for($i = 0; $i < 7; $i++){						
					$str .= '<th class="cell-header" style="width: 64.4286px;">' . $bangla_day[$i] . '</th>';
                }
                $str .= '</tr>';
            $str .= '</thead>';
               
            $str .= '<tbody>';
				while($day <= $days_in_month){
                    $str .= '<tr>';
                    for($i = 0; $i < 7; $i ++)
                    {
                        $date = date('Y-m-d',strtotime($year.'-'.$month_num.'-'.$day));
                        
                        $cell = '&nbsp;';
                        $title = '';
                        $class = '';
                        $morning_color  = '';
                        $evening_color  = '';
                        
                        $title .= $date;
                        
						if(isset($event_data[$date])){
                            for($n=0;$n<count($event_data[$date]);$n++){
                                $title .= "-".$event_data[$date][$n]['title'];
                                $color = $event_data[$date][$n]['color'];
                                if($color == 'orange'){
                                    $class .= 'chgTD';
                                }
                            }
						}
						
						if(in_array($i, $weekends)){
							$title .= "-Weekend";
							$class .= ' wndTD';
						}
						
						if($day == $today){
							$title .= "-Today";
							$class .= ' tdyTD';
						}
			
						if(($first_day_in_month == $day_list[$i] || $day > 1) && ($day <= $days_in_month)){
							$date_res = str_replace($patterns, $replacements, $day);
							$str .= '<td title = "' . $title .'" class="'. $class. '">';
								$str .= '<div class="cell-number">' . $date_res . '</div>';                           
                            $str .= '</td>';
                            $day++;
						}
						else{
                            $str .= '<td ' . $class . '><div class="cell-data">' . $cell . '</div></td>';
						}
                    }
                    $str .= '</tr>';
                }
                $str .= '</tbody>';
                
        $str .= '</table>';
            
        return $str;
    }

}

?>
