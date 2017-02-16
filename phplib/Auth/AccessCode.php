<?php namespace Russpos\GoogleDriveUtils\Auth;

class AccessCode {

    private $code_as_string;

    public function __construct(string $code) {
        $this->code_as_string = $code;
    }

    public function toString() : string {
        return $this->code_as_string;
    }
}
