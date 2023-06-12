<ul>
    @foreach($categories as $category)
        <li>
            <a href="{{ route('category', $category) }}">{{ $category->name }}</a> ({{ $category->fonts_count }})
            @if($category->children->isNotEmpty())
                @include('components.categories-tree', ['categories' => $category->children])
            @endif
        </li>
    @endforeach
</ul>
