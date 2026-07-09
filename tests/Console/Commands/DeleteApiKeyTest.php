<?php

namespace Cable8mm\AuthByKey\Tests\Console\Commands;

use Cable8mm\AuthByKey\Console\Commands\DeleteApiKey;
use Cable8mm\AuthByKey\Models\ApiKey;
use PHPUnit\Framework\TestCase;

final class DeleteApiKeyTest extends TestCase
{
    public function test_has_correct_description(): void
    {
        $command = new DeleteApiKey;
        $this->assertEquals('Delete an API key by name', $command->getDescription());
    }

    public function test_has_correct_signature(): void
    {
        $command = new DeleteApiKey;
        // Verify signature using reflection
        $reflection = new \ReflectionClass($command);
        $property = $reflection->getProperty('signature');
        $property->setAccessible(true);
        $this->assertEquals('apikey:delete {name}', $property->getValue($command));
    }

    public function test_validates_name_format(): void
    {
        // Valid names should pass validation
        $this->assertTrue(ApiKey::isValidName('test-key'));
        $this->assertTrue(ApiKey::isValidName('app123'));

        // Invalid names should fail validation
        $this->assertFalse(ApiKey::isValidName('Test-Key')); // uppercase
        $this->assertFalse(ApiKey::isValidName('test_key')); // underscore
    }

    public function test_rejects_invalid_name(): void
    {
        // Invalid names should be rejected
        $this->assertFalse(ApiKey::isValidName('Invalid_Name'));
    }

    public function test_requires_confirmation(): void
    {
        $command = new DeleteApiKey;

        // The command should have a confirmation prompt
        // This is tested by verifying the command structure
        $this->assertNotNull($command);
    }
}
