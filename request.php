<?php
	$REQ_STRING = $_GET['req'];
	
	class COMMAND_CENTRAL{
		var $command_name ;
		
		var $command_format ;
		
		var $command_response ;	
	}
	
	class REQUEST_BUILDER{
		var $base_string = "UBERSNIP.BASE";
		
		var $tokens = array();
		
		function update_base_string ( $new_base_string ){
			$this->base_string = $new_base_string;	
		}
		
		function parse_request ( $CMDS, $chain = 0 ){
			$words = implode ( $this->base_string ) ;
			
			foreach ( $CMDS as $CMD ){
				$cmd_req_words = explode ( " ", $CMD->command_format );	
				
				$req = "";
				foreach ( $cmd_req_words as $wd ){
					if ( $wd == "%s" ){
						break;	
					}
					
					$req .= $wd . " ";
				}
				
				if(strpos($this->base_string,$req) !== FALSE){
					$search_sub_len = strlen(substr($this->base_string, strpos($this->base_string,$req), strlen($req)));
					//echo strpos($this->base_string,$req) ."-" . strlen($req) . "::" . substr($this->base_string, strpos($this->base_string,$req)+$search_sub_len, strlen($this->base_string)) . "** ";
					//echo "Command found";	
					
					$CMD->command_response = str_replace("{uber:request_param}", "'".substr($this->base_string, strpos($this->base_string,$req)+$search_sub_len, strlen($this->base_string))."'", $CMD->command_response);
					
					echo $CMD->command_response;
				} else{
					echo "NO COMMAND FOUND";	
				}
			}
		}
	}
	
	$CMD;
	$TCMD = new COMMAND_CENTRAL();
	$TCMD->command_format = "search for %s";
	$TCMD->command_response = "voice_search({uber:request_param});";
	
	$CMD[0] = $TCMD;
	$request = new REQUEST_BUILDER();
	
	
	
	$request->update_base_string($REQ_STRING);
	
	$request->parse_request($CMD);
?>
