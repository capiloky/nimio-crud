<div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
        <div>
            <div class="px-1 md:px-0">
                <div class="flex">

                    @livewire('form')

                    @if(count($this->keys) > 0)
                        <div x-data="{id: 6}">
                            <button @click="$dispatch('open-dropdown',{id})" onclick="disallowScroll()" type="button" class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                <span class="self-center"><em class="far fa-trash-alt"></em> Borrado masivo</span>
                            </button>
                        </div>
                        <button wire:click="restoreCheck" type="button" class="ml-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <span class="self-center"><em class="fas fa-trash-restore"></em> Restaurado masivo</span>
                        </button>
                    @endif
                    <button wire:click="reload" type="button" class="inline-flex justify-center ml-2 py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-400 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <span class="self-center"><em class="fas fa-sync-alt"></em> Recargar</span>
                    </button>
                </div>

                <div class="text-black pt-3 md:flex items-center w-full relative mb-4">
                    @include('includes.dropdown-date')
                    
                    @include('includes.dropdown-per-page')

                    @include('includes.input-group-search')

                </div>

            </div>
        </div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div>
                            <table class="min-w-full divide-y divide-gray-200">

                                @include('includes.thead-table-posts')

                                @include('includes.tbody-table-posts')

                            </table>

                            <div class="justify-center flex w-full flex hidden" wire:loading.remove.class="hidden" wire:target="reload, q, order, orderBy">
                                <div class="lds-ellipsis">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div> 

                            @if(count($posts) == 0)
                                <div class="justify-center flex w-full flex grid grid-col-1" wire:loading.class="hidden">
                                    <div class="my-4 h-24 flex justify-center">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="telescope" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="svg-inline--fa fa-telescope h-full" style="--fa-secondary-color:#fa5252; --fa-secondary-opacity:1.0;">
                                            <g class="fa-group">
                                                <path fill="currentColor" d="M263.3594,347.79914,136.3008,391.44163c-8.7539,3.00781-18.05078-.69335-21.26953-8.46678l-8.74219-21.10738L42.17971,388.42211A15.99837,15.99837,0,0,1,21.27737,379.762L1.21877,331.34018a16.00653,16.00653,0,0,1,8.66406-20.90425L73.9844,283.88129,65.24221,262.772c-3.21875-7.77342.73828-16.96481,9.05469-21.02925L380.4219,92.1336l78.125,188.62074-66.60157,22.87691a71.98089,71.98089,0,0,0-143.96093.36914A71.08619,71.08619,0,0,0,263.3594,347.79914Z" class="fa-secondary"></path>
                                                <path fill="currentColor" d="M638.77737,216.83064,553.06252,9.88181a15.99836,15.99836,0,0,0-20.90234-8.66014L414.84377,49.81923a15.99639,15.99639,0,0,0-8.65625,20.90426l85.71094,206.94883a16.00274,16.00274,0,0,0,20.90625,8.66014l117.3125-48.59757A15.99819,15.99819,0,0,0,638.77737,216.83064ZM376.13283,348.50812a71.27481,71.27481,0,0,0,15.85157-44.50773,72,72,0,0,0-144,0,71.27859,71.27859,0,0,0,15.87109,44.53507l-47.46484,142.404A16.00061,16.00061,0,0,0,231.57033,512h16.85938a16.00416,16.00416,0,0,0,15.17969-10.94139l42.16406-126.49585a71.05048,71.05048,0,0,0,28.44922-.002l42.168,126.4978A16.00046,16.00046,0,0,0,391.57033,512h16.85938a16.00062,16.00062,0,0,0,15.17969-21.06051ZM319.9844,328.00035a24,24,0,1,1,24-24A24.03627,24.03627,0,0,1,319.9844,328.00035Z" class="fa-primary"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div>
                                        <h1 class="mt-0 mb-6"><span class="db f4 fw6 mb-2">
                                            <span>Miramos arriba y abajo, pero…</span> 
                                            <span class="f7 f8-ns db fw6 danger6">No hay nada!</span>
                                        </h1>
                                    </div>
                                </div>
                            @endif

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

    <x-modal-delete/>
</div>