<?php

require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;


function newClient() {
	$client = new Client([
	    // Base URI is used with relative requests
	    'base_uri' => 'http://localhost:3000/',
	    // You can set any number of default request options.
	    'timeout'  => 3.0,
	    'http_error' => false
	]);

	return $client;
}

?>