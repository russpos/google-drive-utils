<?php namespace Russpos\GoogleDriveUtils\Auth;

class Cli implements UserInterface {

    public function triggerUserApplicationAuthorizationFromUrl(string $auth_url) : AccessCode {
        $output = <<<OUT
In order to register your application, please go to the following URL:

$auth_url

And enter the access code:
OUT;
        $input = readline($output);
        //$input = "4/_N56uYEFsXt7z8o3PFzCPcRsq8D_r0gZeSfkLVorHxM";

        return new AccessCode($input);
    }
}
