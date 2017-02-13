<?php namespace Russpos\GoogleDriveUtils\Auth;

class Scope {

    private $scope_string = null;

    protected function __construct(string $scope_string) {
        $this->scope_string = $scope_string;
    }

    public function toString() {
        return $this->scope_string;
    }
}
