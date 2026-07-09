<?php

namespace Cable8mm\AuthByKey\Tests\Console\Commands;

use Cable8mm\AuthByKey\Console\Commands\ActivateApiKey;
use PHPUnit\Framework\TestCase;

final class ActivateApiKeyTest extends TestCase
{
    public function test_has_correct_description(): void
    {
        $command = new ActivateApiKey();
        $this->assertEquals('Activate an API key by name', $command->getDescription());
    }
}
