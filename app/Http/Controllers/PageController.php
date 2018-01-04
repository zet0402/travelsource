<?php

namespace App\Http\Controllers;

use APP\Slide;
// use App\rest\TokenHolder;
include(app_path().'/rest/TokenHolder.php');

use Illuminate\Http\Request;

class PageController extends Controller
{
    private static $token = null;
    
    private static $expirationDate = 0;

    public function getIndex(){
    	return view('page.trangchu');
    }
    public function getContactus(){
    	return view('page.contact_us');
    }
    public function getAbout(){
    	return view('page.about');
    }
     public function getPage404(){
    	return view('page.404');
    }
    // ==========
    public function testApi(){
        $origin = 'LAX';
        $destination = 'JFK';
        $departureDate = '2018-01-20';
        // $origin = '';
        $result = $this->executeGetCall("/v2/shop/flights/fares", $this->getRequest($origin, $destination, $departureDate));
        echo $result;
    }
    private function getRequest($origin, $destination, $departureDate) {
        $request = array(
                "lengthofstay" => "5",
                "pointofsalecountry" => "US",
                "origin" => $origin,
                "destination" => $destination,
                "departuredate" => $departureDate
        );
        return $request;
    }
    public function executeGetCall($path, $request) {
        $result = curl_exec($this->prepareCall('GET', $path, $request));
        return json_decode($result);
    }
    private function buildHeaders() {
        // $token = new TokenHolder::getToken();
        $token = $this->getToken();
        dd($token);
        $headers = array(
            'Authorization: Bearer '.$token->access_token,
            'Accept: */*'
        );
        return $headers;
    }
    private function prepareCall($callType, $path, $request) {
        $domain = 'https://api.test.sabre.com';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $callType);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = $this->buildHeaders();
        switch ($callType) {
        case 'GET':
            $url = $path;
            if ($request != null) {                
                $url = $domain.$path.'?'.http_build_query($request);
                // $url = $this->config->getRestProperty("environment").$path.'?'.http_build_query($request);
            }
           // curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => true));
            curl_setopt($ch, CURLOPT_URL, $url);
            break;
        case 'POST':
            curl_setopt($ch, CURLOPT_URL, $domain.$path);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
            array_push($headers, 'Content-Type: application/json');
            break;
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        return $ch;
    }
    public function getToken() {
        
        if (self::token == null || time() > self::expirationDate) {
            self::token = $this->callForToken();
            // $this->tokeno = time() + TokenHolder::$token->expires_in;
            
        }
        return self::token;
    }
    public function callForToken() {
        $domain = 'https://api.test.sabre.com';
        $ch = curl_init($domain."/v2/auth/token");
        $vars = "grant_type=client_credentials";
        $headers = array(
            'Authorization: Basic '.$this->buildCredentials(),
            'Accept: */*',
            'Content-Type: application/x-www-form-urlencoded'
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }
    
    private function buildCredentials() {
        $credentials = "V1:f2sfnbqa11kavp7w:DEVCENTER:EXT";
        $clientSecret = 'D04GelUg';
        $secret = base64_encode($clientSecret);
        return base64_encode(base64_encode($credentials).":".$secret);
    }
    // ===end====
}
