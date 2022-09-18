<?php

class CalendarEventsController extends AppController {

    public $name = 'CalendarEvents';
    public $uses = array('CalendarEvent');

    public function admin_index() {
        $this->set('title_for_layout', __('List of Event'));
        $this->paginate['CalendarEvent']['order'] = "CalendarEvent.id ASC";
        $this->set('events', $this->paginate());
        $this->set('displayFields', $this->CalendarEvent->displayFields());
    }

    public function admin_add() {
        $this->set('title_for_layout', __('Add New Event'));
        if (!empty($this->request->data)) {
            $this->CalendarEvent->create();
            if ($this->CalendarEvent->save($this->request->data)) {
                $this->Session->setFlash(__('The Event has been saved'), 'default', array('class' => 'success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Event could not be saved. Please, try again.'), 'default', array('class' => 'error'));
            }
        }
    }

    public function admin_edit($id = null) {
        $this->CalendarEvent->id = $id;
        if ($this->request->is('get')) {
            $this->request->data = $this->CalendarEvent->read();
        } else {
            if ($this->CalendarEvent->save($this->request->data)) {
                $this->Session->setFlash('Event has been updated.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to update the event.');
            }
        }
    }

    public function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Event'), 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->CalendarEvent->delete($id)) {
            $this->Session->setFlash(__('Event deleted'), 'default', array('class' => 'success'));
            $this->redirect(array('action' => 'index'));
        }
    }

    function calendar($year = null, $month = null) {
        $this->layout = 'ajax';

        $this->CalendarEvent->recursive = 0;

        $month_list = array('january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december');
        $day_list = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
        $base_url = $this->webroot . 'calendar_events/calendar'; // NOT not used in the current helper version but used in the data array
        $view_base_url = $this->webroot . 'calendar_events';

        $data = null;

        if (!$year || !$month) {
            $year = date('Y');
            $month = date('M');
            $month_num = date('n');
            $item = null;
        }

        $flag = 0;

        for ($i = 0; $i < 12; $i++) { // check the month is valid if set
            if (strtolower($month) == $month_list[$i]) {
                if (intval($year) != 0) {
                    $flag = 1;
                    $month_num = $i + 1;
                    $month_name = $month_list[$i];
                    break;
                }
            }
        }

        if ($flag == 0) { // if no date set, then use the default values
            $year = date('Y');
            $month = date('M');
            $month_name = date('F');
            $month_num = date('m');
        }

        $count_day = cal_days_in_month(CAL_GREGORIAN, $month_num, $year);
        $from = $year . '-' . $month_num . '-01';
        $to = $year . '-' . $month_num . '-' . $count_day;

        $event_data = $this->Scms->getEvent($from, $to);

        $weekends = array(4);

        $this->set(compact('year', 'month', 'event_data', 'weekends'));

        return compact('year', 'month', 'event_data', 'weekends');
    }

}

