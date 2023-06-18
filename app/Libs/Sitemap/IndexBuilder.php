<?php

namespace App\Libs\Sitemap;

use Illuminate\Support\Collection;

class IndexBuilder
{
    public function generate(Collection $urls, string $file)
    {
        $content = $this->sitemapindex(
            $this->sitemaps($urls)
        );

        file_put_contents($file, $content);
    }

    private function sitemapindex(string $sitemaps): string
    {
        return <<<XML
        <?xml version="1.0" encoding="UTF-8"?>
        <sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        $sitemaps
        </sitemapindex>
        XML;
    }

    private function sitemaps(Collection $urls): string
    {
        return $urls->map(function ($url) {
            return $this->sitemap($url);
        })->implode("\n");
    }

    private function sitemap(string $url): string
    {
        return <<<XML
            <sitemap>
                <loc>$url</loc>
            </sitemap>
        XML;
    }
}
