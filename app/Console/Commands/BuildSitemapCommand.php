<?php

namespace App\Console\Commands;

use App\Libs\Sitemap\IndexBuilder;
use App\Libs\Sitemap\SitemapBuilder;
use App\Models\Category;
use App\Models\Font;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class BuildSitemapCommand extends Command
{
    protected $signature = 'app:sitemap-build';

    protected $description = 'Build sitemap';

    private int $counter = 0;

    const CATEGORIES_SITEMAP = 'wp-sitemap-taxonomies-font_types-1.xml';

    const FONTS_SITEMAP = 'wp-sitemap-posts-font-%d.xml';

    const SITEMAP_INDEX = 'wp-sitemap.xml';

    const CHUNK_SIZE = 52;

    public function handle(SitemapBuilder $sitemap, IndexBuilder $index)
    {
        $this->categories($sitemap);
        $this->fonts($sitemap);
        $this->index($index);
    }

    public function categories(SitemapBuilder $sitemap): void
    {
        $sitemap->generate(Category::all()->prepend(url('/')), public_path(self::CATEGORIES_SITEMAP));
    }

    private function fonts(SitemapBuilder $sitemap)
    {
        Font::chunk(self::CHUNK_SIZE, function ($fonts) use ($sitemap) {
            $this->counter++;
            $sitemap->generate($fonts, public_path(sprintf(self::FONTS_SITEMAP, $this->counter)));
        });
    }

    private function index(IndexBuilder $index)
    {
        $urls = Collection::range(1, $this->counter)
            ->map(function ($i) {
                return url(sprintf(self::FONTS_SITEMAP, $i));
            })
            ->prepend(url(self::CATEGORIES_SITEMAP));

        $index->generate($urls, public_path(self::SITEMAP_INDEX));
    }
}
