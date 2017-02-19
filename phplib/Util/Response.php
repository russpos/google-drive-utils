<?php namespace Russpos\GoogleDriveUtils\Util;

class Response {

    private $body;
    private $headers;

    public function __construct(string $body, string $headers = "") {
        $this->body = $body;
        $this->headers = $headers;
    }

    public function getJSONBody() : array {
        return json_decode($this->body, true);
    }
}
