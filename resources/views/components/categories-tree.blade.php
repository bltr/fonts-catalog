<ul>
    @foreach($categories as $category)
        <li>
            <a href="{{ route('category', $category) }}"
               class="text-decoration-none {{ $font_size ?? 'fs-4' }}"
            >
                {{ $category->name }}
            </a>
            <sup class="text-body-tertiary">[{{ $category->fonts_count }}]</sup>
            @if($category->children->isNotEmpty())
                @include('components.categories-tree', ['categories' => $category->children, 'font_size' => 'fs-6'])
            @endif
        </li>
        @if($loop->iteration === 10)
            <span class="text-secondary small" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $category->id }}">
                раскрыть
                &bigtriangledown;
            </span>
            <div class="collapse" id="collapse-{{ $category->id }}">
        @endif
    @endforeach
    @if($categories->count() > 10)
        </div>
    @endif
</ul>
