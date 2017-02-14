<?php namespace Russpos\GoogleDriveUtils\Auth;

interface TokenStorageInterface {

    public function storeToken(Token $token);
    public function loadToken() : Token;

}
