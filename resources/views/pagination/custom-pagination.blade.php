@if ($paginator->hasPages() || $paginator->count() >= 10)
    <ul class="pager">
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>← Trang đầu</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">← Trang đầu</a></li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active my-active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->url($paginator->lastPage()) }}">Trang cuối →</a></li>
        @else
            <li class="disabled"><span>Trang cuối →</span></li>
        @endif
    </ul>
@endif
