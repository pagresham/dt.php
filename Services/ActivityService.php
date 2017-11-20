<?php

require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

/**
* Activity Service
*/
class ActivityService 
{
	private $_client;
	private $baseUrl = "http://localhost:3000/api/"; 
	private $getAllURL = "http://localhost:3000/api/activity";


	function __construct($client)
	{
		$this->_client = $client;
	}

	/**
	 * Gets all Entries from Api
	 */
	function getActivities() {
		$url = $this->getAllURL;
		// $resp = file_get_contents($url);
		$resp = $this->_client->get($url);


		$body = $resp->getBody();
		$activities = json_decode($body);


		if($activities)
			return $activities;
		else 
			return null;
	}


}

?>