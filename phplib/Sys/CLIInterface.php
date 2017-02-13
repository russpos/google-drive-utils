<?php namespace Russpos\GoogleDriveUtils\Sys;

interface CLIInterface {

    public function readline(string $output) : string;
    public function echo(string $output);
    public function println(string $output);
}
