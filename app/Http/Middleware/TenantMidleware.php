<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class TenantMidleware extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        if(Auth::user()){
            $tenant = Tenant::find(Auth::user()->tenant_id);
            tenancy()->initialize($tenant);
        }

        return $next($request);
    }
}
