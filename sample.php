<?php

require "loader.php";
require "google-api-data.php";

use Russpos\GoogleDriveUtils\Auth;

print_r($_ENV);

$command_loader = new Auth\CmdLoader(
    $client_id,
    $client_secret,
    '/Users/russp/.google-drive-utils-data',
    Auth\CalendarScope::manage()
);

$token = $command_loader->loadToken();
