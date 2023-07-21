<nav>
    <ul class="breadcrumb fw-bold" itemscope itemtype="http://schema.org/BreadcrumbList">
        <li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a href="{{ url('/') }}" class="text-decoration-none text-secondary" itemprop="item">
                <span itemprop="name">Главная</span>
            </a>
        </li>
        @foreach($breadcrumbs as $breadcrumb)
        <li class="breadcrumb-item active text-danger" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a href="{{ route('category', $breadcrumb['slug']) }}" class="text-decoration-none text-secondary" itemprop="item">
                <span itemprop="name">{{ $breadcrumb['name'] }}</span>
            </a>
        </li>
        @endforeach
    </ul>
</nav>
