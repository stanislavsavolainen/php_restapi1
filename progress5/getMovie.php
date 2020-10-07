<?php

//include "MyConfigurationData.php";
require "./config/ConfigClass.php";
$movieRestConfig = new ConfigClass();

$clientParamTitle = "";
$clientParamYear = "";
$clientVersionOfPlot = "";

//-------------------------
//JWT stuff
$myJWTWebToken = "";
require 'JwtHandler.php';
$jwt = new JwtHandler();
//-------------------------


$myurl = "http://www.omdbapi.com/?apikey=" . $movieRestConfig->personalApiKey . "&r=json";

$urlQueryString = "";

if (isset($_GET['title'])) {
	$clientParamTitle = $_GET['title'];
	$urlQueryString .= '&t=';
	$urlQueryString .= $clientParamTitle; //append to string	
}

if (isset($_GET['year'])) {
	$urlQueryString .= '&y=';
	$clientParamYear = $_GET['year'];
	$urlQueryString .= $clientParamYear; //append to string	
}


if (isset($_GET['plot'])) {
	$clientVersionOfPlot = $_GET['plot'];
	$urlQueryString .= '&plot=';
	$urlQueryString .= $clientVersionOfPlot; //append to string	
}


$myurl .= $urlQueryString;

//$json = file_get_contents($myurl);

//echo $json;


//====================== verify client jwt-token =========================


//verify jwt token, if given jwt-token is not modified by client
if (isset($_GET['jwtstring'])  &&  isset($_GET['deviceId'])) {

	$inputHardware = $_GET['deviceId'];
	$userJWTToken = $_GET['jwtstring'];

	$deviceAndTokenMatch = false;

	foreach (($movieRestConfig->permissionHardwareList) as $compareHardware) {

		if ($compareHardware == $inputHardware) {

			$myfile = fopen($movieRestConfig->apacheAbsolutePath  . $inputHardware . ".txt", "r");
			$serverJWTTOken = fread($myfile, filesize($movieRestConfig->apacheAbsolutePath . $inputHardware . ".txt"));
			fclose($myfile);
		
			//compare client jwt-token and server jwt-token based on client hardware-id 
			if ($serverJWTTOken == $userJWTToken) {
				//echo "jwt match";	


				$deviceAndTokenMatch = true;

				//========= check if jwt token is expired ========

				$decodedJwtToken =  $jwt->_jwt_decode_data(trim($serverJWTTOken));
				$jwtTokenExpDate =   $jwt->_jwt_expiration_date(trim($serverJWTTOken));


				date_default_timezone_set('Europe/Helsinki');
				//https://stackoverflow.com/questions/365191/how-to-get-time-difference-in-minutes-in-php

				$info = getdate();
				$date = $info['mday'];
				$month = $info['mon'];
				$year = $info['year'];
				$hour = $info['hours'];
				$min = $info['minutes'];
				$sec = $info['seconds'];

				$nowDateTimeString = $year . '-' . $month . '-' . $date . ' ' . $hour . ':' . $min . ':' . $sec;

				//convern date to seconds 
				$currdate = strtotime($nowDateTimeString);

				$tokenValidTimeLeft =  $jwtTokenExpDate - $currdate;

				//
				if ($tokenValidTimeLeft < 0) {

					$tokenValidTimeLeft = -1;

					$jwtJson = array(
						"error_msg" =>  "your jwt-token is valid, but expired, just refresh Client page !", 
						"jwt_expired" => true
					);
					echo json_encode($jwtJson);
				} else {
					//echo '<font color="green"> date now :'.$tokenValidTimeLeft. "</font>";


					//get movie information if jwt/token match
					$json = file_get_contents($myurl);
					$httpResponse = $json;
					echo $httpResponse;
				}
				//================================================


			}

			break;
		}
	} 

	if( ! $deviceAndTokenMatch ){
		$jwtJson = array("error_msg" =>  "no valid jwt-token found. This error caused by following reason : cookies are disabled and  deviceId(cookie) is not initalized. Your actions are refresh browser page and allow cookie on this page.");
					echo json_encode($jwtJson);
	}


} else {

	$httpResponse = '{ "error_msg" : "no valid jwt-token found, try to connect via client program !" }';
	echo $httpResponse;
}

?>
