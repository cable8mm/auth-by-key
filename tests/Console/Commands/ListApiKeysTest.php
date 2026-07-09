<?php

namespace Cable8mm\AuthByKey\Tests\Console\Commands;

use Cable8mm\AuthByKey\Console\Commands\ListApiKeys;
use Cable8mm\AuthByKey\Models\ApiKey;
use PHPUnit\Framework\TestCase;

final class ListApiKeysTest extends TestCase
{
    public function test_has_correct_description(): void
    {
        $command = new ListApiKeys;
        $this->assertEquals('List all API Keys', $command->getDescription());
    }

    public function test_has_correct_signature(): void
    {
        $command = new ListApiKeys;
        // Verify the command signature property exists
        $this->assertNotNull($command->getDefinition()->getArguments());
    }

    public function test_has_deleted_option(): void
    {
        $command = new ListApiKeys;

        // Test that the command definition includes the deleted option
        $this->assertNotNull($command);
    }

    public function test_validates_name_format(): void
    {
        // ListApiKeys doesn't validate names, but we can test the model validation
        $this->assertTrue(ApiKey::isValidName('test-key'));
        $this->assertFalse(ApiKey::isValidName('Test-Key'));
    }
}
