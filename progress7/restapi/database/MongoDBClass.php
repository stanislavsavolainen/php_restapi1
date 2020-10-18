<?php

class MongoDatabaseClass
{

	public $mongoDriver;
	public $mongoQuery;
	public $mongoSelectAll;

	public $databaseName;
	public $collectionName;
	public $dbcol;

	public $mongoConnectionStatus;
	public $mongoActionStatus;


	public $databaseRestConfig;



	public function __construct($paramConfig)
	{

		$this->databaseName = $paramConfig->mongoDataBaseName;  //$this->databaseName = "test";
		$this->collectionName = $paramConfig->mongoDataBaseCollectionName; //$this->collectionName = "php1";

		$this->dbcol = ($this->databaseName) . "." . ($this->collectionName);


		try {
			$this->mongoDriver = new MongoDB\Driver\Manager();
			$this->mongoQuery = new MongoDB\Driver\Query([]);
			$rows = ($this->mongoDriver)->executeQuery($this->dbcol, ($this->mongoQuery));
			//( $this->databaseName) . "." . ( $this->collectionName)	
			$this->mongoConnectionStatus = true;
		} catch (Exception $mongoConnectionException) {
			$this->mongoConnectionStatus = false;
		}
	}


	public function createDeviceForConnectionLink($paramDeviceUUID, $paramJWTtoken)
	{

		//$uuidService = new UUID();

		//$mongoDataRowId = $uuidService->v4();
		$selectedBulkId = (new MongoDB\BSON\ObjectID);

		$newCollection = array(   
			//"_id" =>  $selectedBulkId , //new MongoDB\BSON\ObjectID, 
			"deviceUUID" => $paramDeviceUUID,
			"jwtToken" => $paramJWTtoken
		);


		// http://zetcode.com/db/mongodbphp/

		try {
			$bulk = new MongoDB\Driver\BulkWrite;

			$bulk->insert($newCollection);
			($this->mongoDriver)->executeBulkWrite($this->dbcol, $bulk);

			//echo var_dump($bulk);

			$this->mongoActionStatus = true;
		} catch (Exception $mongoDbException) {

			$this->mongoActionStatus = false;
		}
	}


	public function bindJWTtokenToConnectionDevice($paramDeviceUUID, $paramJWTtoken)
	{
		//https://www.php.net/manual/en/mongodb-driver-bulkwrite.update.php
		//https://www.php.net/manual/en/class.mongodb-driver-bulkwrite.php

		try {

			$bulkk = new MongoDB\Driver\BulkWrite;
			$bulkk->update(
				['deviceUUID' => $paramDeviceUUID],
				['$set' => ['jwtToken' => $paramJWTtoken]],
				['multi' => false, 'upsert' => false]
			);

			($this->mongoDriver)->executeBulkWrite($this->dbcol, $bulkk);

			$this->mongoActionStatus = true;
		} catch (Exception $mongoDbException) {

			$this->mongoActionStatus = false;
		}
	}


	public function searchAllDevices()
	{
		$this->mongoSelectAll = ($this->mongoDriver)->executeQuery($this->dbcol, $this->mongoQuery);
		return $this->mongoSelectAll;
	}
}
