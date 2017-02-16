<?php namespace Russpos\GoogleDriveUtils\Api;

use Russpos\GoogleDriveUtils\Auth;

class Calendar extends Api {

    protected function getUrlBase() : string {
        return "https://www.googleapis.com/calendar/v3";
    }

    public function getCalendars() {
        return $this->get($this->getFullUrlForPath("/calendars"));
    }

}
