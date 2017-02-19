<?php namespace Russpos\GoogleDriveUtils\Util;

class Request {

    private $response_body;
    private $response_headers;

    private $handle;

    private function __construct($handle) {
        $this->handle = $handle;
    }

    public function exec() : Response {
        $raw_response = curl_exec($this->handle);
        return new Response($raw_response);
    }

    public static function post($url, $payload_data = []) : Request {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST,           1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,     http_build_query($payload_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER,     ["Content-type: application/x-www-form-urlencoded"]);
        return new Request($ch);
    }

}
