<?php

$bookIsbnArray = array( "0451526538" , "9780131101630" ,  "0071508546" );
$movieTitleArray = array( "Terminator" , "Terminator_2" , "Terminator_3" , "Hackers" , "Final_Destination" );

$myProjectHost = "http://127.0.0.1/progress4";

$apacheAbsolutePath = "/var/www/html/progress4/";

$personalApiKey = "...";
// get your own api-key from http://www.omdbapi.com 
// also you can  create .env-file for api-key

//create files like uuid-string-1.txt on server side and make permission "chmod 777 uuid-string-1.txt"
$permissionHardwareList = array( "uuid-string-1" , "uuid-string-2" , "uuid-string");  

?>
