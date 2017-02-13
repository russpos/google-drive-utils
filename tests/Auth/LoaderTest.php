<?php

use Russpos\GoogleDriveUtils\Auth;
use PHPUnit\Framework\TestCase;

class LoaderTest extends TestCase {

    public function setUp() {
        $this->client_id = uniqid();
        $this->loader = new Auth\Loader($this->client_id, Auth\CalendarScope::readOnly());
    }

    public function testGetAuthUrl() {
        $auth_url = $this->loader->getAuthURL();
        $this->assertRegExp("/accounts.google.com/", $auth_url);
        $this->assertRegExp("/client_id={$this->client_id}/", $auth_url);
    }

    public function testGetAuthUrlWithRedirect() {
        $this->loader->withRedirectUrl('http://www.food.sandwich/', ['help' => 'me']);

        $auth_url = $this->loader->getAuthURL();
        $this->assertRegExp("/accounts.google.com/", $auth_url);
        $this->assertRegExp("/client_id={$this->client_id}/", $auth_url);
        $this->assertRegExp("/www.food.sandwich/", $auth_url);
        $this->assertRegExp("/help%3Dme/", $auth_url);
    }
}
