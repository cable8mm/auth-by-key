<?php

namespace Cable8mm\AuthByKey\Tests\Console\Commands;

use Cable8mm\AuthByKey\Console\Commands\DeleteApiKey;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class DeleteApiKeyTest extends TestCase
{
    #[Test]
    public function it_has_correct_description(): void
    {
        $command = new DeleteApiKey();
        $this->assertEquals('Delete an API key by name', $command->getDescription());
    }
}