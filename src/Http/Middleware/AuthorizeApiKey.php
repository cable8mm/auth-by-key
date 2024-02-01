<?php

namespace Cable8mm\AuthByKey\Http\Middleware;

use Cable8mm\AuthByKey\Exceptions\AuthByKeyException;
use Cable8mm\AuthByKey\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;

class AuthorizeApiKey
{
    const AUTH_HEADER = 'X-Authorization';

    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $header = $request->header(self::AUTH_HEADER);
        $apiKey = ApiKey::getByKey($header);

        if ($apiKey instanceof ApiKey) {
            return $next($request);
        }

        throw new AuthByKeyException('Invalid ApiKey instance from request in middleware');
    }
}
