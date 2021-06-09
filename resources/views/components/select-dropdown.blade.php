@props(['trigger'])
<div class="relative mt-1" x-data="{ show:false }">
    <div @click="show = !show" @keydown.escape="show = false" @click.away="show = false">
        {{ $trigger }}
    </div>
    <ul x-show="show" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-24 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
        style="display: none">
        {{ $slot }}
    </ul>
</div>
<script>

</script>