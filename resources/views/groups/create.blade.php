<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Group') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('groups.store') }}">
                        @csrf
                        <div class="grid grid-row-3 gap-6 mt-4">
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <x-label for="status" :value="__('Select Status')" />
                                    <select id="status" name="status"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm">
                                        <option selected disabled value="">Select Status</option>
                                        <option value="Looking for members">Looking for members</option>
                                        <option value="Requesting supervisor">Requesting supervisor</option>
                                        <option value="Full">Full</option>
                                    </select>
                                </div>
                                <div>
                                    <x-label for="project" :value="__('Project')" />
                                    <select id="project" name="project"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm">
                                        <option selected disabled value="">Select project</option>
                                        @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div>
                                <x-label for="invite_members" :value="__('Invite Members')" />
                                <select id="invite_members" name="invite_members"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm">
                                    <option selected disabled>Invite members</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
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
