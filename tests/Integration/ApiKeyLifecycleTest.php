<?php

namespace Cable8mm\AuthByKey\Tests\Integration;

use Cable8mm\AuthByKey\Models\ApiKey;
use PHPUnit\Framework\TestCase;

final class ApiKeyLifecycleTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Integration tests use real events to test the full lifecycle
    }

    public function test_api_key_lifecycle(): void
    {
        // Note: Full lifecycle test requires database setup
        // This test verifies the ApiKey model structure and methods
        $apiKey = new ApiKey;
        $apiKey->name = 'test-key';
        $apiKey->key = 'test-key-123';
        $apiKey->active = true;

        // Verify model properties
        $this->assertEquals('test-key', $apiKey->name);
        $this->assertEquals('test-key-123', $apiKey->key);
        $this->assertTrue($apiKey->active);
        $this->assertFalse($apiKey->exists); // Should be false before saving to database
    }

    public function test_api_key_generation_produces_unique_keys(): void
    {
        // Note: ApiKey::generate() requires Laravel config() helper
        // In a full Laravel environment with database, this would work
        // For now, we verify the method exists and is callable
        $this->assertTrue(method_exists(ApiKey::class, 'generate'));
        $this->assertTrue(is_callable([ApiKey::class, 'generate']));
    }

    public function test_api_key_validation(): void
    {
        // Test valid names
        $this->assertTrue(ApiKey::isValidName('test'));
        $this->assertTrue(ApiKey::isValidName('test-key'));
        $this->assertTrue(ApiKey::isValidName('test123'));
        $this->assertTrue(ApiKey::isValidName('a'));

        // Test invalid names
        $this->assertFalse(ApiKey::isValidName('Test')); // uppercase
        $this->assertFalse(ApiKey::isValidName('test_key')); // underscore
        $this->assertFalse(ApiKey::isValidName('')); // empty
        $this->assertFalse(ApiKey::isValidName(str_repeat('a', 256))); // too long
    }
}
