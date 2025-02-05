<?php

namespace App\Http\Controllers\Front;

use Abordage\LastModified\Facades\LastModified;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private const PER_PAGE = 8;

    public function __invoke(Category $category, $page = 1)
    {
        LastModified::set($category->updated_at);
        $fonts = $category->fonts()->simplePaginate(static::PER_PAGE);
        $breadcrumbs = $category->getBreadcrubms();
        $this->setMeta($category, $page);

        return view('category', compact('category', 'fonts', 'breadcrumbs'));
    }

    private function setMeta(Category $category, int $page)
    {
        $canonical_url = route('category', $category);
        $title = "Категория шрифтов «{$category->name}» онлайн: скачать бесплатно";
        $desc = "Описание и просмотр шрифтов категории «{$category->name}».";

        if ($page === 1) {
            Meta::setRobots('index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1');
        } else {
            Meta::setRobots('max-image-preview:large, noindex,follow');
        }

        Meta::setTitle($title)
            ->setDescription($desc)
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
