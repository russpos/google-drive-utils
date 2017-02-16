<?php namespace Russpos\GoogleDriveUtils\Auth;

class Token {

    public function __construct($token_data) {
        $this->token_data = $token_data;
    }

    public function getTokenString() : string {
        return $this->token_data["access_token"];
    }

    public function getTokenData() : array {
        return $this->token_data;
    }

}
