<nav>
    <ul class="breadcrumb fw-bold">
        <li class="breadcrumb-item active"><a href="{{ url('/') }}" class="text-decoration-none text-secondary">Главная</a></li>
        @foreach($breadcrumbs as $breadcrumb)
        <li class="breadcrumb-item active text-danger">
            <a href="{{ route('category', $breadcrumb['slug']) }}" class="text-decoration-none text-secondary">
                {{ $breadcrumb['name'] }}
            </a>
        </li>
        @endforeach
    </ul>
</nav>
