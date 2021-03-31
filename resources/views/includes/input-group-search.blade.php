<div class="inline-flex w-full md:w-56 md:absolute md:right-0 mt-2 md:mt-0">
    <div class="relative rounded-md shadow-sm w-full">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <span class="text-gray-500 sm:text-sm">
                <em class="fas fa-search"></em>
            </span>
        </div>
        <input type="search" name="q" id="q" class="shadow-none block w-full pl-7 sm:text-sm border-gray-300 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-2 focus:border-none rounded-md" wire:model="q">
        <div x-data="{id: 3}" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
            <div @click="$dispatch('open-dropdown',{id})">
                <span class="text-gray-500 sm:text-sm">
                    <em class="far fa-question-circle"></em>
                </span>
            </div>
        </div>
        <div x-data="{ open: false }"
            x-show="open"
            @open-dropdown.window="if ($event.detail.id == 3) open = true"
            @click.away="open = false"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95" 
            style="display: none;"
            class="bg-white mt-1 border-0 mb-3 block z-50 font-normal border border-gray-300 w-full leading-normal shadow text-sm max-w-xs text-left no-underline break-words rounded-lg absolute">
            <div>
            <div class="bg-white text-gray-500 opacity-75 font-semibold p-3 mb-0 border-b border-solid border-blueGray-100 uppercase rounded-t-lg">
                Filtros de búsqueda
            </div>
            <div class="text-indigo-500 p-3">
                id:[query] -> buscar por id
                <br>
                tl:[query] -> buscar por título
                <br>
                ds:[query] -> buscar por descripción
            </div>
            </div>
        </div>
    </div>
</div>