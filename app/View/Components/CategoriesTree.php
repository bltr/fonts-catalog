<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoriesTree extends Component
{
    public function render(): View|Closure|string
    {
        $categories = Category::withDepth()
            ->withCount('fonts')
            ->orderBy('fonts_count', 'desc')
            ->get()
            ->toTree();

        return view('components.categories-tree', compact('categories'));
    }
}
