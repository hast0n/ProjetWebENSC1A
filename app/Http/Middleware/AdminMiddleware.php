<?php

namespace App\Http\Middleware;

use App\Auth;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $u = $request->user();

        if ($u != null && $u->is_admin == 1) {
//            abort(403, 'Unauthorized action.');
            return $next($request);
        }

        return redirect('home');
    }
}
