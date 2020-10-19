@if ($paginator->hasPages())
    @php
    $str = '';
    foreach ($arr as $key => $value) {
    $str = $str . '&' . $key . '=' . $value ;
    // dd($str);
    }
    @endphp
    <!-- Pagination -->
    <div class="pull-right paginating-container pagination-solid justify-content-end">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled">
                    <span>
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->url(1) . $str }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-chevrons-left">
                                <polyline points="11 17 6 12 11 7"></polyline>
                                <polyline points="18 17 13 12 18 7"></polyline>
                            </svg>

                    </a></li>
                </span>
                </a>
                </li>

                <li>
                    <a href="{{ $paginator->previousPageUrl() . $str }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-chevron-left">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                    </a></li>
                </span>
                </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><span>
                                    <a href="">{{ $page }}</a>
                                </span></li>
                        @elseif (($page == $paginator->currentPage() + 1|| $page == $paginator->currentPage() + 2 )
                            || $page == $paginator->lastPage())
                            <li><a href="{{ $url . $str }}">{{ $page }}</a></li>
                        @elseif ($page == $paginator->lastPage() - 1)
                            {{-- <li><a>...</a></li> --}}
                            <li class="disabled"><a><span><i class="">...</i></span></a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() . $str }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ $paginator->url($lastpage) . $str }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-chevrons-right">
                                <polyline points="13 17 18 12 13 7"></polyline>
                                <polyline points="6 17 11 12 6 7"></polyline>
                            </svg>
                        </span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
    <!-- Pagination -->
@endif
