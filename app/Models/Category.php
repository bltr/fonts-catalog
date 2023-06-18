<?php

namespace App\Models;

use App\Libs\Sitemap\Sitemapable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model implements Sitemapable
{
    use HasFactory;
    use NodeTrait;

    protected $guarded = [];

    public function fonts()
    {
        return $this->belongsToMany(Font::class);
    }

    public function path(): string
    {
        return route('category', $this);
    }
}
