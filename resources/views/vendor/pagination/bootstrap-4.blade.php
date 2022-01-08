@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">
                    <span>&lsaquo;</span>
                    {{-- <span class="d-block d-md-none">@lang('pagination.previous')</span> --}}
                </span>
            </li>
        @else
            <li class="page-item">
                <button type="button" class="page-link" wire:click="previousPage" rel="prev" aria-label="@lang('pagination.previous')">
                    <span>&lsaquo;</span>
                    {{-- <span class="d-block d-md-none">@lang('pagination.previous')</span> --}}
                </button>
            </li>
        @endif

        <?php
            $start = $paginator->currentPage() - 2; // show 3 pagination links before current
            $end = $paginator->currentPage() + 2; // show 3 pagination links after current
            if($start < 1) {
                $start = 1; // reset start to 1
                $end += 1;
            }
            if($end >= $paginator->lastPage() ) $end = $paginator->lastPage(); // reset end to last page
        ?>
        @if($start > 1)
            <li class="page-item">
                <button type="button" class="page-link" wire:click="gotoPage(1)">1</button>
            </li>
        @endif
        @for ($i = $start; $i <= $end; $i++)
            @if ($i == $paginator->currentPage())
                <li class="page-item active " aria-current="page"><span class="page-link">{{ $i }}</span></li>
            @else
                <li class="page-item ">
                    <button type="button" class="page-link" wire:click="gotoPage({{ $i }})">{{ $i }}</button>
                </li>
            @endif
        @endfor
        @if($end < $paginator->lastPage())
            <li class="page-item">
                <button type="button" class="page-link" wire:click="gotoPage({{$paginator->lastPage()}})">{{$paginator->lastPage()}}</button>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <button type="button" class="page-link" wire:click="nextPage" rel="next" aria-label="@lang('pagination.next')">
                    {{-- <span class="d-block d-md-none">@lang('pagination.next')</span> --}}
                    <span>&rsaquo;</span>
                </button>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">
                    {{-- <span class="d-block d-md-none">@lang('pagination.next')</span> --}}
                    <span>&rsaquo;</span>
                </span>
            </li>
        @endif
    </ul>
@endif
