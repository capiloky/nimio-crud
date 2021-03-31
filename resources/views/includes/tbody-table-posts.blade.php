<tbody class="bg-white divide-y divide-gray-200" wire:loading.class="hidden" wire:target="reload, q, order, orderBy">
    @foreach ($posts as $post)
        <tr class="cursor-pointer z-0 overflow-hidden @if(array_search($post->id, $keys) !== false) bg-indigo-100 @else hover:bg-indigo-100 @endif hover:border-0">
            <td class="px-6 py-4 whitespace-nowrap" @if(array_search($post->id, $keys) !== false) wire:click="unCheck({{ $post->id }})" @else wire:click="check({{ $post->id }})" @endif>
                <div class="w-5 h-5 flex justify-center rounded border border-gray-300 cursor-pointer text-xs  shadow-sm @if(array_search($post->id, $keys) !== false) text-white bg-indigo-600 ring-2 ring-offset-0 ring-indigo-500 outline-none @else text-indigo-600 @endif">
                    @if(array_search($post->id, $keys) !== false) <em class="fas fa-check self-center"></em> @endif
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap" @if(array_search($post->id, $keys) !== false) wire:click="unCheck({{ $post->id }})" @else wire:click="check({{ $post->id }})" @endif>
                <div class="text-sm text-gray-900">{{ $post->id }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap" @if(array_search($post->id, $keys) !== false) wire:click="unCheck({{ $post->id }})" @else wire:click="check({{ $post->id }})" @endif>
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10">
                        <img class="h-10 w-10 rounded" src="{{ asset('img/'.$post->imagen) }}" alt="">
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap" @if(array_search($post->id, $keys) !== false) wire:click="unCheck({{ $post->id }})" @else wire:click="check({{ $post->id }})" @endif>
                <div class="text-sm text-gray-900">{{ $post->titulo }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap" @if(array_search($post->id, $keys) !== false) wire:click="unCheck({{ $post->id }})" @else wire:click="check({{ $post->id }})" @endif>
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                    {{ $post->created_at }}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap" @if(array_search($post->id, $keys) !== false) wire:click="unCheck({{ $post->id }})" @else wire:click="check({{ $post->id }})" @endif>
                @if (!empty($post->deleted_at))
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 z-10">
                        Borrado
                    </span>
                @else
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 z-10">
                        Activo
                    </span>
                @endif
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                <div x-data="{id: 1}" class="inline-flex">
                    <button wire:click="$emit('updateIdPost', {{ $post->id }})" onclick="disallowScroll()" @click="$dispatch('open-dropdown',{id})" type="button" class="inline-flex justify-center py-2 px-4 mx-1 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-300 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 z-10">
                        <span class="self-center"><em class="far fa-eye"></em> Ver</span>
                    </button>
                </div>
                <div x-data="{id: 2}" class="inline-flex">
                    <button wire:click="$emit('edit', {{ $post->id }})" @click="$dispatch('open-dropdown',{id})" onclick="disallowScroll()" type="button" class="inline-flex justify-center py-2 px-4 mx-1 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-400 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 z-10">
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