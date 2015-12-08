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
				$.get("request.php", {req: result[0].transcript}, function(data){
					$(".keyword_detection").html(data);
					
					if ( data.indexOf(");") > 0 ) {
						setTimeout(data, 100);	
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
</head>

<body>
<!--<button onclick="listen()">Start recording! (Requires microphone and Desktop Chrome web browser)</button>-->
<div class="keyword_detection">
	
</div>
</body>
</html>
