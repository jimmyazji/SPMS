<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-end justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $project->title }}
            </h2>
            <div class="mt-2 md:mt-0">
                <form method="POST" action="{{route('projects.destroy', $project->id)}}">
                    @csrf
                    @method('DELETE')
                    <x-modal>
                        <x-slot name="trigger">
                            <x-button type="button" class="bg-red-600 hover:bg-red-500" @click="showModal = true"
                                value="Click Here">Delete Project</x-button>
                        </x-slot>
                        <x-slot name="title">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Delete Project
                            </h3>
                        </x-slot>
                        <x-slot name="content">
                            <p class="text-sm text-gray-500">
                                Are you sure you want to delete the {{ $project->title }}? All of its
                                data will be permanently removed. This action cannot be undone.
                            </p>
                        </x-slot>
                    </x-modal>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-4 lg:py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('projects.update',$project->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="md:grid md:grid-cols-2 gap-6">
                            <div>
                                <x-label for="title" :value="__('Project Title')" />
                                <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                                    placeholder="Title" value="{{ $project->title }}" required />
                            </div>
                            <div class="mt-4 md:mt-0">
                                <x-label for="type" :value="__('Project Type')" />
                                <select name="type"
                                    class="block mt-1 rounded-md shadow-sm text-sm text-gray-800 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
                                    id="type">
                                    <option value="">Select Type</option>
                                    <option value="Senior Project"
                                        {{"Senior Project" ==  $project->type  ? 'selected' : '' }}>Senior Project
                                    </option>
                                    <option value="Graduation Project"
                                        {{"Graduation Project" ==  $project->type  ? 'selected' : '' }}>Graduation
                                        Project</option>
                                </select>
                            </div>

                            <div class="mt-4 md:mt-0 col-span-2">
                                <x-label for="description" :value="__('Description')" />
                                <textarea name="description" placeholder="Description..." id="description" cols="40"
                                    rows="10"
                                    class="w-full block mt-1 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring
                                focus:ring-indigo-200 focus:ring-opacity-50 text-sm text-gray-800">{{ $project->description }}</textarea>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row items-center justify-between mt-4">
                            <label class="inline-flex items-center">
                                <input id="supervise" type="checkbox" name="supervise" value="supervise"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-600">
                                    I will supervise this project
                                </span>
                            </label>
                            <div class="mt-4 md:mt-0 flex items-center">
                                <x-button >{{ __('Update') }}</x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>