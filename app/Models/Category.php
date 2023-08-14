<?php

namespace App\Models;

use App\Libs\Sitemap\Sitemapable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model implements Sitemapable
{
    use HasFactory;
    use NodeTrait;

    const TREE_CACHE_KEY = 'categories_tree';

    const BREADCRUMB_CACHE_KEY = 'categories_breadcrumbs';

    protected $guarded = [];

    public function fonts()
    {
        return $this->belongsToMany(Font::class);
    }

    public function path(): string
    {
        return route('category', $this);
    }

    public static function getTree(): Collection
    {
        return Cache::rememberForever(
            static::TREE_CACHE_KEY,
            fn () => static::withDepth()
                ->withCount('fonts')
                ->orderBy('fonts_count', 'desc')
                ->get()
                ->toTree()
        );
    }

    public function getBreadcrubms(): Collection
    {
        return Cache::rememberForever(
            static::BREADCRUMB_CACHE_KEY . $this->id,
            fn () => $this->ancestors()
                ->withDepth()
                ->orderBy('depth')
                ->get()
                ->map(fn($category) => ['slug' => $category->slug, 'name' => $category->name])
        );
    }
}
