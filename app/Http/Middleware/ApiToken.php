<?php
 
namespace App\Http\Middleware;
 
use Closure;
 
class ApiToken
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
 
        if ($request->expectsJson()) {
 
            if ($request->header('token') != 'a6b042ae282d91ab2c25bc7ae515af68') {
                return response('Token Wrong!.', 401);
            }else{
                return $next($request);
            }
 
        } else {
            return response('Unauthorized.', 401);
        }
 
        
    }
}