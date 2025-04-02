<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ChekUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next , ...$type): Response
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $user=$request->user(); //Auth::user()
        // if($user->type=='user'){
        if(in_array(!$user->type , $type)){
            abort(403);//مش مسموح الك تكمل
        }
        return $next($request);
    }
}
