<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $current_user = User::all()->find(auth()->id());

        if ($current_user->is_banned) {
            abort(403, 'Unauthorized Action, you\'re banned!! Contact your superiors');
        }

        dd($current_user);
        // if()

        return $request->expectsJson() ? null : route('login');
    }
}
