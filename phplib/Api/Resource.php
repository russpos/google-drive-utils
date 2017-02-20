<?php namespace Russpos\GoogleDriveUtils\Api;

abstract class Resource {

    private $data;

    private static $schema;

    abstract protected static function calculateSchema();

    public function __construct(array $raw_data_response) {
        $this->data = $raw_data_response;
        if (empty(static::$schema)) {
            static::calculateSchema();
        }
    }

    protected static function hasField(string $field_name) {
        static::$schema[] = $field_name;
    }

    public function __get($field) {
        if (!in_array($field, static::$schema)) {
            $cls = get_class($this);
            throw new \Exception("Field $field not defined in schema for resource $cls");
        }
        return $this->data[$field];
    }

}


