<?php
use Russpos\GoogleDriveUtils\Auth;
require "loader.php";

$client_data = Auth\ClientData::fromFile(__DIR__."/client_id.json");
json_decode(file_get_contents(__DIR__."/client_id.json"));

$client_data->print_r();

$command_loader = new Auth\CmdLoader($client_data);

$token = $command_loader->loadToken();
