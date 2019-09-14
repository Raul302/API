<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;


use Closure;

class UserMiddleware
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
        $id = $request->user()->id;
        // abort_if(! Auth::user()->isAdmin(), 403);
        if ($id != 1) {
            abort(401,'Sin permisos');
            // return response("User can't perform this action.", 401);
                        }
        return $next($request);
        // test succesful

    }
}
