<?php namespace Russpos\GoogleDriveUtils\Auth;

class Loader {

    private $auth_token;
    private $client_data;
    private $scope;

    private $with_redirect = false;
    private $redirect_params;

    private $token_store = null;
    private $loader;

    const AUTH_URL_BASE = "https://accounts.google.com/o/oauth2/auth?";
    const CLI_REDIRECT_URI = "urn:ietf:wg:oauth:2.0:oob";

    /**
     * __construct
     * Creates a new Auth/Loader
     * @param ClientData $client_data ClientData object of the application you are loading authorization for
     * @param Scope $scope The scope you are attempting to load authorization for
     * @access public
     */
    public function __construct(ClientData $client_data, TokenStorageInterface $token_store, Scope $scope) {
        $this->token_store = $token_store;
        $this->scope = $scope;
        $this->client_data = $client_data;
    }

    /**
     * enableRedirect
     * Sets flag so that we load auth via a redirect mechanism
     * @access public
     * @return void
     */
    public function enableRedirect() {
        $this->with_redirect = true;
    }

    /**
     * getAuthURL
     * Gets the auth URL for the given redirect
     * @access private
     * @return string URL as a string to send user to authorize this application
     */
    private function getAuthURL() : string {
        $payload = [
            "client_id"     => $this->client_data->getClientId(),
            "scope"         => $this->scope->toString(),
        ];

        if ($this->with_redirect) {
            $redirect = $this->client_data->getRedirectUri(1);
            // TODO: Make const
            $payload['response_type'] = "token";
        } else {
            $redirect = $this->client_data->getRedirectUri(0);
            // TODO: Make const
            $payload['response_type'] = "code";
        }

        $payload["redirect_uri"] = (empty($this->redirect_params)) ?
            $redirect : $redirect.'?'.http_build_query($this->redirect_params);
        return $this->client_data->getAuthURI(). '?'. http_build_query($payload);
    }

    public function getTokenWithInterface(UserInterface $ui) : Token {
        try {
            $token = $this->token_store->loadToken();
        } catch (NoTokenStoredException $e) {
            $token = $ui->triggerUserApplicationAuthorizationFromUrl($this->getAuthURL());
            $this->token_store->storeToken($token);
        }
        return $token;
    }

}
