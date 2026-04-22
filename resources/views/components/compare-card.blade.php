@props(['number', 'title', 'before', 'after'])

<div class="flex-none w-[350px] md:w-[450px] snap-center group" x-data="{ sliderPos: 50 }">
    <div class="relative aspect-[3/4] overflow-hidden bg-gray-100 rounded-sm shadow-md border border-gray-200">

        <img src="{{ $after }}" class="absolute inset-0 w-full h-full object-cover">

        <div class="absolute inset-0 overflow-hidden border-r border-white/50"
             :style="`width: ${sliderPos}%` ">
            <img src="{{ $before }}" class="absolute inset-0 w-[350px] md:w-[450px] h-full object-cover max-w-none">
        </div>

        <input type="range" min="0" max="100" x-model="sliderPos"
               class="absolute inset-0 w-full h-full opacity-0 cursor-ew-resize z-30">

        <div class="absolute top-0 bottom-0 w-px bg-white/40 z-20 pointer-events-none"
             :style="`left: ${sliderPos}%` ">
        </div>
    </div>
</div>
