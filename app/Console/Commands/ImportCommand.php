<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Font;
use Illuminate\Console\Command;

class ImportCommand extends Command
{
    protected $signature = 'import';

    protected $description = 'Command description';

    public function handle()
    {
        $this->categories();
        $this->fonts();
        $this->relation();
    }

    private function categories(): void
    {
        $categories = json_decode(file_get_contents('data/categories.json'));

        foreach ($categories as $category) {
            Category::create([
                'id' => $category->term_id,
                'slug' => $category->slug,
                'name' => $category->name,
                'parent_id' => $category->parent === 0 ? null : $category->parent,
            ]);
        }

        Category::fixTree();
    }

    private function fonts()
    {
        $fonts = json_decode(file_get_contents('data/fonts.json'));

        foreach ($fonts as $font) {
            Font::create([
                'id' => $font->id,
                'slug' => $font->name,
                'name' => $font->title,
                'zip_file' => $font->zip_file,
                'ttf_file' => $font->ttf_file,
            ]);
        }
    }

    private function relation()
    {
        $relations = json_decode(file_get_contents('data/font_category.json'));

        foreach ($relations as $relation) {
            Font::find($relation->id)->categories()->attach($relation->category_ids);
        }
    }
}
