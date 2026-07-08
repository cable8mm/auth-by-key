<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Authorization Header
    |--------------------------------------------------------------------------
    |
    | This value defines the HTTP header name used to pass the API key.
    | You can customize it if needed for your application.
    |
    */
    'header' => env('AUTH_BY_KEY_HEADER', 'X-Authorization'),

    /*
    |--------------------------------------------------------------------------
    | API Key Length
    |--------------------------------------------------------------------------
    |
    | This value defines the length of generated API keys.
    | Longer keys provide more security but are harder to use.
    |
    */
    'key_length' => env('AUTH_BY_KEY_LENGTH', 64),
];
