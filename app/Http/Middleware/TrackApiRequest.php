<?php

namespace App\Http\Middleware;

use App\Models\Analytic;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackApiRequest
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
        $user = Auth::user();

        Analytic::create(
            [
                'user_id' => $user->id,
                'url' => $request->getUri(),
                'user_agent' => $request->userAgent(),
                'ip' => $request->getClientIp()
            ]
        );
        return $next($request);
    }
}
