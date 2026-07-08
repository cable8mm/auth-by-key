<?php

namespace Cable8mm\AuthByKey\Console\Traits;

use Cable8mm\AuthByKey\Models\ApiKey;

trait ValidatesApiKeyName
{
    /**
     * Validate API key name
     */
    protected function validateName(string $name): ?string
    {
        if (! ApiKey::isValidName($name)) {
            return 'Invalid name. Must be a lowercase alphabetic characters, numbers and hyphens less than 255 characters long.';
        }

        if (! ApiKey::nameExists($name)) {
            return 'Name does not exist.';
        }

        return null;
    }
}
