<?php namespace Russpos\GoogleDriveUtils\Api;
phpinfo();
abstract class Resource {

    private $data;

    protected static $schema;

    abstract protected static function calculateSchema();

    public function __construct(array $raw_data_response) {
        $this->data = $raw_data_response;
        if (empty(static::$schema)) {
            static::$schema = [];
            static::calculateSchema();
        }
        $this->validateSchema();
    }

    protected static function hasField(string $field_name, Types $type) {
        static::$schema[$field_name] = $type;
    }

    protected function validateSchema() {
        foreach ($this->data as $field_name => $value) {
            if (isset(self::$schema[$field_name])) {
                $type = self::$schema[$field_name];
                try {
                    $type->validate($value);
                } catch (Error $e) {
                    throw new InvalidArgumentException(
                        sprintf("Schema error: field %s not of type %s (value: %s) for class %s",
                        $field_name,
                        $type->getTypeAsString(),
                        $value,
                        get_class($this)
                    ));
                }
            }
        }
    }

    public function __get($field) {
        if (empty(static::$schema[$field])) {
            $cls = get_class($this);
            throw new \Exception("Field $field not defined in schema for resource $cls");
        }
        return $this->data[$field];
    }

}


