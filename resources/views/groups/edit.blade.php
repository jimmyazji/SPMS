<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Group') }} {{ $group->id }}
            </h2>
            <form method="POST" action="{{route('groups.destroy', $group->id)}}">
                @csrf
                @method('DELETE')
                <x-modal>
                    <x-slot name="trigger">
                        <x-button type="button" class="bg-red-600 hover:bg-red-500" @click="showModal = true"
                            value="Click Here">Delete Group</x-button>
                    </x-slot>
                    <x-slot name="title">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Delete Group
                        </h3>
                    </x-slot>
                    <x-slot name="content">
                        <p class="text-sm text-gray-500">
                            Are you sure you want to delete the #{{ $group->id }} group? All of its
                            data will be permanently removed. This action cannot be undone.
                        </p>
                    </x-slot>
                </x-modal>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('groups.update',$group->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="grid grid-row-3 gap-6 mt-4">
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <x-label for="status" :value="__('Select Status')" />
                                    <select id="status" name="status"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm">
                                        <option value="">Select Status</option>
                                        <option value="Looking for members"
                                            {{ $group->status ==  "Looking for members"  ? 'selected' : '' }}>Looking
                                            for members</option>
                                            <option value="Requesting Supervisor">Requesting supervisor</option>
                                        <option value="Full" {{ $group->status ==  "Full"  ? 'selected' : '' }}>Full
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <x-label for="project_id" :value="__('Project')" />
                                    <select id="project_id" name="project_id"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm">
                                        <option value="">Select project</option>
                                        @foreach($projects as $project)
                                        <option value="{{ $project->id }}"
                                            {{ $group->project_id ==  $project->id  ? 'selected' : '' }}>
                                            {{ $project->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div>
                                <x-label for="invite_members" :value="__('Invite Members')" />
                                <select id="invite_members" name="invite_members"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm">
                                    <option>Invite members</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
