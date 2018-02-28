<?php

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Helper\HadeHelpers;
// use Exception;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// public $request;
// public $returnHtml;
// public $baseUrl;

    // public function __construct() {
    //     $this->baseUrl = 'https://min-api.cryptocompare.com/data/';
    // }

    // public function init(Request $request) {
    //     $this->request = $request->all();
    // }

error_log('in web.php routes');

HadeHelpers::inGuzzle();

// Route::get('/*', 'Redirecting\RoutingController@index');

// Route::resource('/','Redirecting\WebScraperController@index');
// Route::any( '(.*)','Redirecting\RoutingController@index');
Route::get('/','Redirecting\RoutingController@index');
// Route::get('/{any}','Redirecting\RoutingController@index');
//  function( $page ){
//     dd($page);
// });

// Route::resource('scrape','WebScraperController@index');

// Route::get('/', function () {
// 	// return http://www.google.com
//     return view('welcome');
// });
