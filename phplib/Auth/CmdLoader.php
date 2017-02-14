<?php namespace Russpos\GoogleDriveUtils\Auth;

class CmdLoader { 

    private $path = null;
    private $token_store = null;
    private $loader;

    public function __construct(ClientData $client_data, TokenStorageInterface $token_store, Scope $scope) {
        $this->token_store = $token_store;
        $this->loader = new Loader($client_data, $scope);
    }

    public function loadToken() : Token {
        try {
            $token = $this->token_store->loadToken();
        } catch (NoTokenStoredException $e) {
            $auth_url = $this->loader->getAuthURL();
            $output = <<<OUT
In order to register your application, please go to the following URL:

    $auth_url

And enter the token: 
OUT;
            $input = readline($output);
            $token = new Token($input);
            $this->token_store->storeToken($token);
        }
        return $token;
    }
}
