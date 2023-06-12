<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Font;
use Illuminate\Http\Request;

class FontController extends Controller
{
    public function __invoke(Font $font)
    {
        $breadcrumbs = $font->categories()
            ->orderBy('depth')
            ->withDepth()
            ->get()
            ->map(fn ($category) => ['slug' => $category->slug, 'name' => $category->name]);

        return view('font', compact('font', 'breadcrumbs'));
    }
}
