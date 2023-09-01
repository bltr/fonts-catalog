<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SeoRedirects
{
    public function handle(Request $request, Closure $next)
    {
        $path = ltrim($request->getRequestUri(), '/');

        if (!$request->secure() && app()->isProduction()) {
            return redirect()->secure($path, 301);
        }

        if (strtolower(head(explode('.', $request->getHost()))) === 'www') {
            $host = parse_url(config('app.url'));
            $request->headers->set('host', $host['host'] . ':' . $host['port']);
            return redirect()->to($path, 301);
        }

        return $next($request);
    }
}
