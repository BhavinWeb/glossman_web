@if ($paginator->hasPages())
    <div class="shop-body-01__pagination">
        <ul class="pagination-block-01">
            @if ($paginator->onFirstPage())
                <li class="previous">
                    <a class="page-link cursor-not-allowed" href="#" onclick="return false;">
                        <svg svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.25 12H3.75" stroke="var(--bs-primary-500)" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M10.5 5.25L3.75 12L10.5 18.75" stroke="var(--bs-primary-500)" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </li>
            @else
                <li class="previous">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                        <svg svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.25 12H3.75" stroke="var(--bs-primary-500)" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M10.5 5.25L3.75 12L10.5 18.75" stroke="var(--bs-primary-500)" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </li>
            @endif
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><a onclick="return false;" class="page-link cursor-not-allowed"
                                    href="#">{{ $page }}</a></li>
                        @else
                            <li><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <li class="next">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.75 12H20.25" stroke="var(--bs-primary-500)" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M13.5 5.25L20.25 12L13.5 18.75" stroke="var(--bs-primary-500)" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </li>
            @else
                <li class="next">
                    <a class="page-link cursor-not-allowed" href="#" onclick="return false;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.75 12H20.25" stroke="var(--bs-primary-500)" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M13.5 5.25L20.25 12L13.5 18.75" stroke="var(--bs-primary-500)" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </li>
            @endif
        </ul>
    </div>
@endif
