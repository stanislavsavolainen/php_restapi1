<?php

class ConfigClass{

    public $apacheAbsolutePath;
    public $personalApiKey;
    public $permissionHardwareList;
    public $myProjectHost;
    public $bookIsbnArray;
    public $movieTitleArray; 

    public function __construct() { 
        
        $this->myProjectHost = "http://192.168.10.47/progress6";
        $this->apacheAbsolutePath ="/var/www/html/progress6/restapi/";
        $this->personalApiKey = "...";
        $this->permissionHardwareList = array("uuid-string-1" , "uuid-string-2" , "uuid-string");
        $this->bookIsbnArray = array( "0451526538" , "9780131101630" ,  "0071508546" , "0321349806" );
        $this->movieTitleArray = array( "Terminator" , "Terminator_2" , "Terminator_3" , "Hackers" , "Final_Destination" );

    }   
    
}

?>
