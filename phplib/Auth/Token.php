<?php namespace Russpos\GoogleDriveUtils\Auth;

class Token {

    public function __construct($token_string) {
        $this->token_string = $token_string;
    }

    public function getTokenString() : string {
        return $this->token_string;
    }

}
