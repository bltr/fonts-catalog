<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SeoRedirects
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->secure() && app()->isProduction()) {
            return redirect()->secure($request->getRequestUri(), 301);
        }

        if (strtolower(head(explode('.', $request->getHost()))) === 'www') {
            $host = parse_url(config('app.url'));
            $request->headers->set('host', $host['host'] . ':' . $host['port']);
            return redirect()->to(ltrim($request->getRequestUri(), '/'), 301);
        }

        return $next($request);
    }
}
