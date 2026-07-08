<?php

namespace Cable8mm\AuthByKey\Tests\Console\Commands;

use Cable8mm\AuthByKey\Console\Commands\ListApiKeys;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ListApiKeysTest extends TestCase
{
    #[Test]
    public function it_has_correct_description(): void
    {
        $command = new ListApiKeys();
        $this->assertEquals('List all API Keys', $command->getDescription());
    }
}