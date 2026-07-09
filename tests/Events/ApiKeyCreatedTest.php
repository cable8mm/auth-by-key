<?php

namespace Cable8mm\AuthByKey\Tests\Events;

use Cable8mm\AuthByKey\Events\ApiKeyCreated;
use Cable8mm\AuthByKey\Models\ApiKey;
use PHPUnit\Framework\TestCase;

final class ApiKeyCreatedTest extends TestCase
{
    public function test_creates_event_with_api_key(): void
    {
        $apiKey = new ApiKey;
        $apiKey->name = 'test-key';
        $apiKey->key = 'test-api-key-123';
        $apiKey->active = true;

        $event = new ApiKeyCreated($apiKey);

        $this->assertInstanceOf(ApiKeyCreated::class, $event);
        $this->assertSame($apiKey, $event->apiKey);
        $this->assertEquals('test-key', $event->apiKey->name);
    }

    public function test_event_has_correct_property(): void
    {
        $apiKey = new ApiKey;
        $apiKey->name = 'my-app';
        $apiKey->key = 'key-123';

        $event = new ApiKeyCreated($apiKey);

        $this->assertInstanceOf(ApiKey::class, $event->apiKey);
        $this->assertEquals('my-app', $event->apiKey->name);
    }
}
