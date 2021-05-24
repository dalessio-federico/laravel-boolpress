<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckApiToken
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
        $authToken = $request->header('Authorization');

        if(empty($authToken)) {
            return response()->json([
                'success' => false,
                'error' => "Api token missed"
            ]);
        };

        $apiToken = substr($authToken, 7);
        $user = User::where('api_token' , $apiToken)->first();
        if(!$user) {
            return response()->json([
                'success' => false,
                'error' => "Wrong Api Token"
            ]); 
        };

        return $next($request);
    }
}
