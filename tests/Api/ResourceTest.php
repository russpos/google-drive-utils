<?php

use PHPUnit\Framework\TestCase;
use Russpos\GoogleDriveUtils\Api;

class DummyResource extends Api\Resource {

    protected static function calculateSchema() {
        self::hasField("my_id", Api\Types::int());
    }

}

class ResourceTest extends TestCase {

    public function setUp() {
        $this->mock_data = [
            "my_id" => "a",
        ];
    }

    public function testThrowsOnInvalidInt() {
        $this->mock_data["my_id"] = "a";
        $this->expectException(InvalidArgumentException::class);
        $this->instance = new DummyResource($this->mock_data);
    }

    public function testNoException() {
        $this->instance = new DummyResource($this->mock_data);
        $this->assertNotEmpty($this->instance);
    }
}
