<?php

namespace Cable8mm\AuthByKey\Tests\Exceptions;

use Cable8mm\AuthByKey\Exceptions\AuthByKeyException;
use PHPUnit\Framework\TestCase;

final class AuthByKeyExceptionTest extends TestCase
{
    public function test_can_be_created_with_message(): void
    {
        $exception = new AuthByKeyException('Invalid API key');

        $this->assertInstanceOf(AuthByKeyException::class, $exception);
        $this->assertEquals('Invalid API key', $exception->getMessage());
    }

    public function test_can_be_created_without_message(): void
    {
        $exception = new AuthByKeyException;

        $this->assertInstanceOf(AuthByKeyException::class, $exception);
        $this->assertEquals('', $exception->getMessage());
    }

    public function test_is_instance_of_runtime_exception(): void
    {
        $exception = new AuthByKeyException('Test error');

        $this->assertInstanceOf(\RuntimeException::class, $exception);
    }

    public function test_can_be_thrown(): void
    {
        $this->expectException(AuthByKeyException::class);
        $this->expectExceptionMessage('Unauthorized access');

        throw new AuthByKeyException('Unauthorized access');
    }
}
