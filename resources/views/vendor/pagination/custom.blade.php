@if ($paginator->hasPages())
    <div class="flex justify-center">
        <nav aria-label="Page navigation example">
            <ul class="inline-flex justify-center p-4 pb-2 -space-x-px">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li>
                        <span class="flex items-center justify-center h-8 px-3 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">
                            <svg class="w-3.5 h-3.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                            </svg>
                        </span>
                    </li>
                @else
                    <li>
<<<<<<< HEAD
                        <button wire:click="previousPage" rel="prev" class="flex items-center justify-center h-8 px-3 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <svg class="w-3.5 h-3.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                            </svg>
                        </button>
=======
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="flex items-center justify-center h-8 px-3 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <svg class="w-3.5 h-3.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                            </svg>
                        </a>
>>>>>>> 5c4e5b47f7a1ad8f121ef0402d01777a94a9fe87
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li>
                            <span class="flex items-center justify-center h-8 px-3 leading-tight text-gray-500 bg-white border border-gray-300">
                                {{ $element }}
                            </span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li>
<<<<<<< HEAD
                                    <span class="flex items-center justify-center h-8 px-3 text-lg font-bold text-blue-600 border border-gray-300 bg-blue-50">
=======
                                    <span class="flex items-center justify-center h-8 px-3 text-blue-600 border border-gray-300 bg-blue-50">
>>>>>>> 5c4e5b47f7a1ad8f121ef0402d01777a94a9fe87
                                        {{ $page }}
                                    </span>
                                </li>
                            @else
                                <li>
<<<<<<< HEAD
                                    <button wire:click="gotoPage({{ $page }})" class="flex items-center justify-center h-8 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                                        {{ $page }}
                                    </button>
=======
                                    <a href="{{ $url }}" class="flex items-center justify-center h-8 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                                        {{ $page }}
                                    </a>
>>>>>>> 5c4e5b47f7a1ad8f121ef0402d01777a94a9fe87
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li>
<<<<<<< HEAD
                        <button wire:click="nextPage" rel="next" class="flex items-center justify-center h-8 px-3 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700">
                            <svg class="w-3.5 h-3.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </button>
=======
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="flex items-center justify-center h-8 px-3 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700">
                            <svg class="w-3.5 h-3.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
>>>>>>> 5c4e5b47f7a1ad8f121ef0402d01777a94a9fe87
                    </li>
                @else
                    <li>
                        <span class="flex items-center justify-center h-8 px-3 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg">
                            <svg class="w-3.5 h-3.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
    <div class="flex justify-center">
        <span class="text-sm text-gray-700 dark:text-gray-400">
<<<<<<< HEAD
            Showing <span class="font-semibold text-gray-900 ">{{ $paginator->firstItem() }}</span>
            to <span class="font-semibold text-gray-900 ">{{ $paginator->lastItem() }}</span>
            of <span class="font-semibold text-gray-900 ">{{ $paginator->total() }}</span> Entries
        </span>
    </div>
@endif
=======
            Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->firstItem() }}</span>
            to <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->lastItem() }}</span>
            of <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->total() }}</span> Entries
        </span>
    </div>
@endif
>>>>>>> 5c4e5b47f7a1ad8f121ef0402d01777a94a9fe87
