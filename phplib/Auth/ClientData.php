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

}

