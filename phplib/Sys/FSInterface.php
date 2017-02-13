<?php namespace Russpos\GoogleDriveUtils\Sys;

interface FSInterface {

    public function file_get_contents(string $path) : string;
    public function file_put_contents(string $path, string $contents);

}
