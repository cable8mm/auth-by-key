<?php

namespace Cable8mm\AuthByKey\Events;

use Cable8mm\AuthByKey\Models\ApiKey;

class ApiKeyDeleted
{
    public function __construct(public ApiKey $apiKey) {}
}
