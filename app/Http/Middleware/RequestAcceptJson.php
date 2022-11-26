<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequestAcceptJson
{
    public function handle(Request $request, Closure $next)
    {
        $acceptHeader = strtolower($request->headers->get('accept'));

        if($acceptHeader !== 'application/json')
        {
            $request->headers->set('Accept', 'application/json');
        }

        return $next($request);
    }
}
