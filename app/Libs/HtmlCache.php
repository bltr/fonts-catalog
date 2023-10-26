<?php

namespace App\Libs;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class HtmlCache
{
    const CACHE_DIR = 'page-cache/';

    public function put(Request $request, Response $response)
    {
        if ($response->getStatusCode() < 300) {
            $path = $this->path($request->getRequestUri()) . '#' . strtotime($response->headers->get('last-modified'));
            Storage::put($path, $response->getContent());
        }
    }

    /**
     * Вызывается до инициализации Kernel
     */
    public function get(string $host, string $port, string $uri)
    {
        if ($port !== '443' || str_starts_with($host, 'www.')) {
            return;
        }

        $path = $this->path($uri);
        $full_path = '../storage/app/' . $path;
        $full_path = glob($full_path . '*')[0] ?? null;

        if (is_null($full_path)) {
            return;
        }

        $timestamp = (int)explode('#', $full_path)[1];
        header('last-modified: ' . (new \Datetime())->setTimestamp($timestamp)->format("D, d M Y H:i:s \G\M\T"));
        $if_modified_since = $_SERVER['HTTP_IF_MODIFIED_SINCE'] ?? null;

        if (!is_null($if_modified_since) && $timestamp < strtotime($if_modified_since)) {
            header('HTTP/1.1 304 Not Modified');
            exit;
        }

        echo file_get_contents($full_path);
        exit;
    }

    public function remove(string $uri)
    {
        $path = $this->path($uri);
        $full_path = '../storage/app/' . $path;
        $full_path = glob($full_path . '*')[0] ?? null;
        if (!is_null($full_path)) {
            Storage::delete($full_path);
        }
    }

    public function clean()
    {
        Storage::deleteDirectory(self::CACHE_DIR);
    }

    private function path(string $uri): string
    {
        $path_hash = sha1($uri);

        return self::CACHE_DIR . substr($path_hash, 0, 2) . '/' . $path_hash;
    }
}
