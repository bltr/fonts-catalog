<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Font;
use Illuminate\Console\Command;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class WarmUpHtmlCacheCommand extends Command
{
    protected $signature = 'app:warmup-html-cache';

    protected $description = 'Command description';

    public function handle()
    {
        $this->warmup(Category::query());
        $this->warmup(Font::query());
    }

    private function warmup(Builder $query)
    {
        $query->chunk(20, function (Collection $models) {
            $paths = $models->map->path();
            Http::pool(function(Pool $pool) use ($paths) {
                return $paths->map(fn ($path) => $pool->get($path));
            });
        });
    }
}
