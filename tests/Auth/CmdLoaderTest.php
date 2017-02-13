<?php

use PHPUnit\Framework\TestCase;
use Russpos\GoogleDriveUtils\Auth;
use Russpos\GoogleDriveUtils\Sys;

class MockHandler implements Sys\CLIInterface, Sys\FSInterface {

    public $returns = [];
    public $outputs = [];

    public function readline(string $output) : string {
        $this->outputs[] = $output;
        return array_pop($this->returns); 
    }

    public function echo(string $output) {
        $this->outputs[] = $output;
    }

    public function println(string $output) {
        $this->outputs[] = $output;
    }

    public function file_get_contents(string $path) : string {
        return array_pop($this->returns);
    }

    public function file_put_contents(string $path, string $contents) {
        return true;
    }

}

class CmdLoaderTest extends TestCase {

    public function setUp() {
        $this->token = uniqid();
        $this->cli = new MockHandler();
        $this->fs  = new MockHandler();
        $this->cmd = new Auth\CmdLoader($this->cli, $this->fs);
    }

    public function testLoadToken() {
        $this->fs->outputs[] = json_encode([ "token" => $this->token ]);
        $token = $this->cmd->loadToken();

    }
}
