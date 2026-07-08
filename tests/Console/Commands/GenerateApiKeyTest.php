<?php

namespace Cable8mm\AuthByKey\Tests\Console\Commands;

use Cable8mm\AuthByKey\Console\Commands\GenerateApiKey;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class GenerateApiKeyTest extends TestCase
{
    #[Test]
    public function it_has_correct_description(): void
    {
        $command = new GenerateApiKey();
        $this->assertEquals('Generate a new API key', $command->getDescription());
    }
}