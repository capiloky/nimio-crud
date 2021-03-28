<div x-data="{ open: false }"
    x-show="open"
    @open-dropdown.window="if ($event.detail.id == 1) open = true"
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

    <div class="rounded-md self-center ring-1 ring-black ring-opacity-5 max-w-7xl overflow-y-auto max-h-screen max-w-screen w-screen md:w-3/5 h-screen md:h-4/5 mx-auto shadow-xl bg-white">
        <div class="w-full h-14 py-2 flex relative sticky top-0 left-0 bg-white shadow px-2">
            <button @click="open = false" type="button" class="absolute right-2 self-center mx-2 my-1 md:mx-0 inline-flex justify-center py-2 px-3 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <em class="fas fa-times"></em>
            </button>
        </div>
        @if(!empty($post))
            <div class="md:col-span-1" wire:loading.class="hidden">
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                    <h2 class="text-lg font-bold leading-10 text-gray-900 text-4xl">{{ $post['titulo'] }}</h2>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 rounded-md">
                        <div class="space-y-0.5 text-center">
                            <img class="max-w-full max-h-40" src="{{ asset('img/'.$post['imagen']) }}" alt="">
                        </div>
                    </div>
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                        {{ $post['created_at'] }}
                    </span>
                    <p class="mt-1 text-sm text-gray-600">
                        @php
                            echo $post['descripcion'];    
                        @endphp
                    </p>
                </div>
            </div>
        @endif
        <div wire:loading class="justify-center flex w-full flex md:col-span-1">
            <div class="lds-ellipsis">
                <div></div><div></div><div></div><div></div>
            </div>
        </div>
    </div>
</div>
