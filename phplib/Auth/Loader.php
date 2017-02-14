<?php namespace Russpos\GoogleDriveUtils\Auth;

class Loader {

    private $client_data;
    private $scope;

    private $with_redirect = false;
    private $redirect_params;

    private $token_store = null;
    private $loader;

    const RESPONSE_TYPE_TOKEN = "token";
    const RESPONSE_TYPE_CODE  = "code";

    /**
     * __construct
     * Creates a new Auth/Loader
     * @param ClientData $client_data ClientData object of the application you are loading authorization for
     * @param TokenStorageInterface $token_store Cache where this token should be stored.
     *    Check here first, and also store it here if its not present.
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
            "client_id" => $this->client_data->getClientId(),
            "scope"     => $this->scope->toString(),
        ];

        if ($this->with_redirect) {
            $redirect = $this->client_data->getRedirectUri(1);
            $payload['response_type'] = self::RESPONSE_TYPE_TOKEN;
        } else {
            $redirect = $this->client_data->getRedirectUri(0);
            $payload['response_type'] = self::RESPONSE_TYPE_CODE;
        }

        $payload["redirect_uri"] = (empty($this->redirect_params)) ?
            $redirect : $redirect.'?'.http_build_query($this->redirect_params);
        return $this->client_data->getAuthURI(). '?'. http_build_query($payload);
    }

    /**
     * getTokenWithInterface
     * Returns a Token object, with user authorization happening through the provided interface
     * @param UserInterface $ui The user interface through which the authorization takes place
     * @access public
     * @return Token Token data - either from the cache or fetched from the server
     */
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
