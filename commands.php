<?php
	$CMD;
	$TCMD = new COMMAND_CENTRAL();
	$TCMD2 = new COMMAND_CENTRAL();
	$TCMD->command_format = "search for %s and cats";
	$TCMD->command_response = "voice_search({uber:request_param});";
	
	$CMD[0] = $TCMD;
	
	$TCMD2 = new COMMAND_CENTRAL();
	$TCMD2->command_format = "%a {register}";
	$TCMD2->command_response = "start_registration();";
	
	$CMD[1] = $TCMD2;
	
	$TCMD3 = new COMMAND_CENTRAL();
	$TCMD3->command_format = "I want to listen to %a {KBust|Leftist|LorDiddy|Adele|Drake|Miley Cyrus|Future}";
	$TCMD3->command_response = "{uber:request_param}is my favorite artist! No problem! :D";
	
	$CMD[2] = $TCMD3;
	
	$TCMD3 = new COMMAND_CENTRAL();
	$TCMD3->command_format = "search for %s^** {pie}";
	$TCMD3->command_response = "{uber:request_param}is my favorite artist! No problem! :D";
	
	$CMD[3] = $TCMD3;
	$request = new REQUEST_BUILDER();
?>
