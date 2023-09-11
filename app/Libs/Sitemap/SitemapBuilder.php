<?php

namespace App\Libs\Sitemap;

use Illuminate\Support\Collection;

class SitemapBuilder
{
    private array $urls = [];

    public function addUrl(string $url, string $last_mod)
    {
        $this->urls[] = compact('url', 'last_mod');
    }

    public function generate(Collection $items, string $file)
    {
        $content = $this->urlset(
            $this->urls($items) . "\n" . $this->additionalUrls()
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
        return $items->map(function (Sitemapable $item) {
            return $this->url($item->path(), $item->updated_at);
        })->implode("\n");
    }

    private function additionalUrls(): string
    {
        return collect($this->urls)->map(function ($item) {
            return $this->url($item['url'], $item['last_mod']);
        })->implode("\n");
    }

    private function url(string $url, string $last_mod): string
    {
        return <<<XML
            <url>
                <loc>$url</loc>
                <lastmod>$last_mod</lastmod>
            </url>
        XML;
    }
}
