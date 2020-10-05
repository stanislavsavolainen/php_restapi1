<?php

// include "MyConfigurationData.php"; -> replaced to ConfigClass

require "./config/ConfigClass.php";
$restConfig = new ConfigClass();

require 'JwtHandler.php';
$jwt = new JwtHandler();


$jwtTokenSignature = array("tokenDevice" => "unknown", "tokenCreatedAt" => "2015-01-26 12:01:00"); //jwt payload


$httpResponse = "";


// header('Content-type : application/json');


$deviceFound = false;

if (isset($_GET['deviceId'])) {

	$inputHardware = $_GET['deviceId'];

	//$httpResponse = 1;

	foreach ( ($restConfig->permissionHardwareList) as $compareHardware) {

		if ($compareHardware == $inputHardware) {

			$httpResponse = $compareHardware;

			$deviceFound = true;

			// set default timezone
			date_default_timezone_set('Europe/Helsinki'); // CDT

			$info = getdate();
			$date = $info['mday'];
			$month = $info['mon'];
			$year = $info['year'];
			$hour = $info['hours'];
			$min = $info['minutes'];
			$sec = $info['seconds'];

			$fmonth = ""; 
			$fdate = "";
			$fhour = "";
			$fmin = "";
			$fsec = "";

			if( $month < 10 ) $fmonth .="0".$month;
			else if ( $month > 9 ) $fmonth .=$month;
			
			if( $day < 10 ) $fdate .="0".$date;
			else if ( $day > 9 ) $fdate .= $date;
			
			if( $hour < 10 ) $fhour .="0".$hour;
			else if ( $hour > 9 ) $fhour .=$hour;

			if( $min < 10 ) $fmin .="0".$min;
			else if ( $min > 9 ) $fmin .=$min;

			if( $sec < 10 ) $fsec .="0".$sec;
			else if ( $sec > 9 ) $fsec .=$sec;

			//"2015-01-26 12:01:00"


			$jwtTokenSignature["tokenCreatedAt"] = "".$year."-".$fmonth."-".$fdate." ".$fhour.":".$fmin.":".$fsec;
			$jwtTokenSignature["tokenDevice"] = $inputHardware; 


			$token = $jwt->_jwt_encode_data(
				($restConfig->myProjectHost).'/',  //'http://localhost/progress2/',
				$jwtTokenSignature
			);

			 //provide jwt-token to client + json form
			$jwtJson = array("jwt_json" => $token);
			echo json_encode($jwtJson);

			//save token to server text-file
			$myfile = fopen($restConfig->apacheAbsolutePath . $inputHardware . ".txt", "w");
			//write jwt-token string to file on server to veritify it in future				
			fwrite($myfile, $token);
			fclose($myfile);

			break; //break for-each loop , not need search anymore
		}
	}


	if ($deviceFound == false) {
		//echo '{ "error_msg" : "you do not have permission for jwt-token, ask support for more information"}';
		$jwtJson = array("error_msg" =>  "you do not have permission for jwt-token, ask support for more information");
		echo json_encode($jwtJson);
	}
} else {
	//echo '{ "error_msg" : "who are you ? how you find this url ?"}';
	$jwtJson = array("error_msg" =>  "who are you ? how you find this url ?");
	echo json_encode($jwtJson);
}
