<div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
        <div>
            <div class="px-1 md:px-0">
                <div class="flex">
                    @livewire('form')
                    @if(count($this->keys) > 0)
                        <button wire:click="deleteCheck" type="button" class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <span class="self-center"><em class="far fa-trash-alt"></em> Borrado masivo</span>
                        </button>
                        <button wire:click="restoreCheck" type="button" class="mx-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <span class="self-center"><em class="fas fa-trash-restore"></em> Restaurado masivo</span>
                        </button>
                    @endif
                </div>
                <div class="text-black pt-3 md:py-3 flex items-center w-full md:w-80 md:float-right">
                    <div class="w-full">
                        <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">
                                <em class="fas fa-search"></em>
                            </span>
                        </div>
                        <input type="search" name="q" id="q" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 sm:text-sm border-gray-300 rounded-md" wire:model="q">
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
                </div>
                <div class="flex py-3 pl-1 md:pl-0 relative">
                    <button wire:click="reload" type="button" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-400 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <span class="self-center"><em class="fas fa-sync-alt"></em> Recargar</span>
                    </button>
                    <x-dropdown-per-page>
                        <x-slot name="trigger">
                            <span class="flex items-center">
                                <span class="ml-3 block truncate">
                                    {{ $this->perPage }}
                                </span>
                            </span>
                            <span class="ml-3 absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </x-slot>
                        <x-slot name="content">
                            @for ($i = 15; $i <= 100; $i = $i + 15)
                                <li wire:click="updatePerPage({{ $i }})" class="text-gray-900 cursor-default select-none relative py-2 pl-3 cursor-pointer @if($this->perPage == $i) pr-9 @else pr-2 @endif hover:bg-indigo-500 hover:text-white" id="listbox-option-0" role="option">
                                    <div class="flex items-center">
                                        <span class="@if($this->perPage == $i) font-bold @else font-normal @endif ml-3 block truncate">
                                            {{ $i }}
                                        </span>
                                    </div>
                                    @if($this->perPage == $i)
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
                </div>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" @if(count($this->keys) == count($posts)) wire:click="unCheckAll" @else wire:click="checkAll" @endif>
                                            <div class="w-5 h-5 flex justify-center rounded border border-gray-300 cursor-pointer text-xs  shadow-sm @if(count($this->keys) == count($posts)) text-white bg-indigo-600 ring-2 ring-offset-0 ring-indigo-500 outline-none @else text-indigo-600 @endif">
                                                @if(count($this->keys) == count($posts)) <em class="fas fa-check self-center"></em> @endif
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 @if($this->orderBy == 'id') text-indigo-700 font-bold @endif uppercase tracking-wider">
                                            <div class="flex">
                                                <div class="self-center">
                                                    ID 
                                                 </div>
                                                 <div class="grid grid-cols-1 ml-2 text-gray-300">
                                                     <div class="w-max h-max cursor-pointer flex @if($this->orderBy == 'id' && $this->order == 'DESC') text-indigo-700 @endif" wire:click="order('id', 'DESC')">
                                                         <em class="fas fa-caret-up"></em>
                                                     </div>
                                                     <div class="w-max h-max cursor-pointer flex @if($this->orderBy == 'id' && $this->order == 'ASC') text-indigo-700 @endif" wire:click="order('id', 'ASC')">
                                                         <em class="fas fa-caret-down"></em>
                                                     </div>
                                                 </div>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <div class="self-center">
                                                Imagen
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 @if($this->orderBy == 'titulo') text-indigo-700 font-bold @endif uppercase tracking-wider">
                                            <div class="flex">
                                                <div class="self-center">
                                                    Título
                                                </div>
                                                <div class="grid grid-cols-1 ml-2 text-gray-300">
                                                    <div class="w-max h-max cursor-pointer flex @if($this->orderBy == 'titulo' && $this->order == 'DESC') text-indigo-700 @endif" wire:click="order('titulo', 'DESC')">
                                                        <em class="fas fa-caret-up"></em>
                                                    </div>
                                                    <div class="w-max h-max cursor-pointer flex @if($this->orderBy == 'titulo' && $this->order == 'ASC') text-indigo-700 @endif" wire:click="order('titulo', 'ASC')">
                                                        <em class="fas fa-caret-down"></em>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 @if($this->orderBy == 'created_at') text-indigo-700 font-bold @endif uppercase tracking-wider">
                                            <div class="flex">
                                                <div class="self-center">
                                                    Fecha
                                                </div>
                                                <div class="grid grid-cols-1 ml-2 text-gray-300">
                                                    <div class="w-max h-max cursor-pointer flex @if($this->orderBy == 'created_at' && $this->order == 'DESC') text-indigo-700 @endif" wire:click="order('created_at', 'DESC')">
                                                        <em class="fas fa-caret-up"></em>
                                                    </div>
                                                    <div class="w-max h-max cursor-pointer flex @if($this->orderBy == 'created_at' && $this->order == 'ASC') text-indigo-700 @endif" wire:click="order('created_at', 'ASC')">
                                                        <em class="fas fa-caret-down"></em>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 @if($this->orderBy == 'deleted_at') text-indigo-700 font-bold @endif uppercase tracking-wider">
                                            <div class="flex">
                                                <div class="self-center">
                                                    Estado
                                                </div>
                                                <div class="grid grid-cols-1 ml-2 text-gray-300">
                                                    <div class="w-max h-max cursor-pointer flex @if($this->orderBy == 'deleted_at' && $this->order == 'DESC') text-indigo-700 @endif" wire:click="order('deleted_at', 'DESC')">
                                                        <em class="fas fa-caret-up"></em>
                                                    </div>
                                                    <div class="w-max h-max cursor-pointer flex @if($this->orderBy == 'deleted_at' && $this->order == 'ASC') text-indigo-700 @endif" wire:click="order('deleted_at', 'ASC')">
                                                        <em class="fas fa-caret-down"></em>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200" wire:loading.class="hidden" wire:target="reload">
                                    @foreach ($posts as $post)
                                        <tr class="cursor-pointer z-0 overflow-hidden @if(array_search($post->id, $this->keys) !== false) bg-indigo-100 @else hover:bg-indigo-100 @endif">
                                            <td class="px-6 py-4 whitespace-nowrap" @if(array_search($post->id, $this->keys) !== false) wire:click="unCheck({{ $post->id }})" @else wire:click="check({{ $post->id }})" @endif>
                                                <div class="w-5 h-5 flex justify-center rounded border border-gray-300 cursor-pointer text-xs  shadow-sm @if(array_search($post->id, $this->keys) !== false) text-white bg-indigo-600 ring-2 ring-offset-0 ring-indigo-500 outline-none @else text-indigo-600 @endif">
                                                    @if(array_search($post->id, $this->keys) !== false) <em class="fas fa-check self-center"></em> @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap" @if(array_search($post->id, $this->keys) !== false) wire:click="unCheck({{ $post->id }})" @else wire:click="check({{ $post->id }})" @endif>
                                                <div class="text-sm text-gray-900">{{ $post->id }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap" @if(array_search($post->id, $this->keys) !== false) wire:click="unCheck({{ $post->id }})" @else wire:click="check({{ $post->id }})" @endif>
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded" src="{{ asset('img/'.$post->imagen) }}" alt="">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap" @if(array_search($post->id, $this->keys) !== false) wire:click="unCheck({{ $post->id }})" @else wire:click="check({{ $post->id }})" @endif>
                                                <div class="text-sm text-gray-900">{{ $post->titulo }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap" @if(array_search($post->id, $this->keys) !== false) wire:click="unCheck({{ $post->id }})" @else wire:click="check({{ $post->id }})" @endif>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    {{ $post->created_at }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap" @if(array_search($post->id, $this->keys) !== false) wire:click="unCheck({{ $post->id }})" @else wire:click="check({{ $post->id }})" @endif>
                                                @if (!empty($post->deleted_at))
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 z-10">
                                                        Delete
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 z-10">
                                                        Active
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                                <div x-data="{id: 1}" class="inline-flex">
                                                    <button wire:click="$emit('updateIdPost', {{ $post->id }})" @click="$dispatch('open-dropdown',{id})" type="button" class="inline-flex justify-center py-2 px-4 mx-1 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-300 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 z-10">
                                                        <span class="self-center"><em class="far fa-eye"></em> Ver</span>
                                                    </button>
                                                </div>
                                                <div x-data="{id: 2}" class="inline-flex">
                                                    <button wire:click="$emit('edit', {{ $post->id }})" @click="$dispatch('open-dropdown',{id})" type="button" class="inline-flex justify-center py-2 px-4 mx-1 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-400 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 z-10">
                                                        <span class="self-center"><em class="fas fa-pencil-alt"></em> Editar</span>
                                                    </button>
                                                </div>
                                                @if (!empty($post->deleted_at))
                                                    <button wire:click="restore({{ $post->id }})" type="button" class="inline-flex justify-center py-2 px-4 mx-1 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600 z-10">
                                                        <span class="self-center"><em class="fas fa-trash-restore"></em> Restaurar</span>
                                                    </button>
                                                    <button wire:click="forceDelete({{ $post->id }})" type="button" class="inline-flex justify-center py-2 px-4 mx-1 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 z-10">
                                                        <span class="self-center"><em class="fas fa-backspace"></em> Eliminar</span>
                                                    </button>
                                                @else
                                                    <button wire:click="delete({{ $post->id }})" type="button" class="inline-flex justify-center py-2 px-4 mx-1 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 z-10">
                                                        <span class="self-center"><em class="far fa-trash-alt"></em> Borrar</span>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="justify-center flex w-full flex hidden" wire:loading.remove.class="hidden" wire:target="reload">
                                <div class="lds-ellipsis">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-4">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
    @livewire('view-post')
    @livewire('edit-post')
    <button id="btn-top" class="fixed bottom-2 right-5 opacity-50 hidden inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-400 hover:bg-gray-500" onclick="goUp()">
        <em class="fas fa-arrow-up self-center"></em>
    </button>
</div>