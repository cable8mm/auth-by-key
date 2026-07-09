<?php

namespace Cable8mm\AuthByKey\Tests\Console\Commands;

use Cable8mm\AuthByKey\Console\Commands\GenerateApiKey;
use PHPUnit\Framework\TestCase;

final class GenerateApiKeyTest extends TestCase
{
    public function test_has_correct_description(): void
    {
        $command = new GenerateApiKey();
        $this->assertEquals('Generate a new API key', $command->getDescription());
    }
}
