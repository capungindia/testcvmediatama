<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        $routeName = $request->route()->getName();

        if(auth()->user()->role == 'customer'){
            $adminOnlyRoutesName = [
                'users.index',
                'users.show',
                'users.create',
                'users.store',
                'users.edit',
                'users.update',
                'users.destroy',
                'videos.create',
                'videos.store',
                'videos.edit',
                'videos.update',
                'videos.destroy',
                'videoRequests.edit',
                'videoRequests.update',
            ];

            if(array_search($routeName, $adminOnlyRoutesName) !== false){
                abort(403, 'You are not allowed! <a href="'.route('home').'">Back to Dashboard</a>');
            }
        } else {
            if(strpos($routeName, 'notifications') !== false)
                abort(404);
        }

        return $next($request);
    }
}
