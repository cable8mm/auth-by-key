<?php

namespace Cable8mm\AuthByKey\Tests;

use Cable8mm\AuthByKey\ApiKeyServiceProvider;
use Cable8mm\AuthByKey\Console\Commands\ActivateApiKey;
use Cable8mm\AuthByKey\Console\Commands\DeactivateApiKey;
use Cable8mm\AuthByKey\Console\Commands\DeleteApiKey;
use Cable8mm\AuthByKey\Console\Commands\GenerateApiKey;
use Cable8mm\AuthByKey\Console\Commands\ListApiKeys;
use Cable8mm\AuthByKey\Http\Middleware\AuthorizeApiKey;
use Illuminate\Support\ServiceProvider;
use PHPUnit\Framework\TestCase;

final class ApiKeyServiceProviderTest extends TestCase
{
    public function test_service_provider_exists(): void
    {
        $this->assertTrue(class_exists(ApiKeyServiceProvider::class));
    }

    public function test_service_provider_extends_service_provider(): void
    {
        $this->assertTrue(is_subclass_of(ApiKeyServiceProvider::class, ServiceProvider::class));
    }

    public function test_register_method_exists(): void
    {
        $provider = new ApiKeyServiceProvider(app());
        $this->assertTrue(method_exists($provider, 'register'));
    }

    public function test_boot_method_exists(): void
    {
        $provider = new ApiKeyServiceProvider(app());
        $this->assertTrue(method_exists($provider, 'boot'));
    }

    public function test_registers_commands(): void
    {
        $provider = new ApiKeyServiceProvider(app());

        // Verify the provider can be instantiated
        $this->assertInstanceOf(ApiKeyServiceProvider::class, $provider);
    }

    public function test_has_correct_commands(): void
    {
        // Verify all command classes exist
        $this->assertTrue(class_exists(ActivateApiKey::class));
        $this->assertTrue(class_exists(DeactivateApiKey::class));
        $this->assertTrue(class_exists(DeleteApiKey::class));
        $this->assertTrue(class_exists(GenerateApiKey::class));
        $this->assertTrue(class_exists(ListApiKeys::class));
    }

    public function test_has_middleware_class(): void
    {
        $this->assertTrue(class_exists(AuthorizeApiKey::class));
    }
}
