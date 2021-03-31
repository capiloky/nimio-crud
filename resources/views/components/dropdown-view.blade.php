@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white', 'dropdownClasses' => ''])

@php
switch ($align) {
    case 'left':
        $alignmentClasses = 'origin-top-left left-0';
        break;
    case 'top':
        $alignmentClasses = 'origin-top';
        break;
    case 'none':
    case 'false':
        $alignmentClasses = '';
        break;
    case 'right':
    default:
        $alignmentClasses = 'origin-top-right right-0';
        break;
}

switch ($width) {
    case '48':
        $width = 'w-48';
        break;
}
@endphp

<div class="relative" x-data="{ open: false }">
    <div @click="open = ! open" onclick="disallowScroll()">
        {{ $trigger }}
    </div>

    <div x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="fixed flex w-screen h-screen inset-0 z-50 bg-gray-900 bg-opacity-25"
        style="display: none;">

        <div class="self-center ring-1 ring-black ring-opacity-5 max-w-screen overflow-y-auto max-h-screen max-w-screen w-screen md:w-full h-screen md:h-full mx-auto shadow-xl bg-white">
            {{ $content }}
        </div>

    </div>
</div>