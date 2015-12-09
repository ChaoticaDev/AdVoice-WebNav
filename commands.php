<?php
	$CMD;
	$TCMD = new COMMAND_CENTRAL();
	$TCMD2 = new COMMAND_CENTRAL();
	$TCMD->command_format = "search for %s";
	$TCMD->command_response = "voice_search({uber:request_param});";
	
	$CMD[0] = $TCMD;
	
	$TCMD2 = new COMMAND_CENTRAL();
	$TCMD2->command_format = "register";
	$TCMD2->command_response = "start_registration();";
	
	$CMD[1] = $TCMD2;
	$request = new REQUEST_BUILDER();
?>
