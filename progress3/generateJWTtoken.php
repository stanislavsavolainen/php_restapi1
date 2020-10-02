<?php

	include "MyConfigurationData.php";

	require 'JwtHandler.php';
	$jwt = new JwtHandler();

	$jwtTokenSignature = array( "tokenDevice" => "unknown"); //jwt payload

	$httpResponse = "";
	
	// header('Content-type : application/json');

	$deviceFound = false;

	if( isset( $_GET['deviceId'] ) ){

		$inputHardware = $_GET['deviceId'];

		//$httpResponse = 1;

		foreach ( $permissionHardwareList as $compareHardware ) {

			if( $compareHardware == $inputHardware ){

				$httpResponse = $compareHardware;
								
				$deviceFound = true;
				
				$token = $jwt->_jwt_encode_data(
					'http://localhost/progress2/',
					$jwtTokenSignature
				);

				//echo '{"jwt_token" :  "'.$token.'"}';  //provide jwt-token to client + json form
                
				$jwtJson = array( "jwt_json" => $token );
				//$httpResponse = json_encode ( $jwtJson);
				//echo $httpResponse;
				echo json_encode ( $jwtJson );

				//save token to server text-file
				//$absolutepath = "/var/www/html/progress2/";
				$myfile = fopen( $apacheAbsolutePath . $inputHardware.".txt" , "w" );  
				//write jwt-token string to file on server to veritify it in future				
				fwrite($myfile, $token);
				fclose($myfile);
				
				break; //break for-each loop , not need search anymore
			}

		} // for-each 
		
		
		if( $deviceFound == false){
			//echo '{ "error_msg" : "you do not have permission for jwt-token, ask support for more information"}';
			$jwtJson = array( "error_msg" =>  "you do not have permission for jwt-token, ask support for more information");
			echo json_encode ( $jwtJson );
		}


	} else {
			//echo '{ "error_msg" : "who are you ? how you find this url ?"}';
			$jwtJson = array( "error_msg" =>  "who are you ? how you find this url ?");
			echo json_encode ( $jwtJson );
	}


?>
