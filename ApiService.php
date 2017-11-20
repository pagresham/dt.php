<?php


require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;



/**
* 
*/
class ApiService
{

	private $client; 
	
	
	private $baseUrl = "http://localhost:3000/"; 
	private $getUserURL =  "http://localhost:3000/user"; 
	private $getActivityURL = "http://localhost:3000/api/activity";
	private $getUser = "http://localhost:3000/user/id/";
	private $getUserByUname = "http://localhost:3000/user/uname/";

	function __construct()
	{
		$this->client = new Client([
		    // Base URI is used with relative requests
		    'base_uri' => 'http://localhost:3000/',
		    // You can set any number of default request options.
		    'timeout'  => 3.0,
		    'http_error' => false
		]);
	}

	public function getUsers() {
		$resp = file_get_contents($this->getUserURL);
		// check response status / error here?
		return json_decode($resp);
	}

	public function getUser($_id) {
		$resp = file_get_contents($this->getUser . $_id);
		return json_decode($resp);
	}


	public function getUserByUname($uname) {
		$resp = $this->client->get($this->getUserByUname . $uname);
		if($resp->getStatusCode() == 200 && $resp->getReasonPhrase() == "OK") {
			
			$body = $resp->getBody();
			$user = json_decode($body);
			return $user[0];
		}
	}




	public function getActivities() {
		$resp = file_get_contents($this->getActivityURL);
		// check response status / error here?
		return json_decode($resp);
	}





}



?>