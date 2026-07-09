<?php

namespace Cable8mm\AuthByKey\Tests\Config;

use PHPUnit\Framework\TestCase;

final class AuthByKeyConfigTest extends TestCase
{
    public function test_config_file_exists(): void
    {
        $configPath = __DIR__.'/../../config/auth-by-key.php';
        $this->assertFileExists($configPath);
    }

    public function test_config_returns_array(): void
    {
        $config = require __DIR__.'/../../config/auth-by-key.php';
        $this->assertIsArray($config);
    }

    public function test_config_has_header_key(): void
    {
        $config = require __DIR__.'/../../config/auth-by-key.php';
        $this->assertArrayHasKey('header', $config);
        $this->assertEquals('X-Authorization', $config['header']);
    }

    public function test_config_has_key_length_key(): void
    {
        $config = require __DIR__.'/../../config/auth-by-key.php';
        $this->assertArrayHasKey('key_length', $config);
        $this->assertEquals(64, $config['key_length']);
    }

    public function test_config_header_is_string(): void
    {
        $config = require __DIR__.'/../../config/auth-by-key.php';
        $this->assertIsString($config['header']);
        $this->assertNotEmpty($config['header']);
    }

    public function test_config_key_length_is_integer(): void
    {
        $config = require __DIR__.'/../../config/auth-by-key.php';
        $this->assertIsInt($config['key_length']);
        $this->assertGreaterThan(0, $config['key_length']);
    }
}
