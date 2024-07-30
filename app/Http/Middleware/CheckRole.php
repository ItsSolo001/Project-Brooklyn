<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Debugging: Check if $user is an instance of the User model and if hasAnyRole method exists
        if (!($user instanceof \App\Models\User)) {
            abort(500, 'User is not an instance of App\Models\User');
        }

        if (!method_exists($user, 'hasAnyRole')) {
            abort(500, 'Method hasAnyRole does not exist on user model');
        }

        if (!$user->hasAnyRole($roles)) {
            return redirect('/');
        }

        return $next($request);
    }
}