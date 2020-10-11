<?php

namespace App\Http\Middleware;

use Closure;

class CheckType
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
        $types = $this->getRequiredRoleForRoute($request->route());
        $user = $request->user();
        // dd($request->user(),$types,$request->user()->role->name);

        if ($user->hasRole($types)) {
            if (($user->role->name) == "vendor") {
                if ($user->status() < 2) {
                    if ($request->is('vendor/step-1')) {
                        return $next($request);
                    } elseif ($request->is('vendor/step-2')) {
                        return $next($request);
                    } elseif ($request->is('vendor/step-3')) {
                        return $next($request);
                    } else {
                        return redirect()->route('vendor.step-1');
                    }
                    // dd(Route::current()->getName());
                } else {
                    return $next($request);
                }
            } else {
                return $next($request);
            }
        }

        if (($user->role->name) == "user") {
            return redirect()->route('user.profile');
        }


        if (($user->role->name) == "vendor") {

            return redirect()->route('vendor.dashboard');
        }

        if (($user->role->name) == "Deliver") {

            return redirect()->route('deliver.dashboard');
        }

        return $next($request);
    }

    protected function getRequiredRoleForRoute($route)
    {
        $actions = $route->getAction();
        return isset($actions['type']) ? $actions['type'] : null;
    }
}
