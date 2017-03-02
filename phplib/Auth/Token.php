<?php namespace Russpos\GoogleDriveUtils\Auth;

use Russpos\GoogleDriveUtils\Util;

class Token {

    const TOKEN_INFO_URL = "https://www.googleapis.com/oauth2/v1/tokeninfo";

    private $token_data;
    private $loader;

    public function __construct(Loader $loader, array $token_data) {
        $this->loader = $loader;
        $this->token_data = $token_data;
    }

    public function replaceDataWithToken(Token $other_token) {
        $this->token_data = $other_token->getTokenData();
    }

    public function getTokenString() : string {
        return $this->token_data["access_token"];
    }

    public function getRefreshToken() : string {
        return (!empty($this->token_data["refresh_token"])) ? $this->token_data["refresh_token"] : "";
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

    private function refresh() {
        $replacement_token = $this->loader->refreshToken($this);
        $this->replaceDataWithToken($replacement_token);
        return self::validateBody($this->getTokenData());
    }

    public function check() : bool {
        $request = Util\Request::post(self::TOKEN_INFO_URL, [
            "access_token" => $this->getTokenString()
        ]);
        $response = $request->exec();
        $body = $response->getJSONBody();
        return self::validateBody($body);
    }

    private static function validateBody(array $body) : bool {
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
