<?php

namespace Cable8mm\AuthByKey\Events;

use Cable8mm\AuthByKey\Models\ApiKey;

class ApiKeyActivated
{
    public function __construct(public ApiKey $apiKey) {}
}
