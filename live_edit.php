<?php
	include_once('model/database.php');
	$input = filter_input_array(INPUT_POST);
	// When editing column cableID initalize update_field variable
	// Set update_field to new entered value for cableID
	if ($input['action'] == 'edit') {
		$update_field = '';
		if(isset($input['cableID'])) {
			$update_field .= $input['cableID'];
		}
		// Allow for setting cableID field value to blank i.e. NULL value
		if($update_field == '') {
			$stmt = $dsn->query("UPDATE device_ports SET cableID = null WHERE portID = '" .$input['portID'] . "'");
			$stmt->execute();
		// If numeric value is chosen, update the cableID where selected using portID as update field reference
		} else {
			$stmt = $dsn->query("UPDATE device_ports SET cableID = $update_field WHERE portID = '" .$input['portID'] . "'");
			$stmt->execute();
		}
			
	}
?>