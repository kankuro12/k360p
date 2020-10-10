@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class=" paget-item disabled"><span> <a class="page-link" href="#" > <strong><span class="ml-1"><i class="icon-long-arrow-left"></i>Previous</span> </strong></a> </span></li>
        @else
            <li class=" paget-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"> <strong><span class="ml-1"><i class="icon-long-arrow-left"></i>Previous</span> </strong></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled page-item"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class=" paget-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class=" paget-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"> <span class="mr-1"> <strong><span class="mr-1">Next</span>  <i class="icon-long-arrow-right"></i></strong></a></li>
        @else
            <li class="disabled page-item"><span><a class="page-link" href="#" >  <strong><span class="mr-1">Next</span>  <i class="icon-long-arrow-right"></i></strong></a></span></li>
        @endif
    </ul>
@endif