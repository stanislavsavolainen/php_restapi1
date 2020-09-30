<?php

    $personalApiKey = "...."; // get your own api-key from http://www.omdbapi.com 
    // also you can  create .env-file for api-key
	//-------------------------

	$clientParamTitle = "";
	$clientParamYear = "";
	$clientVersionOfPlot = "";

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

	$json = file_get_contents($myurl);

	echo $json;

?>
