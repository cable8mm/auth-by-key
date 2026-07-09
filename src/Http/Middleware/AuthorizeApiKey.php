<?php

namespace Cable8mm\AuthByKey\Http\Middleware;

use Cable8mm\AuthByKey\Exceptions\AuthByKeyException;
use Cable8mm\AuthByKey\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class AuthorizeApiKey
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     *
     * @throws AuthByKeyException
     */
    public function handle(Request $request, Closure $next)
    {
        $header = $request->header(config('auth-by-key.header', 'X-Authorization'));

        if (empty($header)) {
            throw new AuthByKeyException('Invalid or inactive API key provided');
        }

        // Rate limiting based on API key
        $key = 'api-key:'.$header;

        if (RateLimiter::tooManyAttempts($key, 60)) { // 60 attempts per minute
            throw new AuthByKeyException('Too many requests. Please try again later.');
        }

        RateLimiter::hit($key, 60); // 60 seconds

        $apiKey = ApiKey::getByKey($header);

        if ($apiKey instanceof ApiKey) {
            return $next($request);
        }

        throw new AuthByKeyException('Invalid or inactive API key provided');
    }
}
