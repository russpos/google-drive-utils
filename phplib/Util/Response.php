<?php namespace Russpos\GoogleDriveUtils\Util;

class Response {

    private $body;
    private $headers;

    public function __construct(string $body, string $headers = "") {
        $this->body = $body;
        $this->headers = $headers;
    }

    public function getJSONBody() : array {
        $returned = json_decode($this->body, true);

        if (empty($returned)) {
            echo " COULD NOT PARSE RESPONSE: \n\n{$this->body}\n\n\n";
        }
        return $returned;
    }
}
