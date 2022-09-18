
<?php

App::uses('Helper', 'View/Helper');

class SeatHelper extends Helper {

    public $helpers = array('Form', 'Html');
    
   function getTableRows($pid, $tid, $seatplan, $cnt = 1) {
        $headRow = '<tr class="rowHead pid_' . $pid . ' tid_' . $tid . '" pid="' . $pid . '" tid="' . $tid . '">';
        $headRow .= '<td class="rowspan" rowspan="' . $cnt . '"><div class="minusHead"><span>-</span></div> ' . $this->Form->input('Seatplan.' . $pid . '.name', array('div' => false, 'class' => 'input', 'label' => false, 'type' => 'textarea', 'rows' => 2, 'cols' => 30)) . '</td>';
        $headRow .= '<td class="rowspan" rowspan="' . $cnt . '">' . $this->Form->input('Seatplan.' . $pid . '.quantity', array('div' => false, 'label' => false, 'type' => 'textarea', 'rows' => 2, 'cols' => 20)) . '</td>';
        $headRow .= '<td class="rowspan" rowspan="' . $cnt . '">' . $this->Form->input('Seatplan.' . $pid . '.location', array('div' => false, 'label' => false, 'type' => 'textarea', 'rows' => 2, 'cols' => 20)) . '</td>';

        if ($seatplan) {
            return $headRow;
        }
    }

   

}

?>
   