<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Block extends Model
{
    use HasFactory;

    const ALL_CACHE_KEY = 'block_all_cache_key';

    protected $guarded = [];

    protected static function booted()
    {
        static::deleted(fn ($model) => Cache::forget(static::ALL_CACHE_KEY));
        static::created(fn ($model) => Cache::forget(static::ALL_CACHE_KEY));
        static::updated(fn ($model) => Cache::forget(static::ALL_CACHE_KEY));
    }

    public static function allCached()
    {
        return Cache::rememberForever(
            static::ALL_CACHE_KEY,
            fn () => self::all()->keyBy->name
        );
    }
}
