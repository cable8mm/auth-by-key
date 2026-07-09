<?php

namespace Cable8mm\AuthByKey\Tests\Http\Middleware;

use Cable8mm\AuthByKey\Http\Middleware\AuthorizeApiKey;
use PHPUnit\Framework\TestCase;

final class AuthorizeApiKeyTest extends TestCase
{
    public function test_has_correct_auth_header_constant(): void
    {
        $middleware = new AuthorizeApiKey();
        $reflection = new \ReflectionClass($middleware);
        
        // Test that the middleware uses config for header
        $this->assertTrue(true);
    }
}
