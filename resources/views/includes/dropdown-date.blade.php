<div class="relative inline-flex">
    <div x-data="{id: 10}">
        <button @click="$dispatch('open-dropdown',{id})" type="button" class="relative w-full cursor-pointer bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-14 py-2 text-left cursor-default focus:border-none focus:ring-indigo-500 focus:ring-2 focus:ring-offset-2 sm:text-sm border-gray-300 focus:outline-none sm:text-sm">
            <span class="flex items-center">
                <span class="ml-3 block truncate">
                    <em class="far fa-calendar-alt"></em>
                </span>
            </span>
            <span class="ml-3 absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </span>
        </button>
    </div>
    <ul x-data="{ open: false }"
        x-show="open"
        @open-dropdown.window="if ($event.detail.id == 10) open = true"
        @click.away="open = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95" 
        style="display: none;"
        class="absolute w-max mt-2 top-full bg-white shadow-lg rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm z-50">
        <li class="select-none relative py-3 px-3" id="listbox-option-0" role="option">
            <div class="block text-sm font-medium text-gray-700 px-1">
                Rango de fechas
            </div>
            <div class="grid grid-flow-col auto-cols-auto">
                <div class="px-1" style="min-width: 6rem;">
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <input type="date" wire:model="firstDate" id="startdate" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300">
                    </div>
                </div>
                <div class="flex items-center text-2xl">
                    -
                </div>
                <div class="px-1" style="min-width: 6rem;">
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <input type="date" wire:model="lastDate" id="enddate" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300">
                    </div>
                </div>
            </div>
        </li>
        <li class="flex justify-center my-1">
            <div class="border boder-indigo-300 w-11/12"></div>
        </li>
        <li wire:click="updateDate(1)" wire:click="updateDate(1)" class="text-gray-900 cursor-default select-none relative py-2 px-3 cursor-pointer hover:bg-indigo-500 hover:text-white" id="listbox-option-0" role="option">
            <div class="flex items-center">
                <span class="ml-3 block truncate">
                    Últimas 24 horas
                </span>
            </div>
            @if(empty($date) && $sortDate == 1)
                <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
            @endif
        </li>
        <li wire:click="updateDate(7)" class="text-gray-900 cursor-default select-none relative py-2 px-3 cursor-pointer hover:bg-indigo-500 hover:text-white" id="listbox-option-0" role="option">
            <div class="flex items-center">
                <span class="ml-3 block truncate">
                    Últimos 7 días
                </span>
            </div>
            @if(empty($date) && $sortDate == 7)
                <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
            @endif
        </li>
        <li wire:click="updateDate(30)"  class="text-gray-900 cursor-default select-none relative py-2 px-3 cursor-pointer hover:bg-indigo-500 hover:text-white" id="listbox-option-0" role="option">
            <div class="flex items-center">
                <span class="ml-3 block truncate">
                    Últimos 30 días
                </span>
            </div>
            @if(empty($date) && $sortDate == 30)
                <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
            @endif
        </li>
        <li wire:click="updateDate('')" class="text-gray-900 cursor-default select-none relative py-2 px-3 cursor-pointer hover:bg-indigo-500 hover:text-white" id="listbox-option-0" role="option">
            <div class="flex items-center">
                <span class="ml-3 block truncate">
                    Desde siempre
                </span>
            </div>
            @if(empty($date) && empty($sortDate))
                <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
            @endif
        </li>
    </ul>
</div>