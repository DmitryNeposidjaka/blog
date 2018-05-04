<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 04.05.18
 * Time: 13:05
 */

namespace App\Http\Middleware;

use Closure;

class ClientMiddleware
{

    public function handle($request, Closure $next)
    {


        return $next($request);
    }
}