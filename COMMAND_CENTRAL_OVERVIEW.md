# ABOUT COMMAND CENTRAL
  Command central, in it's current state, is an extremely simple text parser which determines what response must be returned to your website via javascript 'legacy injection'.
Eventually, CommandCentral will learn to recognize speech patterns, and parsing much larger sentences to allow a more flexible voice navigating platform.

# Structure
  Command Central has a very simple setup.
  
    var $command_name ; // (Optional) A name for the command, nothing else.
		
		var $command_format ; // The format of your command, IE: 'search for %s' | Speaking 'search for money making tips' would return 'money making tips'.
		
		var $command_response ;	// The response (w/ format) that should be given when found, IE: voice_search({uber:request_param}); | {uber:request_param} will be replaced with "'money making tips'".
		  
		  
# Adding commands
  Adding commands is very easy, and are clustered in an array.
  
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
