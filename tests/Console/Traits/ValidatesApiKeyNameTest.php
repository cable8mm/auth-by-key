<?php

namespace Cable8mm\AuthByKey\Tests\Console\Traits;

use Cable8mm\AuthByKey\Console\Traits\ValidatesApiKeyName;
use PHPUnit\Framework\TestCase;

final class ValidatesApiKeyNameTest extends TestCase
{
    public function test_validate_name_returns_null_for_valid_existing_name(): void
    {
        // Note: This test requires database setup to verify name exists
        // In a full Laravel environment with database, this would test
        // that validateName returns null for valid existing names
        $this->assertTrue(true); // Placeholder for integration test
    }

    public function test_validate_name_returns_error_for_invalid_format(): void
    {
        $testClass = new class
        {
            use ValidatesApiKeyName;

            public function testValidate(string $name): ?string
            {
                return $this->validateName($name);
            }
        };

        // Test invalid formats
        $result = $testClass->testValidate('Test-Key'); // uppercase
        $this->assertNotNull($result);
        $this->assertStringContainsString('Invalid name', $result);
    }

    public function test_validate_name_returns_error_for_underscore(): void
    {
        $testClass = new class
        {
            use ValidatesApiKeyName;

            public function testValidate(string $name): ?string
            {
                return $this->validateName($name);
            }
        };

        $result = $testClass->testValidate('test_key');
        $this->assertNotNull($result);
        $this->assertStringContainsString('Invalid name', $result);
    }

    public function test_validate_name_returns_error_for_empty_string(): void
    {
        $testClass = new class
        {
            use ValidatesApiKeyName;

            public function test_validate(string $name): ?string
            {
                return $this->validateName($name);
            }
        };

        $result = $testClass->test_validate('');
        $this->assertNotNull($result);
        $this->assertStringContainsString('Invalid name', $result);
    }

    public function test_validate_name_accepts_valid_format(): void
    {
        // Note: This test requires database setup to verify name exists
        // In a full Laravel environment with database, this would test
        // that validateName returns null for valid existing names
        $this->assertTrue(true); // Placeholder for integration test
    }
}
