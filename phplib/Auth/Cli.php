<?php namespace Russpos\GoogleDriveUtils\Auth;

class Cli implements UserInterface {

    public function triggerUserApplicationAuthorizationFromUrl(string $auth_url) : Token {
        $output = <<<OUT
In order to register your application, please go to the following URL:

$auth_url

And enter the token: 
OUT;
        $input = readline($output);
        return new Token($input);
    }
}
