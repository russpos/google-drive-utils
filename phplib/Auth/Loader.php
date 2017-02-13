<?php namespace Russpos\GoogleDriveUtils\Auth;

class Loader {

    private $auth_token;
    private $client_id;
    private $client_secret;
    private $scope;

    private $redirect_uri;
    private $redirect_params;

    const AUTH_URL_BASE = "https://accounts.google.com/o/oauth2/auth?";
    const CLI_REDIRECT_URI = "urn:ietf:wg:oauth:2.0:oob";

    /**
     * __construct
     * Creates a new Auth/Loader
     * @param string $client_id Client ID of the application you are loading authorization for
     * @param string $client_secret Client secret of the application you are loading authorization for
     * @param Scope $scope The scope you are attempting to load authorization for
     * @access public
     */
    public function __construct(string $client_id, string $client_secret, Scope $scope) {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->scope = $scope;
    }

    /**
     * withRedirectUrl
     * Sets the redirect URL of the authorization.
     * @param string $redirect_uri URL that should be redirected to after a successful authorization
     * @param array $redirect_params Additional HTTP params for the redirect URL
     * @access public
     * @return void
     */
    public function withRedirectUrl(string $redirect_uri, array $params = []) {
        $this->redirect_uri = $redirect_uri;
        $this->redirect_params = $params;
    }

    /**
     * getAuthURL
     * Gets the auth URL for the given redirect
     * @access public
     * @return string URL as a string to send user to authorize this application
     */
    public function getAuthURL() : string {
        $payload = [
            "client_id"     => $this->client_id,
            "scope"         => $this->scope->toString(),
        ];

        if ($this->redirect_uri) {
            $redirect = $this->redirect_uri;
            // TODO: Make const
            $payload['response_type'] = "token";
        } else {
            $redirect = self::CLI_REDIRECT_URI;
            // TODO: Make const
            $payload['response_type'] = "code";
        }

        $payload["redirect_uri"] = (empty($this->redirect_params)) ?
            $redirect : $redirect.'?'.http_build_query($this->redirect_params);
        return self::AUTH_URL_BASE.http_build_query($payload);
    }

    /**
     * getAuthToken
     * Returns the currently loaded authorized Token
     * @access public
     * @return Token
     */
    public function getAuthToken() : Token {
        if (empty($this->auth_token)) {
            throw new Auth_Exception(Auth_Exception::ERROR_NO_TOKEN_LOADED);
        }
        return $this->auth_token;
    }

}
