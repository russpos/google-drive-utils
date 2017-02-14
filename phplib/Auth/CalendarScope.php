<?php namespace Russpos\GoogleDriveUtils\Auth;

class CalendarScope extends Scope {

    const MANAGE    = "https://www.googleapis.com/auth/calendar";
    const READ_ONLY = "https://www.googleapis.com/auth/calendar.readonly";

    public static function manage() {
        return new self(self::MANAGE);
    }

    public static function readOnly() {
        return new self(self::READ_ONLY);
    }

}
