<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

if ($_SERVER['SERVER_PORT'] === '443' && !str_starts_with($_SERVER['HTTP_HOST'], 'www.')) {
    $path_hash = sha1($_SERVER['REQUEST_URI']);
    $path = 'page-cache/' . substr($path_hash, 0, 2) . '/' . $path_hash;
    $full_path = '../storage/app/' . $path;
    $full_path = glob($full_path . '*')[0] ?? null;
    if (!is_null($full_path)) {
        $timestamp = (int)explode('#', $full_path)[1];
        header('last-modified: ' . (new Datetime())->setTimestamp($timestamp)->format("D, d M Y H:i:s \G\M\T"));
        $if_modified_since = $_SERVER['HTTP_IF_MODIFIED_SINCE'] ?? null;

        if (!is_null($if_modified_since) && $timestamp < strtotime($if_modified_since)) {
            header('HTTP/1.1 304 Not Modified');
        } else {
            echo file_get_contents($full_path);
        }
        exit;
    }
}

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/** @var Kernel $kernel */
$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);

if ($response->getStatusCode() < 300) {
    $path .= '#' . strtotime($response->headers->get('last-modified'));
    \Illuminate\Support\Facades\Storage::put($path, $response->getContent());
}
