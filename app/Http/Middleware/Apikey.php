<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserAccess;
use App\Models\UserRequest;

class Apikey
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
        if ($request->has('apikey')) {
            $exist = UserAccess::where('apikey', $request->apikey)->first();
            if ($exist) {
                UserRequest::create([
                    'route' => $request->fullUrl(),
                    'method'=>$request->method(),
                    'data'=>json_encode($request->all()),
                    'users_access_id' => $exist->id
                ]);
                return $next($request);
            }
            return response('Api key unauthorized', 401);
        }
        return response('Unauthorized', 401);
    }
}
