<?php

class ConfigClass{

    public $apacheAbsolutePath;
    public $personalApiKey;
    public $permissionHardwareList;
    public $myProjectHost;
    public $bookIsbnArray;
    public $movieTitleArray; 

    public function __construct() { 
        
        $this->myProjectHost = "http://127.0.0.1/progress5";
        $this->apacheAbsolutePath ="/var/www/html/progress5/";
        $this->personalApiKey = "...";
        $this->permissionHardwareList = array("uuid-string-1" , "uuid-string-2" , "uuid-string");
        $this->bookIsbnArray = array( "0451526538" , "9780131101630" ,  "0071508546" , "0321349806" );
        $this->movieTitleArray = array( "Terminator" , "Terminator_2" , "Terminator_3" , "Hackers" , "Final_Destination" );

    }   
    
}

?>
