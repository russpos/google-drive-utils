<?php namespace Russpos\GoogleDriveUtils\Api\Resource;

use Russpos\GoogleDriveUtils\Api;

class Calendar extends Api\Resource {

    protected static function calculateSchema() {
        static::hasField("summary",     Api\Types::string());
        static::hasField("description", Api\Types::string());
        static::hasField("etag", Api\Types::etag());
        static::hasField("location", Api\Types::string());
        static::hasField("timeZone", Api\Types::string());
        static::hasField("summaryOverride", Api\Types::string());
        static::hasField("colorId", Api\Types::string());
        static::hasField("hidden", Api\Types::bool());
        static::hasField("defaultReminders.method", Api\Types::string());
        static::hasField("defaultReminders.minutes", Api\Types::int());
    }
}
