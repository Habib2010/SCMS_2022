<?php
class ScmsComponent extends Component {
	
	protected $controller = null;

    public function startup(Controller $controller) {
        $this->controller = $controller;
    }

    public function getEvent($from = null, $to = null) {
        $eventInstance = ClassRegistry::init('CalendarEvent');

		$conditions = array('or'=>array(
                          array('CalendarEvent.start_date <='=>$from,'CalendarEvent.end_date >='=>$to),
                          array('CalendarEvent.start_date >='=>$from,'CalendarEvent.start_date <='=>$to),
                          array('CalendarEvent.end_date >='=>$from,'CalendarEvent.end_date <='=>$to)
                      )
                );
				
        $events = $eventInstance->find('all',array('conditions'=>$conditions));

        $data = null; 
        foreach($events as $event) {
            $event_days = array();
            $start = $event['CalendarEvent']['start_date'];
            $end = $event['CalendarEvent']['end_date'];
            $event_days = $this->createDateRangeArray($start,$end);
            foreach($event_days as $event_day) {
                if(isset($link[$event_day])){
                    $i = count($link[$event_day]);
                    $data[$event_day][$i]['color'] = 'orange'; 
                    $data[$event_day][$i]['title'] = $event['CalendarEvent']['title'];
                   
                }
                else{
                    $data[$event_day][0]['color'] = 'orange'; 
                    $data[$event_day][0]['title'] = $event['CalendarEvent']['title'];
                }
            }
        }
        
        return $data;
    }
	
	function createDateRangeArray($strDateFrom,$strDateTo) {
              $aryRange=array();

              $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
              $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

              if ($iDateTo>=$iDateFrom) {
                array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry

                while ($iDateFrom<$iDateTo) {
                  $iDateFrom+=86400; // add 24 hours
                  array_push($aryRange,date('Y-m-d',$iDateFrom));
                }
              }
              return $aryRange;
        }
}
?>