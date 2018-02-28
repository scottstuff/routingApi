<?php

namespace App\Http\Controllers\Hade;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helper\HadeHelpers;

class PriceController extends Controller {
	
	public $request;
    public $baseUrl;

    public function __construct() {
        $this->baseUrl = 'https://min-api.cryptocompare.com/data/';
    }

    public function init(Request $request) {
        $this->request = $request->all();
    }

    public function hisToMinute(Request $request) {
        $this->init($request);
    	$body = HadeHelpers::guzzleGet([
    		'method' => 'GET',
    		'URL' => $this->baseUrl . 'histominute',
    		'body' => $this->request
    	]);

    	$parsedBody = self::leanHistoryToTheMinute(json_decode($body,true));

		return $parsedBody;
    }

    public function hisToHour(Request $request) {
        $this->init($request);
        $body = HadeHelpers::guzzleGet([
            'method' => 'GET',
            'URL' => $this->baseUrl . 'histohour',
            'body' => $this->request
        ]);

        $parsedBody = self::leanHistoryToTheMinute(json_decode($body,true));

        return $parsedBody;
    }

    public function hisToday(Request $request) {
        $this->init($request);
        $body = HadeHelpers::guzzleGet([
            'method' => 'GET',
            'URL' => $this->baseUrl . 'histoday',
            'body' => $this->request
        ]);

        $parsedBody = self::leanHistoryToTheMinute(json_decode($body,true));

        return $parsedBody;
    }


    public function historicalPrices(Request $request) {
        $this->init($request);
    	$body = HadeHelpers::guzzleGet([
    		'method' => 'GET',
    		'URL' => 'https://min-api.cryptocompare.com/data',
    		'endPoint' => 'histoday',
    		'body' => $this->request
    	]);

    	$parsedBody = self::leanHistoryToTheMinute(json_decode($body,true));

		return $parsedBody;
    }

    public function hisTodaywww(Request $request) {
        $this->init($request);
        $body = HadeHelpers::guzzleGet([
            'method' => 'GET',
            'URL' => 'https://min-api.cryptocompare.com/data/histominute',
            'body' => $this->request
        ]);

        $parsedBody = self::leanHistoryToTheMinute(json_decode($body,true));

        return $parsedBody;
    }

    private static function leanHistoryToTheMinute($body) {

    	$newArray = [];
    	foreach ($body['Data'] as $value) {
    		$newArray[] = [
    			intval($value['time'] . '000'),
                round(floatval($value['close']), 2, PHP_ROUND_HALF_UP),
    			round(floatval(number_format($value['volumefrom'], 2, '.', '')), 2, PHP_ROUND_HALF_UP),
    		];
    	}
    	return $newArray;
    }

}
