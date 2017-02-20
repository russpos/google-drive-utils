<?php namespace Russpos\GoogleDriveUtils\Api;

use Russpos\GoogleDriveUtils\Auth;

class Calendar extends Api {

    protected function getUrlBase() : string {
        return "https://www.googleapis.com/calendar/v3";
    }

    public function getMyCalendarList($id = "") {
        return $this->get($this->getFullUrlForPath("/users/me/calendarList/{$id}"));
    }

    public function getMyPrimaryCalendarList() {
        return new Resource\Calendar($this->getMyCalendarList("primary"));
    }

}
