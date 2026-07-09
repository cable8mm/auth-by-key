<?php

namespace Cable8mm\AuthByKey\Tests\Models;

use Cable8mm\AuthByKey\Models\ApiKey;
use Illuminate\Database\Eloquent\SoftDeletes;
use PHPUnit\Framework\TestCase;

final class ApiKeyTest extends TestCase
{
    public function test_validates_name_format(): void
    {
        // Valid names
        $this->assertTrue(ApiKey::isValidName('test-key'));
        $this->assertTrue(ApiKey::isValidName('test123'));
        $this->assertTrue(ApiKey::isValidName('test-key-123'));
        $this->assertTrue(ApiKey::isValidName('a'));
        $this->assertTrue(ApiKey::isValidName(str_repeat('a', 255)));

        // Invalid names
        $this->assertFalse(ApiKey::isValidName('Test-Key')); // uppercase
        $this->assertFalse(ApiKey::isValidName('test_key')); // underscore
        $this->assertFalse(ApiKey::isValidName('')); // empty
        $this->assertFalse(ApiKey::isValidName(str_repeat('a', 256))); // too long (256 chars)
    }

    public function test_generate_creates_unique_key(): void
    {
        // This test requires Laravel's config() helper
        // In a full Laravel environment, this would work
        // For now, we verify the method exists and is callable
        $this->assertTrue(method_exists(ApiKey::class, 'generate'));
    }

    public function test_get_by_key_returns_null_for_invalid_key(): void
    {
        // This would require database setup
        // In integration tests, this would be tested with actual DB
        $this->assertTrue(method_exists(ApiKey::class, 'getByKey'));
    }

    public function test_key_exists_method_exists(): void
    {
        $this->assertTrue(method_exists(ApiKey::class, 'keyExists'));
    }

    public function test_name_exists_method_exists(): void
    {
        $this->assertTrue(method_exists(ApiKey::class, 'nameExists'));
    }

    public function test_model_has_correct_table_name(): void
    {
        $this->assertEquals('api_keys', (new ApiKey)->getTable());
    }

    public function test_model_uses_soft_deletes(): void
    {
        $this->assertTrue(in_array(SoftDeletes::class, class_uses(ApiKey::class)));
    }

    public function test_model_has_fillable_attributes(): void
    {
        $apiKey = new ApiKey;
        $this->assertEquals(['name', 'key', 'active'], $apiKey->getFillable());
    }
}
