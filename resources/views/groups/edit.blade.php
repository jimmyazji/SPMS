<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Group') }} #{{ $group->id }}
        </h2>
        @can('destroy',$group)
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
        @endcan
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg">
                <div class="rounded-lg p-6 bg-white border-b border-gray-200">
                    <x-flash-message class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('groups.update',$group->id) }}">
                        @method('PUT')
                        @csrf
                        <div>
                            <div class="grid grid-row-3 gap-6 mt-4">
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <x-label for="state" :value="__('Group State')" />
                                        <select id="state" name="state"
                                            class="capitalize mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm">
                                            @foreach ($states as $state)
                                            <option @selected($state==$group->state) class="capitalize" value="{{
                                                $state->value }}">{{ $state->value }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <x-label for="spec" :value="__('Group\'s Specialization')" />
                                        <select id="spec" name="spec"
                                            class="capitalize mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm">
                                            @foreach($specs as $spec)
                                            <option @selected($spec==$group->spec) class="capitalize" value="{{
                                                $spec->value }}">{{ $spec->value }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <x-label for="invite_members" :value="__('Invite Members')" />
                                        <x-multi-select-dropdown placeholder="Invite Members" name="invited"
                                            class="p-1 mt-1">
                                            <x-slot name="options">
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}
                                                </option>
                                                @endforeach
                                            </x-slot>
                                        </x-multi-select-dropdown>
                                    </div>
                                    <div>
                                        <x-label for="project_type" :value="__('Project Type')" />
                                        <select id="project_type" name="project_type"
                                            class="capitalize mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm">
                                            @foreach($project_types as $type)
                                            <option @selected($spec==$group->project_type) class="capitalize" value="{{
                                                $type->value }}">{{ $type->value }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-3">
                                    {{ __('Update') }}
                                </x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>