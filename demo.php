<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UberSnip AdVoice</title>

<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script type="text/javascript" src="https://ubersnip.com/themes/sound/js/platform.js"></script> 
<script type="text/javascript" src="https://ubersnip.com/themes/sound/js/webspeech.js"></script> 

<script>

	var recognizer = new webkitSpeechRecognition();
	recognizer.lang = "en";
	recognizer.continuous = true;
	//recognizer.interimResults = true;
	recognizer.onresult = function(event) {
		if (event.results.length > 0) {
			var result = event.results[event.results.length-1];
			if(result.isFinal) {
            	$(".keyword_detection").html("<br/>"+result[0].transcript);
            	$(".reg_header2").val(result[0].transcript);
				$(".reg_header2").blur();
				next_step();
				$.get("https://ubersnip.com/UberSnip_VoiceAPI/request.php", {req: result[0].transcript}, function(data){
					$(".keyword_detection").html(data);
					
					if ( data.indexOf(");") > 0 ) {
						setTimeout(data, 100);	
					}else{
						alert(data);	
					}
				});
				console.log(result[0].transcript);
			}
		}  
		
	recognizer.continuous = true;
	};
	
	recognizer.onerror = function(){
		alert("Error::SPEECH");	
	}
	recognizer.continuous = true;
	recognizer.start();
	
	
    var listener = new AudioListener(0);
    function listen() {

		//setTimeout('$(".keyword_detection").html("<br />Speak now to capture voice!");', 3000);
        listener.listen("en", function(text) {
            $(".keyword_detection").html("<br/>"+text);
			
        });
			//setTimeout('listen();', 2000);
    }
	
	function voice_search(data){
		alert("Searched and found results for data, returned called to voice_search()");
		
	}
</script>



<script>
	/*VOICE DRIVE REGISTRATION APP*/
	
	var reg_step = 0;
	var reg_steps_headers = [[0,"Speak or type your first and last name"], [1,"Enter username"], [0,"Speak password phrase"]];
	
	function start_registration(){
		init=true;
		$(".reg_header2").change( function(){
			next_step();
		});
		next_step();	
	}
	
	var init = false;
	
	function next_step(){
		if ( !init ) { return ; }
		switch ( reg_step ){
			case 0:
				//$(".reg_flname").val($(".reg_header2").val());
				break;
				
			case 1:
				
				$(".reg_flname").val($(".reg_header2").val());
				break;
					
			case 2:
			
				$(".reg_username").val($(".reg_header2").val());
				break;	
				
			case 3:
			
				$(".reg_password").val($(".reg_header2").val());
				break;	
		}
		if ( reg_step < reg_steps_headers.length ){
			$(".reg_header").html(reg_steps_headers[reg_step][1]);
		}
		reg_step++;
		
		if ( reg_step > reg_steps_headers.length ){
			init = false;	
		}
	}
</script>

<meta name="twitter:card" content="photo" />
<meta name="twitter:site" content="@MontrayDavis" />
<meta name="twitter:creator" content="@UberSnip" />
<meta name="twitter:owner" content="@MontrayDavis" />
<meta property="twitter:description" content="Control your website with voice commands! || #OpenSource" />
<meta property="twitter:title" content="ÜberSnip - AdVoice WebNavigation." />
<meta property="twitter:image" content="https://image.freepik.com/free-vector/scream-mouth-background_23-2147492625.jpg" />
<meta property="twitter:url" content="https://ubersnip.com/advoice" />
<meta property="og:url" content="https://ubersnip.com/advoice" />
<meta property="og:title" content="ÜberSnip - AdVoice WebNavigation." />
<meta property="og:description" content="Control your web browser with voice commands! OpenSource project." />

</head>

<body>
<!--<button onclick="listen()">Start recording! (Requires microphone and Desktop Chrome web browser)</button>-->
<div class="keyword_detection">
	Say a command!<br />
    <strong>Command List</strong><br />
    "Search for %s" : 'Search for cats and dogs'
</div>

<br /><br />
<strong>EXAMPLE VOICE DRIVEN REGISTRATION APP</strong>
<form>
    <input class="reg_header2" type="hidden" />
	<strong class="reg_header">Say "Register" to begin</strong><br />
	<input type="text" class="reg_flname" /><br />
	<input type="text" class="reg_username" /><br />
    <input type="password" class="reg_password" /><br />
    <button class="reg_nextbtn" onclick="next_step()">Next</button>
</form><br /><br />
<strong><a href="https://github.com/UberSnip/AdVoice-WebNav/blob/master/README.md">VIEW ON GITHUB</a></strong>
</body>
</html>
