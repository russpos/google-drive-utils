<?php namespace Russpos\GoogleDriveUtils\Api;

use Russpos\GoogleDriveUtils\Auth;
use Russpos\GoogleDriveUtils\Util;

abstract class Api {

    private $token;

    public function __construct(Auth\Token $token) {
        $this->token = $token;
    }

    abstract protected function getUrlBase() : string;

    public function getFullUrlForPath(string $path) : string {
        return $this->getUrlBase() . $path;
    }

    protected function get(string $full_url, array $get_params = []) {
        $get_params["access_token"] = $this->token->getTokenString();
        $request = Util\Request::Get($full_url, $get_params);
        $response = $request->exec();
        return $response->getJSONBody();
    }

}
