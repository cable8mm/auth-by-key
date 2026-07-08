<?php

namespace Cable8mm\AuthByKey\Events;

use Cable8mm\AuthByKey\Models\ApiKey;

class ApiKeyCreated
{
    public function __construct(public ApiKey $apiKey) {}
}
