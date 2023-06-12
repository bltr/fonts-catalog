<?php

namespace App\Http\Controllers\Front;

use App\Models\Font;

class HomeController
{
    private const PER_PAGE = 20;

    public function __invoke()
    {
        $fonts = Font::simplePaginate(static::PER_PAGE);

        return view('home', compact('fonts'));
    }
}
