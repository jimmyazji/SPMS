<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Role') }}
        </h2>
        <form method="POST" action="{{ route('roles.destroy',$role->id) }}">
            @csrf
            @method('DELETE')
            <x-modal>
                <x-slot name="trigger">
                    <x-button type="button" class="bg-red-600 hover:bg-red-500" @click.prevent="showModal = true"
                        value="Click Here">Delete Role</x-button>
                </x-slot>
                <x-slot name="title">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        Delete Role
                    </h3>
                </x-slot>
                <x-slot name="content">
                    <p class="text-sm text-gray-500">
                        Are you sure you want to delete {{ $role->name }} Role? This action cannot be undone.
                    </p>
                </x-slot>
            </x-modal>
        </form>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('roles.update',$role->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="ml-2 mt-2">
                            <div>
                                <x-label for="name" class="text-lg" :value="__('Role Name')" />
                                <x-input id="name" class="w-full block mt-3 font-size-small" type="text" name="name"
                                    value="{{ $role->name }}" />
                            </div>
                            <div class="mt-3">
                                <x-label for="permission" class="text-lg" :value="__('Role Permissons')" />
                                @foreach($permissions->chunk(3) as $chunk)
                                <div class="grid grid-row-3 gap-2 mt-4">
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                                        @foreach ($chunk as $permission)
                                        <div>
                                            <label class="inline-flex items-center mt-2">
                                                <input name="permission[]" type="checkbox" value="{{ $permission->id }}"
                                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                    {{ in_array($permission->id,$rolePermissions) ? 'checked' : '' }}>
                                                <span class="ml-2 text-sm text-gray-600">{{ ($permission->name) }}
                                                </span>
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endforeach
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <x-button type="submit">
                                        Update
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