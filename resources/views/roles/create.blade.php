<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Role') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message />
                    <form method="POST" action="{{ route('roles.store') }}">
                        @csrf
                        <div class="ml-2 mt-2">
                            <div>
                                <x-label for="name" class="text-lg" :value="__('Role Name')" />
                                <x-input id="name" class="w-full block mt-3 font-size-small" type="text" name="name"
                                    placeholder="Name" autofocus />
                            </div>
                            <div class="mt-3">
                                <x-label for="permissions" class="text-lg" :value="__('Role Permissions')" />
                                @foreach($permissions->chunk(3) as $chunk)
                                <div class="grid grid-row-3 gap-2 mt-4">
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                                        @foreach ($chunk as $permission)
                                        <div>
                                            <label class="inline-flex items-center">
                                                <input id="permission[]" type="checkbox" name="permission[]"
                                                    value="{{ $permission->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm
                                                focus:border-indigo-300 focus:ring focus:ring-indigo-200
                                                focus:ring-opacity-50">
                                                <span
                                                    class="ml-2 text-sm text-gray-600">{{ ($permission->name) }}</span>
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endforeach
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <x-button>
                                        Create Role
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>