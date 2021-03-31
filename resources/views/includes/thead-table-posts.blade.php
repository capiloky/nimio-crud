<thead class="bg-white">
    <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" @if(count($keys) == count($posts) && count($posts) != 0) wire:click="unCheckAll" @else wire:click="checkAll" @endif>
            <div class="w-5 h-5 flex justify-center rounded border border-gray-300 cursor-pointer text-xs  shadow-sm @if(count($keys) == count($posts) && count($posts) != 0) text-white bg-indigo-600 ring-2 ring-offset-0 ring-indigo-500 outline-none @else text-indigo-600 @endif">
                @if(count($keys) == count($posts) && count($posts) != 0) <em class="fas fa-check self-center"></em> @endif
            </div>
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 @if($orderBy == 'id') text-indigo-700 font-bold @endif uppercase tracking-wider">
            <div class="flex">
                <div class="self-center mt-1 text-gray-900">
                    ID 
                 </div>
                 <div class="grid grid-cols-1 ml-2 text-gray-300">
                     <div class="w-max h-max cursor-pointer flex @if($orderBy == 'id' && $order == 'ASC') text-indigo-700 @endif" wire:click="order('id', 'ASC')">
                         <em class="fas fa-caret-up"></em>
                     </div>
                     <div class="w-max h-max cursor-pointer flex @if($orderBy == 'id' && $order == 'DESC') text-indigo-700 @endif" wire:click="order('id', 'DESC')">
                         <em class="fas fa-caret-down"></em>
                     </div>
                 </div>
            </div>
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            <div class="self-center mt-1 text-gray-900">
                Imagen
            </div>
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 @if($orderBy == 'titulo') text-indigo-700 font-bold @endif uppercase tracking-wider">
            <div class="flex">
                <div class="self-center mt-1 text-gray-900">
                    Título
                </div>
                <div class="grid grid-cols-1 ml-2 text-gray-300">
                    <div class="w-max h-max cursor-pointer flex @if($orderBy == 'titulo' && $order == 'ASC') text-indigo-700 @endif" wire:click="order('titulo', 'ASC')">
                        <em class="fas fa-caret-up"></em>
                    </div>
                    <div class="w-max h-max cursor-pointer flex @if($orderBy == 'titulo' && $order == 'DESC') text-indigo-700 @endif" wire:click="order('titulo', 'DESC')">
                        <em class="fas fa-caret-down"></em>
                    </div>
                </div>
            </div>
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 @if($orderBy == 'created_at') text-indigo-700 font-bold @endif uppercase tracking-wider">
            <div class="flex">
                <div class="self-center mt-1 text-gray-900">
                    Fecha
                </div>
                <div class="grid grid-cols-1 ml-2 text-gray-300">
                    <div class="w-max h-max cursor-pointer flex @if($orderBy == 'created_at' && $order == 'ASC') text-indigo-700 @endif" wire:click="order('created_at', 'ASC')">
                        <em class="fas fa-caret-up"></em>
                    </div>
                    <div class="w-max h-max cursor-pointer flex @if($orderBy == 'created_at' && $order == 'DESC') text-indigo-700 @endif" wire:click="order('created_at', 'DESC')">
                        <em class="fas fa-caret-down"></em>
                    </div>
                </div>
            </div>
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 @if($orderBy == 'deleted_at') text-indigo-700 font-bold @endif uppercase tracking-wider">
            <div class="flex">
                <div class="self-center mt-1 text-gray-900">
                    Estado
                </div>
                <div class="grid grid-cols-1 ml-2 text-gray-300">
                    <div class="w-max h-max cursor-pointer flex @if($orderBy == 'deleted_at' && $order == 'ASC') text-indigo-700 @endif" wire:click="order('deleted_at', 'ASC')">
                        <em class="fas fa-caret-up"></em>
                    </div>
                    <div class="w-max h-max cursor-pointer flex @if($orderBy == 'deleted_at' && $order == 'DESC') text-indigo-700 @endif" wire:click="order('deleted_at', 'DESC')">
                        <em class="fas fa-caret-down"></em>
                    </div>
                </div>
            </div>
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            <div class="self-center mt-1 text-gray-900">
                Acciones
            </div>
        </th>
    </tr>
</thead>