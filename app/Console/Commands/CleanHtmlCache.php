<?php

namespace App\Console\Commands;

use App\Libs\HtmlCache;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CleanHtmlCache extends Command
{
    protected $signature = 'app:html-clean';

    protected $description = 'Command description';

    public function handle(HtmlCache $htmlCache)
    {
        $htmlCache->clean();
    }
}
