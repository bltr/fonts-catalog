<?php

namespace App\Libs\Sitemap;

use Illuminate\Support\Collection;

class SitemapBuilder
{
    public function generate(Collection $items, string $file)
    {
        $content = $this->urlset(
            $this->urls($items)
        );

        file_put_contents($file, $content);
    }

    private function urlset(string $urls): string
    {
        return <<<XML
        <?xml version="1.0" encoding="UTF-8"?>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        $urls
        </urlset>
        XML;
    }

    private function urls(Collection $items): string
    {
        return $items->map(function (Sitemapable|string $item) {
            $url = is_string($item) ? $item : $item->path();
            return $this->url($url);
        })->implode("\n");
    }

    private function url(string $url): string
    {
        return <<<XML
            <url>
                <loc>$url</loc>
            </url>
        XML;
    }
}
