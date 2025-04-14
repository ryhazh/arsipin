@if ($paginator->hasPages())
    <nav>
        {{-- Mobile view pagination --}}
        <div class="d-flex d-sm-none justify-content-center">
            <ul class="pagination m-0">
                {{-- Previous Arrow --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled"><span class="btn btn-pill btn-ghost-secondary">&laquo;</span></li>
                @else
                    <li class="page-item"><a class="btn btn-pill btn-ghost-secondary" href="{{ $paginator->previousPageUrl() }}">&laquo;</a></li>
                @endif

                {{-- Current Page --}}
                <li class="page-item"><span class="btn btn-pill btn-ghost-secondary">{{ $paginator->currentPage() }}</span></li>

                {{-- Next Arrow --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item"><a class="btn btn-pill btn-ghost-secondary" href="{{ $paginator->nextPageUrl() }}">&raquo;</a></li>
                @else
                    <li class="page-item disabled"><span class="btn btn-pill btn-ghost-secondary">&raquo;</span></li>
                @endif
            </ul>
        </div>

        {{-- Desktop view pagination --}}
        <div class="d-none d-sm-block">
            <ul class="pagination m-0">
                {{-- Previous Arrow --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled"><span class="btn btn-pill btn-ghost-secondary">&laquo;</span></li>
                @else
                    <li class="page-item"><a class="btn btn-pill btn-ghost-secondary" href="{{ $paginator->previousPageUrl() }}">&laquo;</a></li>
                @endif

                @foreach ($elements as $element)
                    @if (is_array($element))
                        @php
                            $currentPage = $paginator->currentPage();
                        @endphp
                        
                        {{-- Previous Page Number --}}
                        @if($currentPage > 1)
                            <li class="page-item"><a class="btn btn-pill btn-ghost-secondary" href="{{ $paginator->url($currentPage - 1) }}">{{ $currentPage - 1 }}</a></li>
                        @endif

                        {{-- Current Page --}}
                        <li class="page-item active"><span class="btn btn-pill">{{ $currentPage }}</span></li>

                        {{-- Next Page Number --}}
                        @if($currentPage < $paginator->lastPage())
                            <li class="page-item"><a class="btn btn-pill btn-ghost-secondary" href="{{ $paginator->url($currentPage + 1) }}">{{ $currentPage + 1 }}</a></li>
                        @endif
                    @endif
                @endforeach

                {{-- Next Arrow --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item"><a class="btn btn-pill btn-ghost-secondary" href="{{ $paginator->nextPageUrl() }}">&raquo;</a></li>
                @else
                    <li class="page-item disabled"><span class="btn btn-pill btn-ghost-secondary">&raquo;</span></li>
                @endif
            </ul>
        </div>
    </nav>
@endif
