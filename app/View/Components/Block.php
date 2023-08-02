<?php

namespace App\View\Components;

use App\Models\Block as BlockModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Block extends Component
{
    public ?BlockModel $block;

    public function __construct(
        public string $blockName,
    ) {
        $this->block = BlockModel::firstOrCreate(['name' => $blockName]);
    }

    public function render(): View|Closure|string
    {
        return view('components.block');
    }

    public function enabled()
    {
        return !is_null($this->block) && $this->block->is_active;
    }
}
