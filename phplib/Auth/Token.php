<?php namespace Russpos\GoogleDriveUtils\Auth;

use Russpos\GoogleDriveUtils\Util;

class Token {

    const TOKEN_INFO_URL = "https://www.googleapis.com/oauth2/v1/tokeninfo";

    public function __construct($token_data) {
        $this->token_data = $token_data;
    }

    public function getTokenString() : string {
        return $this->token_data["access_token"];
    }

    public function getTokenData() : array {
        return $this->token_data;
    }

    public function ensureFresh() : bool {
        if (!$this->check()) {
            return $this->refresh();
        }
        return true;
    }

    public function check() : bool {
        $request = Util\Request::post(self::TOKEN_INFO_URL, [
            "access_token" => $this->getTokenString()
        ]);
        $response = $request->exec();
        $body = $response->getJSONBody();

        if (!empty($body['error'])) {
            return false;
        }
        if (!empty($body['expires_in']) && $body['expires_in'] > 0) {
            return true;
        }
        // TODO : Log -- we should never be here.
        return false;
    }

}
