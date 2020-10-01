<?php

    $personalApiKey = "..."; // get your own api-key from http://www.omdbapi.com 
    // also you can  create .env-file for api-key
	//-------------------------

	$clientParamTitle = "";
	$clientParamYear = "";
	$clientVersionOfPlot = "";

    //-------------------------
    
    //JWT stuff
    $myJWTWebToken = "";
	require 'JwtHandler.php';
	$jwt = new JwtHandler();


	//create files like uuid-string-1.txt on server side and make permission "chmod 777 uuid-string-1.txt"
	$permissionHardwareList = array( "uuid-string-1" , "uuid-string-2" , "uuid-string");  


    //-------------------------


	$myurl = "http://www.omdbapi.com/?apikey=".$personalApiKey."&r=json";
	
	$urlQueryString = "";

	if( isset( $_GET['title'] ) ) {
		$clientParamTitle = $_GET['title'];
		$urlQueryString .= '&t=';
		$urlQueryString .= $clientParamTitle; //append to string	
	}

	if( isset( $_GET['year'] ) ) {
		$urlQueryString .= '&y=';
		$clientParamYear = $_GET['year'];
		$urlQueryString .= $clientParamYear; //append to string	
	}


	if( isset( $_GET['plot'] ) ) {
		$clientVersionOfPlot = $_GET['plot'];
		$urlQueryString .= '&plot=';
		$urlQueryString .= $clientVersionOfPlot; //append to string	
	}
	

	$myurl .= $urlQueryString;

	//$json = file_get_contents($myurl);

	//echo $json;


    //====================== verify client jwt-token =========================


		//verify jwt token, if given jwt-token is not modified by client
		if( isset( $_GET['jwtstring'] )  &&  isset( $_GET['deviceId'] ) ){

			$inputHardware = $_GET['deviceId'];
			$userJWTToken = $_GET['jwtstring'];			

			foreach ( $permissionHardwareList as $compareHardware ) {

				if( $compareHardware == $inputHardware ){ 
				
					//read jwt-token from server for selected device
					$absolutepath = "/var/www/html/progress2/";
					$myfile = fopen( $absolutepath . $inputHardware.".txt" , "r");
					$serverJWTTOken = fread( $myfile, filesize(  $absolutepath. $inputHardware.".txt") );
					fclose($myfile);
					//echo "try jwt check >>>> ".$serverJWTTOken;
					//compare client jwt-token and server jwt-token based on client hardware-id 
					if( $serverJWTTOken == $userJWTToken )	{
					 //echo "jwt match";	
                        
                       //get movie information if jwt/token match
                       $json = file_get_contents($myurl);    
                       $httpResponse = $json;
                       echo $httpResponse;

					}

				break;	
				}		
			
			}
		
		} else {

			$httpResponse = '{ "result" : "no valid jwt-token found, try to connect via client program !" }';
			echo $httpResponse;
		} 



?>
