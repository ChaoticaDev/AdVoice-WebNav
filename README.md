# AdVoice-WebNav Overview
  This project is lead by the development team over at https://ubersnip.com/ and utilizes the Google Chrome SPEECH API's. The ultimate goal of this project is to deliver a platform that will allow you to fully interact with your website using voice commands. With many more hardward devices switching over to voice-command operations, more users will eventually feel compelled to go voice with everything. This project is intended to get ahead, and provide the resources necessary to use this service when the time comes.
  
  Moving to a voice-enabled platform is not only much more engaging, but it opens possibilities to many new other technologies. https://ubersnip.com/adnetwork <-- A great example of how we can use voice technologies to change how we advertise.
  
  In it's current state, the public port of AdVoice doesn't do much other than passing the retrieved google speech transcript to the server, where the server then parses for 'commands' such as 'search for' or 'go home'. It's a very early work in progress, and as the time goes by, we will port the other AdVoice features currently used by our main Audio Service.

# Example and Usage

  Test it out: https://ubersnip.com/UberSnip_VoiceAPI/demo.php
  
  Currently, the only command built in right now is "search for". By saying "search for 'candy'", the server will return a response : voice_search('candy'), and call the function. It's simple to use, just load the example page, and say "search for %s".
  
  Adding a command is very easy, and straight forward. Just add the following to request.php
  
  $TCMD = new COMMAND_CENTRAL();
	$TCMD->command_format = "I'm looking for %s"; // Command = text, %s = action parameter
	$TCMD->command_response = "javascript_function_name({uber:request_param});"; // This should be the same as the function name and parameter set as what's in your demo.php javascript
	
	$CMD[1] = $TCMD;
