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
        $block = BlockModel::allCached()->get($this->blockName);
        if (is_null($block)) {
            $block = BlockModel::create(['name' => $blockName]);
        }
        $this->block = $block;
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
