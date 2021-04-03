<?php

namespace App\Http\Middleware;

use App\Models\Company;
use Closure;
use Illuminate\Http\Request;

class EnsureTokenIsValid
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
        $company = Company::where("token", $request->header('Token'))->first();
        if(!$company)
        {
            $response = [
                'status' => 2,
                'message' => $request->header('Authorization'),
            ];
            return response()->json($response, 413);
        }
        else
        {
            $request->attributes->add($company->toArray());
            return $next($request);
        }
    }
}
