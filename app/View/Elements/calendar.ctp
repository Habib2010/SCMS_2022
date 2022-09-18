<h2><?= $lang == 'bn' ? 'দিনপুঞ্জি' : 'Calendar'; ?></h2>
<div id="calendarCont" class="calendarCon">
<?php 
	$year = date('Y');
	$month = date('m');

	$data = $this->requestAction('calendar_events/calendar/'.$year.'/'.$month.'/');

	$event_data = array();
	if(isset($data['event_data'])){
		$event_data = $data['event_data'];
	}
	if(isset($data['weekends'])){
		$weekends = $data['weekends'];
	}

	echo $this->Calendar->calendar($year, $month, $event_data, $weekends); 
?> 
</div>