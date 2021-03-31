<div x-data="{ open: false }"
    x-show="open"
    @open-dropdown.window="if ($event.detail.id == 6) open = true"
    @click.away="open = false"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="transform opacity-0 scale-95"
    x-transition:enter-end="transform opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-75"
    x-transition:leave-start="transform opacity-100 scale-100"
    x-transition:leave-end="transform opacity-0 scale-95"
    class="fixed flex w-screen h-screen inset-0 z-50 bg-gray-900 bg-opacity-25"
    style="display: none;"
    >

    <div class="rounded-md self-center ring-1 ring-black ring-opacity-5 overflow-y-auto max-h-screen max-w-screen mx-auto shadow-xl bg-white">
        <div class="px-4">
            <div class="modal-body p-0">
                <div class="p-5 text-center">
                    <em class="w-16 h-16 text-theme-6 mx-auto mt-3 far fa-trash-alt text-7xl text-red-500"></em>
                    <div class="text-3xl mt-5 font-bold">¿Está seguro?</div>
                    <div class="text-gray-500 mt-2"> ¿Realmente desea borrar estos registros?</div>
                </div>
                <div class="px-5 pb-8 text-center">
                    <button @click="open = false" type="button" onclick="allowScroll()" class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-500 bg-white focus:outline-none">
                        <span class="self-center">Cancelar</span>
                    </button>
                    <button @click="open = false" wire:click="deleteCheck" onclick="allowScroll()" type="button" class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600">
                        <span class="self-center">Borrar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>