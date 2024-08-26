<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $type): Response
    {
        if (!auth()->check() || auth()->user()->user_type != $this->getUserTypeId($type)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $next($request);
    }

    private function getUserTypeId($type)
    {
        $types = [
            'store' => 1,
            'client' => 2,
            'admin' => 3,
        ];

        return $types[$type] ?? null;
    }
}
