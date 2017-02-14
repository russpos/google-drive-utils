<?php namespace Russpos\GoogleDriveUtils\Auth;

class ClientData {

    private $raw_data;

    public function __construct($raw_data) {
        $this->raw_data = $raw_data;
    }

    public function print_r($output = false) {
        print_r($this->raw_data, $output);
    }

    public static function fromFile(string $path) {
        $raw_data = json_decode(file_get_contents($path));
        return new self($raw_data);
    }

    public function getClientId() : string {
        return $this->raw_data->installed->client_id;
    }

    public function getAuthURI() : string {
        return $this->raw_data->installed->auth_uri;
    }

    public function getTokenURI() : string {
        return $this->raw_data->installed->token_uri;
    }

    public function getClientSecret() : string {
        return $this->raw_data->installed->client_secret;
    }

    public function getRedirectUri($key = null) : string {
        if (is_null($key)) {
            $key = 0;
        }
        return $this->raw_data->installed->redirect_uris[$key];
    }

}

