<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$levels): Response
    {
        $user = $request->user();

        if (!$user || !in_array($user->level, $levels)) {
            return abort(403, 'anda tidak dapat mengakses halaman ini');
        }

        return $next($request);
    }
}
