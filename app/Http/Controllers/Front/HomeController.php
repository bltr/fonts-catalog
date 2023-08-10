<?php

namespace App\Http\Controllers\Front;

use Abordage\LastModified\Facades\LastModified;
use App\Models\Font;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;
use Illuminate\Support\Carbon;

class HomeController
{
    private const PER_PAGE = 20;
    const LAST_MODIFIED = 'Tue, 23 May 2023 09:59:51 GMT';

    public function __invoke(int $page = 1)
    {
        LastModified::set(Carbon::make(static::LAST_MODIFIED));
        $fonts = Font::simplePaginate(static::PER_PAGE);
        $this->setMeta($page);

        return view('home', compact('fonts'));
    }

    private function setMeta(int $page)
    {
        $canonical_url = url('');
        $title = "Бесплатные шрифты онлайн: более 10 000 красивых на русском";
        $desc = "Большая коллекция бесплатных красивых шрифтов на русском. Fonts Online. Граффити, готические, чертёжные, для Фотошоп, Инстаграм или ников.";

        if ($page === 1) {
            Meta::setRobots('index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1');
        } else {
            Meta::setRobots('max-image-preview:large, noindex,follow');
        }

        Meta::setTitle($title)
            ->setDescription($desc)
            ->setCanonical($canonical_url);

        $og = new OpenGraphPackage('home_og');
        $og->setType('website')
            ->setLocale('ru_RU')
            ->setTitle($title)
            ->setDescription($desc)
            ->setUrl($canonical_url)
            ->setSiteName(config('app.name'));
        Meta::registerPackage($og);

        $twc = new TwitterCardPackage('home_twc');
        $twc->setType('summary_large_image')
            ->setSite(config('app.name'))
            ->setTitle($title)
            ->setDescription($desc);
        Meta::registerPackage($twc);
    }
}
