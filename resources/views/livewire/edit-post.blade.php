<div x-data="{ open: false }"
    x-show="open"
    @open-dropdown.window="if ($event.detail.id == 2) open = true"
    
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
            <button wire:click="closeEdit" @click="open = false" onclick="allowScroll()" type="button" class="absolute right-2 self-center mx-2 my-1 md:mx-0 inline-flex justify-center py-2 px-3 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <em class="fas fa-times"></em>
            </button>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2 md:border-r-2 md:border-b-0 border-b-2 @if(empty($this->idPost)) hidden @endif" wire:loading.class="hidden" wire:target="edit, idPost">
            <div class="w-full">
                @if (session()->has('update'))
                    <div class="max-w-full w-full px-4 mt-2">
                        <div class="w-full bg-green-500 px-4 py-4 rounded text-white text-lg font-bold">
                            {{ session('update') }}
                        </div>
                    </div>
                @endif
            </div>
            <form wire:submit.prevent="update(Object.fromEntries(new FormData($event.target)))">
                @csrf
                <div class="border-gray-200 sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                Imagen
                                </label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        @if (!empty($photo))
                                            <img class="mx-auto h-12 w-12" src="{{ $photo->temporaryUrl() }}" alt="">
                                        @elseif(!empty($this->imagen))
                                            <img class="mx-auto h-12 w-12" src="{{ asset('img/'.$this->imagen) }}" alt="">
                                        @else
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        @endif
                                        <div class="flex text-sm text-gray-600 justify-center">
                                            <label for="photo2" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span>Upload a file</span>
                                                <input id="photo2" name="photo2" type="file" class="sr-only" wire:model="photo">
                                            </label>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            PNG, JPG, GIF up to 10MB
                                        </p>
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
                        <div>
                            <label for="editor" class="block text-sm font-medium text-gray-700">
                                Descripción
                            </label>
                            <div wire:key="8927349824">
                                <div class="mt-1" wire:ignore>
                                    <textarea id="edit" name="edit" rows="3" class="edit shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
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
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Editar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="justify-center flex @if(!empty($this->idPost)) hidden @endif w-full">
            <div class="lds-ellipsis">
                <div></div><div></div><div></div><div></div>
            </div>
        </div>
        <script wire:ignore>
            var editor_config_edit = {
                menubar: false,
                branding: false,
                selector: "textarea.edit",
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
                        var contenido = tinyMCE.get("edit").getContent();
                        Livewire.emit('actualizarEdit', contenido);
                    });
                    ed.on('keyup', function(e) {
                        var contenido = tinyMCE.get("edit").getContent();
                        Livewire.emit('actualizarEdit', contenido);
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
    
            tinymce.init(editor_config_edit);
            function actualizarEdit()
            {
                var contenido = tinymce.get("edit").getContent();
                Livewire.emit('actualizarEdit', contenido);
            }
    
            Livewire.on('updateDescripcionEdit', content => {
                tinyMCE.get('edit').setContent(content);
                var contenido = tinymce.get("edit").getContent();
                Livewire.emit('actualizarEdit', contenido);
            });
    
            Livewire.on('wipeContentEdit', content => {
                tinyMCE.get('edit').setContent('');
            });
            
        </script>
    </div>
</div>
