<div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false" >
    <button @click="open = ! open" type="button" class="relative w-full cursor-pointer bg-white border-2 border-transparent rounded-md shadow-lg pl-3 pr-14 py-2 text-left cursor-default focus:outline-none focus:ring-indigo-500 border-2 focus:border-indigo-500 focus:border-indigo-500 sm:text-sm" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
        {{ $trigger }}
    </button>
    <ul x-show="open"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="transform opacity-0 scale-95"
    x-transition:enter-end="transform opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-75"
    x-transition:leave-start="transform opacity-100 scale-100"
    x-transition:leave-end="transform opacity-0 scale-95" 
    class="absolute mt-1 w-full bg-white shadow-lg max-h-56 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm" tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3"
    >
        {{ $content }}
    </ul>
</div>