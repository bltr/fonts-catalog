<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SeoRedirects
{
    public function handle(Request $request, Closure $next)
    {
        $path = $request->getRequestUri();
        $need_redirection = false;
        $need_secure = false;

        if (!$request->secure() && app()->isProduction()) {
            $need_redirection = $need_secure = true;
        }

        if (strtolower(head(explode('.', $request->getHost()))) === 'www') {
            $need_redirection = true;
            $host = parse_url(config('app.url'));
            $header = $host['host'];
            if (!empty($host['port'])) {
                $header .= ':' . $host['port'];
            }
            $request->headers->set('host', $header);
        }

        if (str_contains($path, '//')) {
            $need_redirection = true;
            $path = preg_replace('@/+@', '/', $path);
        }

        if (str_contains($path, 'index.php')) {
            $need_redirection = true;
            $substr = substr($path, strlen('index.php') + 1);
            $path = $substr ?: '/';
        }

        if ($path === '/') {
            $path = config('app.url') . '/';
        }

        if ($need_redirection && !$need_secure) {
            return redirect()->to($path, 301);
        } elseif($need_secure) {
            return redirect()->secure($path, 301);
        }


        return $next($request);
    }
}
