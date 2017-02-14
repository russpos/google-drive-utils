<?php
use Russpos\GoogleDriveUtils\Auth;
require "loader.php";

$client_data    = Auth\ClientData::fromFile(__DIR__."/client_id.json");
$file_storage   = new Auth\TokenFileStorage("/Users/russp/.gdrive");
$command_loader = new Auth\Loader($client_data, $file_storage, Auth\CalendarScope::manage());

$cli = new Auth\Cli();
$token = $command_loader->getTokenWithInterface($cli);
echo "Token!\n"; print_r($token);
