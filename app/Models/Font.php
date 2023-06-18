<?php

namespace App\Models;

use App\Libs\Sitemap\Sitemapable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Font extends Model implements Sitemapable
{
    use HasFactory;

    public const FONTS_DIR = 'fonts';

    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getZipFileUrlAttribute()
    {
        return Storage::disk('public')->url(static::FONTS_DIR . '/' . $this->attributes['zip_file']);
    }

    public function getTtfFileUrlAttribute()
    {
        return Storage::disk('public')->url(static::FONTS_DIR . '/' . $this->attributes['ttf_file']);
    }

    public function path(): string
    {
        return route('font', $this);
    }
}
