<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private const PER_PAGE = 20;

    public function __invoke(Category $category)
    {
        $fonts = $category->fonts()->simplePaginate(static::PER_PAGE);
        $breadcrumbs = $category->ancestors()
            ->withDepth()
            ->orderBy('depth')
            ->get()
            ->map(fn ($category) => ['slug' => $category->slug, 'name' => $category->name]);

        return view('category', compact('category', 'fonts', 'breadcrumbs'));
    }
}
