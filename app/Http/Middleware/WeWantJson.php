<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class WeWantJson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $acceptHeader = $request->header('Accept');
        $contentTypeHeader = $request->header('Content-Type');
        if ($acceptHeader != 'application/json' || $contentTypeHeader != 'application/json') {
            return response()->json(['success' => false, 'message' => 'Content should be json'], 400);
        }
        return $next($request);
    }
}
