<?php

require 'vendor/autoload.php';
// use GuzzleHttp\Client;
// use GuzzleHttp\Psr7;
// use GuzzleHttp\Exception\RequestException;

/**
* Trip Service
*/
class TripService 
{
	private $_client;
	private $baseUrl = "http://localhost:3000/api"; 
	private $getAllURL = "http://localhost:3000/api/entry";


	function __construct($client)
	{
		$this->_client = $client;
	}

	function testService() {
		print "<p>Test Service</p>";
	}

	/**
	 * Gets all Entries from Api
	 */
	function getEntries() {
		
		$resp = file_get_contents($this->getAllURL);
		if($resp) {
			return json_decode($resp);
		}
		else 
			return null;
	}

	public function newTrip($arr) {
		// print_r($arr);
		// Didnt strip chars, didnt add slashes, Did remove SpecialChars
		// DB will add slashes, dont need urlencode
		// What to do since Tere are a couple fields that are not required
		// city, state, lat, lon are not req.
		// So do I check here if they are true, and submit or not submit. Because I dont want enmty records in the DB
		// But the DB/APi shoud be able to handle either case
		$latlon = $arr['lat'] . ","  . $arr['lon'];
		$resp = $this->_client->request('POST', 'api/entry', ['http_errors' => false, 
															'json' => [
																'name' => $arr['tname'], 
																'description' => $arr['description'], 
																'latlon' => $latlon,
																'dateOf' => $arr['date'], 
																'difficulty' => $arr['difficulty'], 
																'rating' => $arr['rating'],
																'city' => $arr['city'], 
																'state' => $arr['state'],
																'activity' => $arr['activity'],
																'owner' => $arr['owner'],  
															]]);
		if($resp->getStatusCode() == 200) {
			return true;
		}
		return false;
	}

	public function getOwners() {
		return ["Pierce", "Sam", "Drew"];
	}



}

?>