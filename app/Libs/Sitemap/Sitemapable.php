<?php

namespace App\Libs\Sitemap;

interface Sitemapable
{
    public function path(): string;

    public function updated_at(): string;
}
