<?php namespace Russpos\GoogleDriveUtils\Auth;

use Russpos\GoogleDriveUtils\Sys;

class CmdLoader { 

    private $path = null;

    public function __construct(string $client_id, string $client_secret, string $path, Scope $scope) {
        $this->path = $path;
        $this->loader = new Loader($client_id, $client_secret, $scope);
    }

    public function loadToken() : Token {
        if (file_exists($this->path)) {
            $token_data_string = file_get_contents($this->path);
            $token_data = json_decode($token_data_string, true);
        } else {
            $auth_url = $this->loader->getAuthURL();
            $output = <<<OUT
In order to register your application, please go to the following URL:

    $auth_url

And enter the token: 
OUT;
            $input = readline($output);
            $token_data = [ "token" => $input ]; 
            file_put_contents($path, json_encode($token_data_string));
        }
        return new Token($token_data);
    }

    private function getPath() {
        if (empty($this->path)) {
            $this->path = $_ENV['HOME'] . '/.glibs_auth_token';
        }
        return $this->path;
    }

}
