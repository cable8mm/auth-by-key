<?php

namespace Cable8mm\AuthByKey\Tests\Console\Commands;

use Cable8mm\AuthByKey\Console\Commands\DeactivateApiKey;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class DeactivateApiKeyTest extends TestCase
{
    #[Test]
    public function it_has_correct_description(): void
    {
        $command = new DeactivateApiKey();
        $this->assertEquals('Deactivate an API key by name', $command->getDescription());
    }
}