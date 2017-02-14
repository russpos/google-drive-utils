<?php namespace Russpos\GoogleDriveUtils\Auth;

interface UserInterface {
    public function triggerUserApplicationAuthorizationFromUrl(string $auth_url) : Token;
}
