<?php

	//$myurl = "https://openlibrary.org/api/books?bibkeys=ISBN:0451526538&callback=mycallback";
	$myurl = "https://openlibrary.org/api/books";
	
	//-------------------------

	$clientParamIsbn = "";
	

	//-------------------------

	$httpResponse = "";


	//header("Content-Type : application/json");

	//

	// http://127.0.0.1/..../getBook.php?isbn=0451526538  ( example how php client call it) 

	//assume that openlibrary rest-api don't get else parameter than isbn

	//echo "where is isbn number ?";


	if( isset( $_GET['isbn'] ) ) {
		
		$myurl .= "?";

		$clientParamIsbn = "bibkeys=ISBN:".$_GET['isbn'];

		$myurl .= $clientParamIsbn;

		$myurl .= "&callback=mycallback";

		$rawnotvalidjson = file_get_contents($myurl);

		$validJson = makeJSONForPhpClient( $rawnotvalidjson );

		 $httpResponse = $validJson; //json_encode($validJson);
		 echo $httpResponse;
			

	} else {

   		$msg1 = '{ data : "no book found, isbn missing" }';

		$httpResponse = $msg1;  //json_encode($msg1);
		echo $httpResponse;

	}


	//because openlibrary returns not valid json with callback and etc junk
	// this function fix not valid json and make it friendly with php object ( easy handle)
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
			$msg2 = '{ data : "no book found, problem with parsering server data" }';
			return $msg2; 
		}		

	}

	

?>
