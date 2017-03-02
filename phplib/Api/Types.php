<?php namespace Russpos\GoogleDriveUtils\Api;

class Types {

    const TYPE_STRING = 1;
    const TYPE_ETAG = 2;
    const TYPE_BOOLEAN = 3;
    const TYPE_INTEGER = 4;

    private $type_reference;

    private function __construct(int $type_reference) {
        $this->type_reference = $type_reference;
    }

    public function validate($value) {
        switch ($this->type_reference) {
        case self::TYPE_STRING:
        case self::TYPE_INTEGER:
            return $this->validateInt($value);
        case self::TYPE_BOOLEAN:
        case self::TYPE_ETAG:
        }
    }

    public function getTypeAsString() {
        switch ($this->type_reference) {
        case self::TYPE_STRING:
            return "String";
        case self::TYPE_INTEGER:
            return "Int";
        case self::TYPE_BOOLEAN:
            return "Boolean";
        case self::TYPE_ETAG:
            return "ETag";
        }
    }

    private function validateInt(int $value) {

    }

    public static function string() : Types {
        return new Types(self::TYPE_STRING);
    }
    public static function etag() : Types {
        return new Types(self::TYPE_ETAG);
    }
    public static function bool() : Types {
        return new Types(self::TYPE_BOOLEAN);
    }
    public static function int() : Types {
        return new Types(self::TYPE_INTEGER);
    }


}
