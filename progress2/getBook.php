<?php

	//$myurl = "https://openlibrary.org/api/books?bibkeys=ISBN:0451526538&callback=mycallback";
	$myurl = "https://openlibrary.org/api/books";
	
	//-------------------------

	$clientParamIsbn = "";
	

	//-------------------------
	
	$myJWTWebToken = "";
	require 'JwtHandler.php';
    $jwt = new JwtHandler();
    

	//create files like uuid-string-1.txt on server side and make permission "chmod 777 uuid-string-1.txt"
	$permissionHardwareList = array( "uuid-string-1" , "uuid-string-2" , "uuid-string");  
	

	//-------------------------

	$httpResponse = "";
 

	//header("Content-Type : application/json");

	//

	// http://127.0.0.1/..../getBook1.php?isbn=0451526538 ( example how php client call it) 

	//assume that openlibrary rest-api don't get else parameter than isbn

	//echo "where is isbn number ?";

	


	if( isset( $_GET['isbn'] ) ) {
		
		$myurl .= "?";

		$clientParamIsbn = "bibkeys=ISBN:".$_GET['isbn'];

		$myurl .= $clientParamIsbn;

		$myurl .= "&callback=mycallback";

		//echo '<font color="blue">' . $myurl . '</font>';

		$rawnotvalidjson = file_get_contents($myurl);

		//echo '<font color="red">' . $rawnotvalidjson . '</font>';
		
		$validJson = makeJSONForPhpClient( $rawnotvalidjson );





		// $httpResponse = $validJson; //json_encode($validJson);
		// echo $httpResponse;


		//verify jwt token, if given jwt-token is not modified by client
		if( isset( $_GET['jwtstring'] )  &&  isset( $_GET['deviceId'] ) ){

			$inputHardware = $_GET['deviceId'];
			$userJWTToken = $_GET['jwtstring'];			

			foreach ( $permissionHardwareList as $compareHardware ) {

				if( $compareHardware == $inputHardware ){ 
				

					//echo "device found";
					//read jwt-token from server for selected device
					$absolutepath = "/var/www/html/progress2/";
					$myfile = fopen( $absolutepath . $inputHardware.".txt" , "r");
					$serverJWTTOken = fread( $myfile, filesize( $absolutepath . $inputHardware.".txt") );
					fclose($myfile);
					//compare client jwt-token and server jwt-token based on client hardware-id 
					if( $serverJWTTOken == $userJWTToken )	{
					 //echo "jwt match";	
					    $httpResponse = $validJson; //json_encode($validJson);
					    echo $httpResponse;

					}

				break;	
				}		
			
			}
		
		} else {

			$httpResponse = '{ "result" : "no valid jwt-token found, try to connect via client program !" }';
			echo $httpResponse;
		} 


	} else {

   		$msg1 = '{ "data" : "no book found, isbn missing" }';

		$httpResponse = $msg1;  //json_encode($msg1);
		echo $httpResponse;

	}


	//because openlibrary returns not valid json with callback and etc junk
	// this function fix not valid json and make it friendly with php object handle 
	function makeJSONForPhpClient( $rawNotValidJSON ) {

		if( strlen($rawNotValidJSON) != 0 ) {
			
			$subJson1 = substr( $rawNotValidJSON , 11 , strlen( $rawNotValidJSON ) - 11 - 2 ); 

			$innerObjectBeginIndex = 0;

			for( $i = 0 ; $i < strlen( $subJson1  ); $i++) {
		
				if( $subJson1 [$i] == "{" && $i != 0) {
				$innerObjectBeginIndex = $i;
				}

			}	

		$subJson2 =  substr( $subJson1 , $innerObjectBeginIndex , strlen( $subJson1 ) - $innerObjectBeginIndex - 1 ); 			

		return $subJson2;	

		} else{
			$msg2 = '{ "data" : "no book found, problem with parsering server data" }';
			return $msg2; // return empty json , if there is no isbn number
		}		

	}

	

?>
