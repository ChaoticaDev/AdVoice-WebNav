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
		
		var $db;
		
		function update_base_string ( $new_base_string ){
			$this->base_string = $new_base_string;	
		}
		
		function parse_request ( $CMDS, $chain = 0 ){
			$words = implode ( $this->base_string ) ;
			
			$cmd_fnd = false;
			$optionals=false;
			$wildcard = false;
			$indexed = false;
			foreach ( $CMDS as $CMD ){
				$cmd_req_words = explode ( " ", $CMD->command_format );	
				
				$req = "";
				foreach ( $cmd_req_words as $wd ){
					if ( $wd == "%s" ){
						break;	
					}else if ($wd == "%a"){
						$optionals = true;
						break;
					}else if ($wd == "%s**"){ //WILDCARD
						$wildcard = true;
						break;
					}else if ($wd == "%i**"){ //WILDCARD
						$indexed = true;
						break;
					}
					
					$req .= $wd . " ";
				}
				$isOptional = false;
				//echo $this->base_string;
				if ( $optionals ){
					$options = $cmd_req_words[sizeof($cmd_req_words)-1];
					//echo $options;
					
					$options = str_replace("{", "", $options);
					$options = str_replace("}", "", $options);
					
					$toptions = explode("|", $options);
					
					//echo substr($CMD->command_format, strpos($CMD->command_format, "%a")+3);
					
					$isOptional = false;
					$isIndexed = false;	
					foreach ( $toptions as $topt ){	
						
						if ( $this->base_string == substr($CMD->command_format, 0, strpos($CMD->command_format, "%a")) . $topt ){
							$isOptional=true;
							
						}
					}
				}
				
				if ( $indexed ){
					$options = $cmd_req_words[sizeof($cmd_req_words)-1];
					//echo $options;
					
					$options = str_replace("{", "", $options);
					$options = str_replace("}", "", $options);
					
					//echo $this->base_string."<br />";
					//echo $options; 
					$toptions = explode(".", $options);
					//echo "SELECT * FROM ".$toptions[0]." WHERE `".$toptions[1]."` = '".$this->base_string."'";
					
					$q = mysqli_query ( $this->db, "SELECT * FROM ".$toptions[0]." WHERE `".$toptions[1]."` = '".$this->base_string."'" );
					
					if ( mysqli_num_rows ( $q ) > 0 ){
						$isIndexed = true;	
					}
					
				}
				
				if( (strpos($this->base_string,$req) !== FALSE && $isOptional == FALSE ) || $this->base_string == $CMD->command_format || $isOptional == true || $wildcard || $isIndexed){
					
					//GET SUB_STRING LENGTH OF BASE_STRING UP UNTIL REQ_STRING FOUND
					$search_sub_len = strlen(substr($this->base_string, strpos($this->base_string,$req), strlen($req)));
					
					$CMD->command_response = str_replace("{uber:request_param}", '"'.substr($this->base_string, strpos($this->base_string,$req)+$search_sub_len, strlen($this->base_string)).'"', $CMD->command_response);
					
					$cmd_fnd=true;
					
					//FINAL RESPONSE
					echo $CMD->command_response;
					break;
				} else{
						
				}
			}
			if ( !$cmd_fnd) { echo "NO COMMAND FOUND: " . $this->base_string; }
		}
		
	}
	
	require_once("commands.php");
	
	$db = mysqli_connect ( "", "", "", "" );
	$request->db = $db;
	$request->update_base_string($REQ_STRING);
	
	$request->parse_request($CMD);
?>
