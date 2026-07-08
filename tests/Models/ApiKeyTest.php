<?php

namespace Cable8mm\AuthByKey\Tests\Models;

use Cable8mm\AuthByKey\Models\ApiKey;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ApiKeyTest extends TestCase
{
    #[Test]
    public function it_validates_name_format(): void
    {
        $this->assertTrue(ApiKey::isValidName('test-key'));
        $this->assertTrue(ApiKey::isValidName('test123'));
        $this->assertTrue(ApiKey::isValidName('test-key-123'));
        $this->assertFalse(ApiKey::isValidName('Test-Key')); // uppercase
        $this->assertFalse(ApiKey::isValidName('test_key')); // underscore
        $this->assertFalse(ApiKey::isValidName('')); // empty
    }
}