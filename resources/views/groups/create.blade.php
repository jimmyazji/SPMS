<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Group') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg sm:rounded-lg">
                <div class="rounded-lg p-6 bg-white border-b border-gray-200">
                    <x-flash-message class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('groups.store') }}">
                        @csrf
                        <div>
                            <div class="grid grid-row-3 gap-6 mt-4">
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <x-label for="state" :value="__('Group State')" />
                                        <x-select id="state" name="state" class="capitalize mt-1 block w-full">
                                            @foreach ($states as $state)
                                            <option class="capitalize" value="{{ $state->value }}">{{ $state->value }}
                                            </option>
                                            @endforeach
                                        </x-select>
                                    </div>
                                    <div>
                                        <x-label for="spec" :value="__('Group\'s Specialization')" />
                                        <x-select id="spec" name="spec" class="capitalize mt-1 block w-full">
                                            @foreach($specs as $spec)
                                            <option class="capitalize" value="{{ $spec->value }}" @selected($spec->value == old('spec'))>{{ $spec->value }}
                                            </option>
                                            @endforeach
                                        </x-select>
                                    </div>
                                    <div>
                                        <x-label for="invited" :value="__('Invite Members')" />
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
                                        <x-select id="project_type" name="project_type" class="capitalize mt-1 block w-full">
                                            @foreach ($project_types as $type)
                                            <option class="capitalize" value="{{ $type->value }}">{{ $type->value }}
                                            </option>
                                            @endforeach
                                        </x-select>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-button type="submit">
                                    {{ __('Create') }}
                                </x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>