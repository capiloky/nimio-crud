<div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
    <x-dropdown-view align="right" width="48">
        <x-slot name="trigger">
            <button type="button" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-400 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                <span class="self-center"><em class="fas fa-plus-circle"></em> Añadir nuevo</span>
            </button>
        </x-slot>
        <x-slot name="content">
            <div class="w-full py-2 flex relative sticky top-0 left-0 bg-white shadow px-2">
                <div class="px-4">
                    <div wire:click="select(1)" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md  @if($this->select == 1) bg-indigo-200 text-indigo-700 @else bg-white text-gray-400 @endif font-bold hover:bg-indigo-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer">
                        Manual
                    </div>
                    <div wire:click="select(2)" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md  @if($this->select == 2) bg-indigo-200 text-indigo-700 @else bg-white text-gray-400 @endif font-bold hover:bg-indigo-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer">
                        Automático
                    </div>
                </div>
                <button @click="open = false" onclick="allowScroll()" type="button" class="absolute right-2 self-center mx-2 my-1 md:mx-0 inline-flex justify-center py-2 px-3 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <em class="fas fa-times"></em>
                </button>
            </div>
            <div>
                <div class="@if($this->select == 1) md:grid md:grid-cols-3 md:gap-6 @endif my-2 mx-2">
                  <div class="mt-5 md:mt-0 md:col-span-2 @if($this->select == 1) md:border-r-2 md:border-b-0  @endif border-b-2">
                    <div class="w-full">
                        @if (session()->has('create'))
                            <div class="max-w-full w-full px-4 mt-2">
                                <div class="w-full bg-green-500 px-4 py-4 rounded text-white text-lg font-bold">
                                    {{ session('create') }}
                                </div>
                            </div>
                        @endif
                        @if (session()->has('warning'))
                            <div class="max-w-full w-full px-4 mt-2">
                                <div class="w-full bg-red-500 px-4 py-4 rounded text-white text-lg font-bold">
                                    {{ session('warning') }}
                                </div>
                            </div>
                        @endif
                    </div>
                    <form wire:submit.prevent="save(Object.fromEntries(new FormData($event.target)))">
                        @csrf
                        <div class="border-gray-200 sm:overflow-hidden">
                            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                <div>
                                    @if($this->select == 2)
                                        <div>
                                            <div class="col-span-3 sm:col-span-2">
                                                <label for="link" class="block text-sm font-medium text-gray-700">
                                                    Link
                                                </label>
                                                <div class="mt-1 flex rounded-md shadow-sm">
                                                    <input type="text" name="link" id="link" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300" placeholder="https://es.wikipedia.org/wiki/xxx" wire:model="link" wire:keyup.300ms="updateLink">
                                                </div>
                                                <p class="mt-2 text-sm text-red-500">
                                                    @error('link') <span>{{ $message }}</span> @enderror
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <span class="block text-sm font-medium text-gray-700">
                                                Formato
                                            </span>
                                            <x-dropdown-select>
                                                <x-slot name="trigger">
                                                    <span class="flex items-center">
                                                        <span class="ml-3 block truncate">
                                                            {{ $this->selectFormat }}
                                                        </span>
                                                    </span>
                                                    <span class="ml-3 absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                </x-slot>
                                                <x-slot name="content">
                                                    <li wire:click="updateFormat('texto enriquecido')" class="text-gray-900 cursor-default select-none relative py-2 pl-3 cursor-pointer @if($this->selectFormat == 'texto enriquecido') pr-9 @else pr-2 @endif hover:bg-indigo-500 hover:text-white" id="listbox-option-0" role="option">
                                                        <div class="flex items-center">
                                                            <span class="@if($this->selectFormat == 'texto enriquecido') font-bold @else font-normal @endif ml-3 block truncate">
                                                                Texto Enriquecido
                                                            </span>
                                                        </div>
                                                        @if($this->selectFormat == 'texto enriquecido')
                                                            <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
                                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                                </svg>
                                                            </span>
                                                        @endif
                                                    </li>
                                                    <li wire:click="updateFormat('texto plano')" class="text-gray-900 cursor-default select-none relative py-2 pl-3 cursor-pointer @if($this->selectFormat == 'texto plano') pr-9 @else pr-2 @endif hover:bg-indigo-500 hover:text-white" id="listbox-option-0" role="option">
                                                        <div class="flex items-center">
                                                            <span class="@if($this->selectFormat == 'texto plano') font-bold @else font-normal @endif ml-3 block truncate">
                                                                Texto Plano
                                                            </span>
                                                        </div>
                                                        @if($this->selectFormat == 'texto plano')
                                                            <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
                                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                                </svg>
                                                            </span>
                                                        @endif
                                                    </li>
                                                </x-slot>
                                            </x-dropdown-select>
                                        </div>
                                    @endif
                                </div>
                                <div class="@if($this->select == 2) hidden @endif">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">
                                            Imagen
                                        </label>
                                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 rounded-md">
                                            <div class="space-y-1 text-center">
                                                @if (!empty($this->photo))
                                                    <img class="mx-auto h-12 w-12" src="{{ $photo->temporaryUrl() }}" alt="">
                                                @elseif(!empty($this->autoImage))
                                                    <img class="mx-auto h-12 w-12" src="{{ $this->autoImage }}" alt="">
                                                @else
                                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                @endif
                                                <div class="flex text-sm text-gray-600 justify-center">
                                                    <label for="photo" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                        <span>Sube una imagen</span>
                                                        <input id="photo" name="photo" type="file" class="sr-only" wire:model="photo" accept="image/x-png,image/jpeg" />
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mt-2 text-sm text-red-500">
                                            @error('photo') <span>{{ $message }}</span> @enderror
                                        </p>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                                        <input type="text" name="titulo" id="titulo" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model="titulo">
                                        <p class="mt-2 text-sm text-red-500">
                                            @error('titulo') <span>{{ $message }}</span> @enderror
                                        </p>
                                    </div>
                                </div>
                                <div class="@if($this->select == 2) hidden @endif">
                                    <label for="editor" class="block text-sm font-medium text-gray-700">
                                        Descripción
                                    </label>
                                    <div wire:key="8927349823">
                                        <div class="mt-1" wire:ignore>
                                            <textarea id="editor" name="editor" rows="3" class="editor shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                                            <input name="image" type="file" id="upload" class="hidden" onchange="">
                                        </div>
                                    </div>
                                    <p class="mt-2 text-sm text-red-500">
                                        @if (session()->has('descripcion'))
                                            <span>{{ session('descripcion') }}</span> 
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="px-4 py-3 text-right sm:px-6">
                                <button wire:click="clear" type="button" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                    Borrar
                                </button>
                                <button type="submit" class="inline-flex justify-center ml-2 py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="md:col-span-1" wire:loading.class="hidden" wire:target="updateLink, updateFormat" >
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                            <h3 class="text-4xl font-bold leading-6 text-gray-900">Preview</h3>
                            <div>
                                <h2 class="font-medium leading-10 text-gray-900 text-2xl">{{ $this->titulo }}</h2>
                            </div>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 rounded-md">
                                <div class="space-y-0.5 text-center">
                                    @if (empty($this->autoImage))
                                        @if (! empty($photo))
                                            <img class="max-w-full max-h-40" src="{{ $photo->temporaryUrl() }}" alt="">
                                        @else
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        @endif
                                    @else
                                        <img class="max-w-full max-h-40" src="{{ $this->autoImage }}" alt="">
                                    @endif

                                </div>
                            </div>
                            <div>
                                <p class="mt-1 text-sm text-gray-600">
                                    @php
                                        echo $this->descripcion;    
                                    @endphp
                                </p>
                            </div>
                        </div>
                    </div>
                    <div wire:loading.remove.class="hidden" wire:target="updateLink, updateFormat" class="justify-center flex hidden w-full">
                        <div class="lds-ellipsis">
                            <div></div><div></div><div></div><div></div>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-dropdown-view>
    <script wire:ignore>
        var editor_config = {
            menubar: false,
            branding: false,
            selector: "textarea.editor",
            autoresize_bottom_margin:20,
            a11y_advanced_options: false,
            image_description: false,
            image_dimensions: false,
            image_uploadtab: false,
            link_title: false,
            target_list: false,
            link_context_toolbar: true,
            image_advtab: false,
            content_css : '/css/editor.css',
            setup: function(ed) {
                ed.on('change', function(e) {
                    var contenido = tinyMCE.activeEditor.getContent();
                    Livewire.emit('actualizar', contenido);
                });
                ed.on('keyup', function(e) {
                    var contenido = tinyMCE.activeEditor.getContent();
                    Livewire.emit('actualizar', contenido);
                });
            },

            plugins: [
            "autoresize",
            "link autolink lists image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table directionality",
            "emoticons template paste textpattern",  
            ],
            toolbar: "insertfile undo redo | underline strikethrough bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image | emoticons",
            relative_urls : false,
            remove_script_host : false,
            convert_urls : true,
            autoresize_max_height:900,
            autoresize_min_height: 100,
            resize:false,
            default_link_target: "_blank",
            file_picker_types: 'image',
            link_default_protocol: "https", 
            statusbar: false,

            file_picker_callback: function(callback, value, meta) {
                if (meta.filetype == 'image') {
                    $('#upload').trigger('click');
                    $('#upload').on('change', function() {
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        callback(e.target.result, {
                        alt: ''
                        });
                    };
                    reader.readAsDataURL(file);
                    });
                }
            },

        };

        tinymce.init(editor_config);

        function actualizar()
        {
            var contenido = tinymce.get("editor").getContent();
            Livewire.emit('actualizar', contenido);
        }

        Livewire.on('updateDescripcion', content => {
            tinyMCE.get("editor").setContent(content);
            var contenido = tinymce.get("editor").getContent();
            Livewire.emit('actualizar', contenido);
        });

        Livewire.on('wipeContent', content => {
            tinyMCE.get("editor").setContent('');
        });
        
    </script>
</div>
