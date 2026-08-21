<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class XssSanitization
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $input = $request->all();
        array_walk_recursive($input, function (&$item, $key) {
            // Do not sanitize password fields
            if (str_contains(strtolower($key), 'password')) {
                return;
            }

            if (is_string($item)) {
                $item = strip_tags($item);
            }
        });
        $request->merge($input);

        return $next($request);
    }
}
