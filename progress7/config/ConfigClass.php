<?php

class ConfigClass
{

    public $apacheAbsolutePath;
    public $personalApiKey;
    public $permissionHardwareList;
    public $myProjectHost;
    public $bookIsbnArray;
    public $movieTitleArray;
    public $mongoDataBaseName;
    public $mongoDataBaseCollectionName;


    public function __construct()
    {

        $this->myProjectHost = "http://192.168.10.47/progress7";

        // "absolute path" not used anymore, because it refers to text-files => device and jwt data stored in MongoDB
        // $this->apacheAbsolutePath ="/var/www/html/progress6/restapi/"; 
        $this->personalApiKey = "...";
        $this->bookIsbnArray = array("0451526538", "9780131101630",  "0071508546", "0321349806");
        $this->movieTitleArray = array("Terminator", "Terminator_2", "Terminator_3", "Hackers", "Final_Destination");


        $this->mongoDataBaseName = "test";
        $this->mongoDataBaseCollectionName = "php1";
    }
}
