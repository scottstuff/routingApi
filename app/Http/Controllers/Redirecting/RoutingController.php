<?php

namespace App\Http\Controllers\Redirecting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helper\HadeHelpers;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Http\Requests;
use Illuminate\Support\Facades\Log;

class RoutingController extends Controller {
	
	public $request;
	public $siteNameMap = [];
    public $baseUrl;
    public $Url;
    public $fullUrl;
    public $siteName;
    public $redirectUrl;

    public function __construct() {

        $this->baseUrl = 'https://min-api.cryptocompare.com/data/';
        $this->siteNameMap['newsApi'] = 'http://172.17.0.3';
        $this->siteNameMap['crypto'] = 'http://172.17.0.5';
        $this->siteNameMap['dru8'] = 'http://172.17.0.6';
        $this->siteNameMap['dru8another'] = 'http://172.17.0.7';
        $this->siteNameMap['wp'] = 'http://172.17.0.8';
        $this->siteNameMap['default'] = 'http://172.17.0.6';

    }
// https://accounts.google.com/signin/oauth/oauthchooseaccount?client_id=292824132082.apps.googleusercontent.com&as=2dtUNAIpHDgMKh3pfvUMsg&nosignup=1&destination=https%3A%2F%2Fdevelopers.google.com&approval_state=!ChR1WUd3YlN0VmtRYUhobXNXR2VpdRIfMHdHUnZVN3dMTThZWVBySnhCXzdTNUlGTFd5S0hSWQ%E2%88%99ACThZt4AAAAAWpb9Nr44q25oBFjq_qHcjD3F73ROzDY6&delegation=1&xsrfsig=AHgIfE-jcoxyTq-uWoijNmXhC6m7FRS1sw&flowName=GeneralOAuthFlow
    public function init(Request $request) {
        $this->request = $request->all();

        $this->redirectUrl = $this->getRedirectUrl($request);
        // $tmp_end - $tmp_start;
//         $urlSegements = $request->segments();
//         if ( $request->is('blue')) {
// Log::debug('is blue: ' );

//         }

// Log::debug('gettype(urlSegements): ' . gettype($urlSegements));

// Log::debug('$request->is(blue): ' . $request->is('blue'));
// Log::debug('$request->root(): ' . $request->root());
// Log::debug('$request->segments(): ' . print_r($request->segments(), true));
// Log::debug('$request->segment($index): ' . print_r($request->segment(1), true));

// Log::debug('tmp_start: ' . $tmp_start);
// Log::debug('tmp_end: ' . $tmp_end);
// Log::debug('tmp_length: ' . $tmp_length);
Log::debug('this->siteName: ' . $this->siteName);
Log::debug('this->redirectUrl: ' . $this->redirectUrl);

    }

	public function index(Request $request) {

		$this->request = $this->init($request);

		// if ($this->redirectUrl == $this->siteNameMap['default']) {
		// 	return '<h1>basic</h1>';
		// }
Log::debug('this->Url: ' . $this->Url);
Log::debug('this->fullUrl: ' . $this->fullUrl);
// error_log('this->request: ' . print_r($this->request, true));
  //  Create a new Goutte client instance
    // $client = new Client();

 //  Hackery to allow HTTPS
    $guzzleclient = new \GuzzleHttp\Client([
        'timeout' => 60,
        'verify' => false,
    ]);

	$body = HadeHelpers::guzzleGet([
		'method' => 'GET',
		'URL' => $this->redirectUrl,
		'body' => $this->request
	]);

Log::debug('bodyl: ' . $body);

// error_log('body: ' . print_r($body, true));
	return $body;
    // Create DOM from URL or file
    // $html = file_get_html('https://www.facebook.com');

    // return $html;
    // // Find all images
    // foreach ($html->find('img') as $element) {
    //     echo $element->src . '<br>';
    // }

    // // Find all links
    // foreach ($html->find('a') as $element) {
    //     echo $element->href . '<br>';
    // }
  	}

  	private function getRedirectUrl(Request $request) {

        $this->Url = $request->Url();
        // $this->fullUrl = $request->fullUrl();
        $tmp_start = strpos($this->Url, '//') + 2;
        $tmp_end = strpos($this->Url, '.');
        $tmp_length = $tmp_end - $tmp_start;
        $this->siteName = substr($this->Url, $tmp_start, $tmp_length);

  		if ( array_key_exists( $this->siteName,  $this->siteNameMap)) {
  			return $this->siteNameMap[$this->siteName];
  		}
  		return $this->siteNameMap['default'];
  	}


    public function index2(Request $request) {
        $this->init($request);
        // return ('<h1>Got Here!</h1>');
    	$body = HadeHelpers::guzzleGet([
    		'method' => 'GET',
    		'URL' => 'http://blue.sco.com:8080',
    		'body' => $this->request
    	]);

    	$parsedBody = self::leanHistoryToTheMinute(json_decode($body,true));

		return $parsedBody;
		$requestObject = function (Request $request) {return $request;};
		$request = $requestObject->all();
		error_log('request: ' . print_r($request, true));
		$body = HadeHelpers::guzzleGet([
			'method' => 'GET',
			'URL' => $this->baseUrl . 'histominute',
			'body' => $this->request
		]);

		error_log('body: ' . print_r($body, true));
		return $body;
		// ?$returnHtml = json_decode($body,true));

    }
}