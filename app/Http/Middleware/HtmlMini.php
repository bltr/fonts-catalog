<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use voku\helper\HtmlMin;

class HtmlMini
{
    public function __construct(private HtmlMin $htmlMin) {}

    public function handle(Request $request, Closure $next)
    {
        /** @var Response $response */
        $response =  $next($request);

        $content = $this->htmlMin->doRemoveComments(false)
            ->minify($response->getContent());
        $response->setContent($content);

        return $response;
    }
}
