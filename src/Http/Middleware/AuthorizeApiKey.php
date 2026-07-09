<?php

namespace Cable8mm\AuthByKey\Http\Middleware;

use Cable8mm\AuthByKey\Exceptions\AuthByKeyException;
use Cable8mm\AuthByKey\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;

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

        $apiKey = ApiKey::getByKey($header);

        if ($apiKey instanceof ApiKey) {
            return $next($request);
        }

        throw new AuthByKeyException('Invalid or inactive API key provided');
    }
}
