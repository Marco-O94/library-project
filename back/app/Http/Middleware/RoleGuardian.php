<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class RoleGuardian
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // 🛡️🛡️ Check if the user has the specified role in parameter 🛡️🛡️
        if($request->user()->role->name == $role) {
            return $next($request);
        }else{
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
    }
}
