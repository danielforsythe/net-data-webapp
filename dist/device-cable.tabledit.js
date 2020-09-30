// JavaScript Document
// Edit current document
$(document).ready(function(){
	// Use Tabledit Plugin using #myTableData id
	$('#myTableData').Tabledit({
		deleteButton: false,
		editButton: false,
		columns: {
			identifier: [0, 'portID'], // identify the data by the portID Value
			editable: [[2, 'cableID']] // make the cableID column value editable by the plugin
		},
		hideIdentifier: true,
		url: '../live_edit.php' // use live_edit.php to submit MySQL queries live in page for editing
	});
});
