<?php

namespace App\Http\Helper;

use GuzzleHttp\Client;
use Exception;

class HadeHelpers {
	
	public static function guzzleGet($requestParams) {

		try {
			self::checkHttpParams($requestParams, 'GET');

		} catch (Exception $e) {
		    echo 'Caught exception: ',  $e->getMessage(), "\n";
		}

		if (!$requestParams['body']) {
			$body = [];
		} else {
			$body = $requestParams['body'];
		}

		$client = new Client();
		$resp = $client->request(
			'GET', 
			$requestParams['URL'],
			['query' => $requestParams['body']]
		);

		return $resp->getBody();
	}

	public static function guzzlePost() {

		try {
			self::checkHttpParams($requestParams, 'GET');

		} catch (Exception $e) {
		    echo 'Caught exception: ',  $e->getMessage(), "\n";
		}

	}

	public static function inGuzzle() {
error_log('in guzzle');
	}

	private static function checkHttpParams($requestParams, $expectedMethod) {

		if (!isset($requestParams['method'])) {
			throw new Exception('No HTTP method', 1001);
		}

		if (strtoupper($requestParams['method']) != strtoupper($expectedMethod)) {
			throw new Exception('HTTP method should be a ' . $expectedMethod, 1002);
		}

		if (!isset($requestParams['URL'])) {
			throw new Exception('No HTTP request URL', 1003);
		}

		return true;
	}
}