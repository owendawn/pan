<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Illuminate\Support\Facades\Config;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
//        "/api/init!"
    ];

    public function handle($request, Closure $next)
    {
        if($request->method()=="POST"){
//            return $next($request);
            return parent::addCookieToResponse($request, $next($request));
        }
        for ($i = 0; $i < count($this->except); $i++) {
            $it=Config::get("app.base_url").$this->except[$i];
            if (substr($request->getRequestUri(), 0, strlen($it))==$it) {
                return $next($request);
            }
        }
        return parent::handle($request, $next);
    }
}
