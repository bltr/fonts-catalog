@if ($paginator->hasPages())
    <nav>
        <ul class="pagination d-flex justify-content-between">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link py-3 px-4">«</span>
                </li>
            @elseif($paginator->currentPage() === 2)
                <li class="page-item">
                    <a class="page-link py-3 px-4"
                       href="{{ route(request()->route()->getName(), ['page' => null] + $currentRouteParameters) }}"
                    >
                        «
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link py-3 px-4"
                       href="{{ route(request()->route()->getName(), ['page' => 'page/' . ($paginator->currentPage() - 1)] + $currentRouteParameters) }}"
                    >
                        «
                    </a>
                </li>
            @endif

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link py-3 px-4"
                       href="{{ route(request()->route()->getName(), ['page' => 'page/' . ($paginator->currentPage() + 1)] + $currentRouteParameters) }}"
                    >
                        »
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link py-3 px-4">»</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
