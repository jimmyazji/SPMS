<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-flash-message />
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <article class="min-w-full p-6 bg-white border-b">
                    <h2>You're logged in!</h2>
                </article>
            </div>
        </div>
    </div>
</x-app-layout>