<?php namespace Russpos\GoogleDriveUtils\Auth;

class TokenFileStorage implements TokenStorageInterface {

    private $path = false;

    public function __construct(string $path) {
        $this->path = $path;
    }

    public function loadToken(Loader $loader) : Token {
        if (file_exists($this->path)) {
            $token_data_as_string = file_get_contents($this->path);
            if ($token_data_as_string) {
                $token_data = json_decode($token_data_as_string, true);
                if (isset($token_data['access_token'])) {
                    return new Token($loader, $token_data);
                }
            }
        }
        throw new NoTokenStoredException();
    }

    public function storeToken(Token $token) {
        file_put_contents($this->path, json_encode($token->getTokenData()));
    }
}
