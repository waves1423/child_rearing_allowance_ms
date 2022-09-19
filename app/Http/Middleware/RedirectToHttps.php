<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectToHttps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$this->isSsl() && config('app.env') === 'production') {
            return redirect('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        }
        return $next($request);
    }

    public function isSsl()
    {
        if (isset($_SERVER['HTTPS']) === true) {
            return ($_SERVER['HTTPS'] === 'on' or $_SERVER['HTTPS'] === '1');
        }
        elseif (isset($_SERVER['SSL']) === true) {
            return ($_SERVER['SSL'] === 'on');
        }
        elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) === true) {
            return (strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https');
        }
        elseif (isset($_SERVER['HTTP_X_FORWARDED_PORT']) === true) {
            return ($_SERVER['HTTP_X_FORWARDED_PORT'] === '443');
        }
        elseif (isset($_SERVER['SERVER_PORT']) === true) {
            return ($_SERVER['SERVER_PORT'] === '443');
        }

        return false;
    }
}
