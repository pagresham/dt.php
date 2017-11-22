<?php

require 'vendor/autoload.php';


/**
* 
*/
class UserService
{

	private $client; 
	
	private $baseUrl = "http://localhost:3000/"; 
	private $getUserURL =  "http://localhost:3000/user/"; 
	private $getActivityURL = "http://localhost:3000/api/activity";
	private $getUser = "http://localhost:3000/user/id/";
	private $getUserByUname = "http://localhost:3000/user/uname/";

	function __construct($myClient)
	{
		$this->client = $myClient; 
	}

	public function getUsers() {
		$resp = file_get_contents($this->getUserURL);
		// check response status / error here?
		return json_decode($resp);
	}

	public function getUsersNames() {
		$resp = file_get_contents($this->getUserURL);
		$ownersJson = json_decode($resp);
		function getNames($o) {
			return $o->uname;
		}
		$ownerNames = array_map('getNames', $ownersJson);
		return $ownerNames; 
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
		else return null;
	}

	public function newUser($uname, $email, $password) {
		$resp = $this->client->request('POST', 'user/new', ['http_errors' => false, 'json' => ['uname' => $uname, 'email' => $email, 'password' => $password]]);
		if($resp->getStatusCode() == 200) {
			return true;
		}
		return false;
	}

	// $params is an associative array of params to pass
	public function updateUser($params) {
		$urlPartial = 'user/new/'. $params['_id'];
		$resp = $this->client->request('PUT', $urlPartial, ['http_errors' => false, 'json' => ['uname' => $params['uname'], 'email' => $params['email']]]);
		if($resp->getStatusCode() == 200) {
			return true;
		}
		else return false;
	}


// 	$code = $response->getStatusCode(); // 200
//  $reason = $response->getReasonPhrase(); // OK
	// Delete User
	public function deleteUser($_id) {
		print_r($_id);
		// $url = $this->getUserURL . "" .  $_id;
		print_r($this->getUserURL . $_id);
		$urlPartial = $this->getUserURL . $_id;
		print "<br>". $urlPartial;
		$resp = $this->client->delete("http://localhost:3000/user/" . $_id);
		print_r($resp->getStatusCode());
	}



	public function getActivities() {
		$resp = file_get_contents($this->getActivityURL);
		// check response status / error here?
		return json_decode($resp);
	}





}



?>