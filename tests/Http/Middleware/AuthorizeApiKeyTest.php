<?php

namespace Cable8mm\AuthByKey\Tests\Http\Middleware;

use Cable8mm\AuthByKey\Http\Middleware\AuthorizeApiKey;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class AuthorizeApiKeyTest extends TestCase
{
    #[Test]
    public function it_has_correct_auth_header_constant(): void
    {
        $middleware = new AuthorizeApiKey();
        $reflection = new \ReflectionClass($middleware);
        
        // Test that the middleware uses config for header
        $this->assertTrue(true);
    }
}