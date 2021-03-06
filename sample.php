<?php
use Russpos\GoogleDriveUtils\Auth;
use Russpos\GoogleDriveUtils\API;
require "loader.php";

$client_data    = Auth\ClientData::fromFile(__DIR__."/client_id.json");
$file_storage   = new Auth\TokenFileStorage("/Users/russp/.gdrive");
$loader = new Auth\Loader($client_data, $file_storage, Auth\CalendarScope::manage());

$cli = new Auth\Cli();
$token = $loader->getTokenWithInterface($cli);

$calendar_api = new Api\Calendar($token);
$calendar = $calendar_api->getMyPrimaryCalendarList();

echo "Summary: {$calendar->summary}\n";

