<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\LoginController;
use Redirect;

use Session;
use App\HrmEmployee;
use App\AccLink;
use App\AccRole;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (!LoginController::checkAccess()) {
            return Redirect::route('welcome')
                    ->with('error', '<span class="font-weight-bold">Access denied!</span><br />Please log in to gain access.');
        }
        
        if (count($roles) > 0) {
            $all_roles = LoginController::getAllRoles();
            
            $allowed = false;
            foreach ($roles as $role) {
                $r = AccRole::where('title', $role)->where('active', true);
                if ($r->count() > 0) {
                    $role_id = $r->first()->id;
                    if (in_array($role_id, $all_roles)) {
                        $allowed = true;
                        break;
                    }
                }
            }
            
            if ($allowed == false) {
                return Redirect::back()
                        ->with('error', '<span class="font-weight-bold">Access denied!</span><br />You are not authorized to perform action or visit page.');
            }
        }
        
        return $next($request);
    }
}
