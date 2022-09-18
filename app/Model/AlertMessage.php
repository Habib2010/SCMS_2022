<?php
class AlertMessage extends AppModel {
	var $name = 'AlertMessage';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'from',
			'conditions' => '',
			'fields' => '',
			'order' => 'AlertMessage.created DESC'
		)
	);

    function markview($id){
		$query = "UPDATE alert_messages SET status = 1 WHERE id = $id";
		$res = $this->query($query);
		return $res;
	}

	function unmarkview($id){
		$query = "UPDATE alert_messages SET status = 0 WHERE id = $id";
		$res = $this->query($query);
		return $res;
	}

    function deleteselected($id){
		$query = "DELETE FROM alert_messages WHERE id = $id";
		$res = $this->query($query);
		return $res;
	}
}
?>