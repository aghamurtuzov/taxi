@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">← Geri</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="
                @if(strpos(url()->full(), 'search') !== false)
                {{ url()->full().'&page=1'  }}
                @else
                {{ $paginator->url('/page=1') }}
                @endif
                    " rel="prev"
                   aria-label="@lang('pagination.previous')">« İlk</a>
            </li>
            @php $previousPage = (int) request()->input('page') - 1; @endphp
            <li class="page-item">
                <a class="page-link" href="
                @if(strpos(url()->full(), 'search') !== false)
                {{ url()->full().'&page='. $previousPage  }}
                @else
                {{ $paginator->previousPageUrl() }}
                @endif
                    " rel="prev"
                   aria-label="@lang('pagination.previous')">← Geri</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))

                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link"
                                                 href="
                                                 @if(strpos(url()->full(), 'search') !== false)
                                                 {{ url()->full().'&page='.$page }}
                                                 @else
                                                 {{ $url }}
                                                 @endif
                                                     ">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @php $nextPage = (int) request()->input('page') + 1; @endphp
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="
                    @if(strpos(url()->full(), 'search') !== false)
                {{ url()->full().'&page='. $nextPage  }}
                @else
                {{ $paginator->nextPageUrl() }}
                @endif
                    " rel="next"
                   aria-label="@lang('pagination.next')">İrəli →</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="
                @if(strpos(url()->full(), 'search') !== false)
                {{ url()->full().'&page='.count($element)  }}
                @else
                {{ $paginator->url('/page='.$paginator->lastItem()) }}
                @endif
                    " rel="next"
                   aria-label="@lang('pagination.next')">Son »</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
@endif
