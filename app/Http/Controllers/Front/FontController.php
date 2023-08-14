<?php

namespace App\Http\Controllers\Front;

use Abordage\LastModified\Facades\LastModified;
use App\Http\Controllers\Controller;
use App\Models\Font;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;

class FontController extends Controller
{
    public function __invoke(Font $font)
    {
        LastModified::set($font->updated_at);
        $breadcrumbs = $font->getBreadcrumbs();
        $this->setMeta($font);

        return view('font', compact('font', 'breadcrumbs'));
    }

    private function setMeta(Font $font)
    {
        $canonical_url = route('font', $font);
        $title = "Шрифт {$font->name} онлайн: скачать бесплатно, символы, раскладки";
        $desc = "Вы можете просмотреть и скачать шрифт «{$font->name}».";

        Meta::setTitle($title)
            ->setDescription($desc)
            ->setRobots('index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1')
            ->addMeta('', ['property' => 'article:modified_time', 'content' => $font->updated_at], false)
            ->setCanonical($canonical_url);

        $og = new OpenGraphPackage('font_og');
        $og->setType('article')
            ->setLocale('ru_RU')
            ->setTitle($title)
            ->setDescription($desc)
            ->setUrl($canonical_url)
            ->setSiteName(config('app.name'));
        Meta::registerPackage($og);

        $twc = new TwitterCardPackage('font_twc');
        $twc->setType('summary_large_image')
            ->setSite(config('app.name'))
            ->setTitle($title)
            ->setDescription($desc);
        Meta::registerPackage($twc);
    }
}
