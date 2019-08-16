<?php

namespace App\Http\Middleware;

use Closure;

class IsSupporter
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user('api');
        if ($user->is_supporter === false) {
            return response()->json([
                'success' => false,
                'message' => "you don't have permission to make this action"
            ]);
        }

        return $next($request);
    }
}
