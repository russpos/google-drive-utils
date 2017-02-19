<?php
use Russpos\GoogleDriveUtils\Auth;
use Russpos\GoogleDriveUtils\API;
require "loader.php";

$client_data    = Auth\ClientData::fromFile(__DIR__."/client_id.json");
$file_storage   = new Auth\TokenFileStorage("/Users/russp/.gdrive");
$loader = new Auth\Loader($client_data, $file_storage, Auth\CalendarScope::manage());

$cli = new Auth\Cli();
$token = $loader->getTokenWithInterface($cli);

print_r($token);
$token->ensureFresh();
/*
$calendar_api = new Api\Calendar($token);

$calendars = $calendar_api->getCalendars();
print_r($calendars);
 */

