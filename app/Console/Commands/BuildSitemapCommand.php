<?php

namespace App\Console\Commands;

use App\Http\Controllers\Front\HomeController;
use App\Libs\Sitemap\IndexBuilder;
use App\Libs\Sitemap\SitemapBuilder;
use App\Models\Category;
use App\Models\Font;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
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
        $this->clear();
        $this->categories($sitemap);
        $this->fonts($sitemap);
        $this->index($index);
    }

    private function clear()
    {
        $font_sitemaps = glob(public_path(substr(self::FONTS_SITEMAP, 0, 15)) . '*');
        foreach ($font_sitemaps as $sitemap) {
            unlink($sitemap);
        }

        $sitemap_index = public_path(self::SITEMAP_INDEX);
        is_file($sitemap_index) && unlink($sitemap_index);

        $sitemap = public_path(self::CATEGORIES_SITEMAP);
        is_file($sitemap) && unlink($sitemap);
    }

    public function categories(SitemapBuilder $sitemap): void
    {
        $sitemap->addUrl(url(''), Carbon::make(HomeController::LAST_MODIFIED)->toW3cString());
        $sitemap->generate(Category::all(), public_path(self::CATEGORIES_SITEMAP));
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
