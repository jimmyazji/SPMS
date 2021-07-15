<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('projects.store') }}">
                        @csrf
                        <div class="grid grid-row-3 gap-6 mt-4">
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <x-label for="title" :value="__('Project Title')" />
                                    <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                                        placeholder="Project Title" :value="old('title')" required autofocus />
                                </div>
                                <div>
                                    <x-label for="type" :value="__('Project Type')" />
                                    <select name="type"
                                        class="block mt-1 text-sm text-gray-800 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
                                        id="type">
                                        <option value="">Select Type</option>
                                        <option value="Senior Project"
                                            {{ "Senior Project" == old('type') ? 'selected' : '' }}>Senior Project
                                        </option>
                                        <option value="Graduation Project"
                                            {{ "Graduation Project" == old('type') ? 'selected' : '' }}>Graduation
                                            Project</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <x-label for="description" :value="__('Description')" />
                                <textarea name="description" placeholder="Description..." id="description" cols="40"
                                    rows="10"
                                    class="w-full block mt-1 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring
                                focus:ring-indigo-200 text-sm text-gray-800 focus:ring-opacity-50">{{ old('description') }}</textarea>

                            </div>
                            <div class="flex items-center justify-between mt-2">
                                @if(auth()->user()->hasRole('Supervisor'))
                                <label class="inline-flex items-center">
                                    <input id="supervise" type="checkbox" name="supervise" value="supervise"
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-600">
                                        I will supervise this project
                                    </span>
                                </label>
                                @endif
                                <x-button class="ml-3">
                                    {{ __('Create') }}
                                </x-button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>