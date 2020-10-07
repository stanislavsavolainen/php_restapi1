<?php


    require "../config/ConfigClass.php";
    $linkConfig = new ConfigClass(); 

    require "UUID.php";
    $uuidService = new UUID();

     $requestSpamAndDDOSprotection = false;	


  //check by ip-address and by else user information -> request limitation logic
    if(  ! $requestSpamAndDDOSprotection ) { 

        $userConnectionLink = $uuidService->v4();


	//echo $linkConfig->apacheAbsolutePath;
        $fp = fopen( $linkConfig->apacheAbsolutePath  .'uniqueDevice.txt', 'a');//opens file in append mode   
        fwrite($fp,  ''.$userConnectionLink .PHP_EOL );  //. PHP_EOL = cross-platform line-break
        fclose($fp); 

	//create file like "98961b0b-4c37-402a-809e-6f491d5ea9ba.txt" -> uuid-string as filename 
	$fp2 = fopen(  $linkConfig->apacheAbsolutePath . 'devices/' . ( $userConnectionLink ) . ".txt" , 'w');  
        fwrite($fp2, "override this file content to jwt-token, when user cookies deviceId match to this filename via /generateJWTtoken.php");  
	fclose($fp2); 

        $uniqueConnectionJson = array("device_uuid_string" => $userConnectionLink );
	echo json_encode( $uniqueConnectionJson);


    } else {
        $uniqueConnectionJson = array("error_msg" =>  "don't spam this service ! Only one unique device number per user ");
	    echo json_encode( $uniqueConnectionJson);
    }	


?>
