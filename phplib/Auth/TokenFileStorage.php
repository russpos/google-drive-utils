<?php namespace Russpos\GoogleDriveUtils\Auth;

class TokenFileStorage implements TokenStorageInterface {

    private $path = false;

    public function __construct(string $path) {
        $this->path = $path;
    }

    public function loadToken() : Token {
        if (file_exists($this->path)) {
            $token_data = file_get_contents($this->path);
            if ($token_data) {
                return new Token($token_data);
            }
        }
        throw new NoTokenStoredException();
    }

    public function storeToken(Token $token) {
        file_put_contents($this->path, $token->getTokenString());
    }
}
