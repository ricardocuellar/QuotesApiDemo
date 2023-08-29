<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            if(Auth::user()->role == 1){
                return $next($request);
            }

            return response()->json([
                'status' => false,
                'message' => 'You are not an admin you can not access here.'
            ],401);

        }

        return response()->json([
            'status' => false,
            'message' => 'You are not logged in '
        ],403);

    }
}
