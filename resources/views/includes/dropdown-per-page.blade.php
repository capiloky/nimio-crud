<x-dropdown-per-page>
    <x-slot name="trigger">
        <span class="flex items-center">
            <span class="ml-3 block truncate">
                {{ $perPage }}
            </span>
        </span>
        <span class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </span>
    </x-slot>
    <x-slot name="content">
        @for ($i = 15; $i <= 100; $i = $i + 15)
            <li wire:click="updatePerPage({{ $i }})" class="text-gray-900 cursor-default select-none relative py-2 pl-3 cursor-pointer @if($perPage == $i) pr-9 @else pr-2 @endif hover:bg-indigo-500 hover:text-white" id="listbox-option-0" role="option">
                <div class="flex items-center">
                    <span class="@if($perPage == $i) font-bold @else font-normal @endif ml-3 block truncate">
                        {{ $i }}
                    </span>
                </div>
                @if($perPage == $i)
                    <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                @endif
            </li>
        @endfor
    </x-slot>
</x-dropdown-per-page>