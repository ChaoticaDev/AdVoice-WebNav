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
			
			$cmd_fnd = false;
			foreach ( $CMDS as $CMD ){
				$cmd_req_words = explode ( " ", $CMD->command_format );	
				
				$req = "";
				foreach ( $cmd_req_words as $wd ){
					if ( $wd == "%s" ){
						break;	
					}
					
					$req .= $wd . " ";
				}
				//echo $this->base_string;
				
				if(strpos($this->base_string,$req) !== FALSE || $this->base_string == $CMD->command_format){
					$search_sub_len = strlen(substr($this->base_string, strpos($this->base_string,$req), strlen($req)));
					//echo strpos($this->base_string,$req) ."-" . strlen($req) . "::" . substr($this->base_string, strpos($this->base_string,$req)+$search_sub_len, strlen($this->base_string)) . "** ";
					//echo "Command found";	
					
					$CMD->command_response = str_replace("{uber:request_param}", '"'.substr($this->base_string, strpos($this->base_string,$req)+$search_sub_len, strlen($this->base_string)).'"', $CMD->command_response);
					
					$cmd_fnd=true;
					echo $CMD->command_response;
				} else{
						
				}
			}
			if ( !$cmd_fnd) { echo "NO COMMAND FOUND: " . $this->base_string; }
		}
		
	}
	
	require_once("commands.php");
	
	
	
	$request->update_base_string($REQ_STRING);
	
	$request->parse_request($CMD);
?>
