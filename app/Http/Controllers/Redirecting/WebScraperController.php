<?php

  namespace App\Http\Controllers\Redirecting;

  use Illuminate\Http\Request;
  use Goutte\Client;
  use Symfony\Component\DomCrawler\Crawler;
  use App\Http\Requests;
  class WebScraperController extends Controller
  {
  public function index()
  {
  //  Create a new Goutte client instance
    $client = new Client();

 //  Hackery to allow HTTPS
    $guzzleclient = new \GuzzleHttp\Client([
        'timeout' => 60,
        'verify' => false,
    ]);

    // Create DOM from URL or file
    $html = file_get_html('https://www.facebook.com');

    return $html;
    // Find all images
    foreach ($html->find('img') as $element) {
        echo $element->src . '<br>';
    }

    // Find all links
    foreach ($html->find('a') as $element) {
        echo $element->href . '<br>';
    }
  }
}