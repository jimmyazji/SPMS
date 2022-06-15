@props(['action'=> Route::current()->uri])
<form id="search" action="{{ $action }}" method="GET" role="search">
    {{ $slot }}
    <x-input name="search" id="search" type="text" class="w-[95vw] md:w-60 p-4 pl-8" placeholder="Search..."
        value="{{ request('search') }}" />
    <div class="absolute top-3 transform translate-y-0.5 left-3">
        <i class="fa fa-search text-xs text-gray-400"></i>
    </div>
</form>