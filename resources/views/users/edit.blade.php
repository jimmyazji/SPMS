<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit User') }}
            </h2>
            <form method="POST" action="{{route('users.destroy', $user->id)}}">
                @csrf
                @method('DELETE')
                <x-delete-modal>
                    <x-slot name="trigger">
                        <x-button type="button" class="bg-red-600 hover:bg-red-500" @click="showModal = true"
                            value="Click Here">Delete User</x-button>
                    </x-slot>
                    <x-slot name="title">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Delete User
                        </h3>
                    </x-slot>
                    <x-slot name="content">
                        <p class="text-sm text-gray-500">
                            Are you sure you want to delete {{ $user->first_name }}'s account? All of their
                            data will be permanently removed. This action cannot be undone.
                        </p>
                    </x-slot>
                </x-delete-modal>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('users.update',$user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-row-2 gap-6 mt-4">
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <x-label for="first_name" :value="__('First Name')" />
                                    <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                                        placeholder="First name" value="{{ $user->first_name }}" autofocus />
                                </div>
                                <div>
                                    <x-label for="last_name" :value="__('Last Name')" />
                                    <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                                        placeholder="Last name" value="{{ $user->last_name }}" autofocus />
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-row-2 gap-6 mt-4">
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <x-label for="serial_number" :value="__('Serial Number')" />
                                    <x-input id="serial_number" class="block mt-1 w-full" type="number" min="1000000"
                                        placeholder="Serial Number" name="serial_number" value="{{ $user->stdsn }}"
                                        autofocus />
                                </div>
                                <div>
                                    <x-label for="email" :value="__('Email')" />
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                        placeholder="Email" value="{{ $user->email }}" />
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-row-2 gap-6 mt-4">
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <x-label for="department" :value="__('Department')" />
                                    <select id="department" name="department"
                                        class="block mt-1 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">
                                        <option value="">Select Department</option>
                                        @foreach ($depts as $dept)
                                        <option value="{{ $dept->id }}"
                                            {{ $dept->id ==  $user->dept_id  ? 'selected' : '' }}>
                                            {{ $dept->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <x-label for="roles" :value="__('Role')" />
                                    <x-select-dropdown>
                                        <x-slot name="trigger">
                                            <button type="button"
                                                class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring focus:ring-indigo-300 focus:border-indigo-300 focus:ring-opacity-50">
                                                Roles
                                                <span
                                                    class="ml-3 absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                                    <svg class="h-5 w-5 text-gray-400"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </x-slot>
                                        @foreach($roles as $role)
                                        <x-dropdown-option>
                                            <div class="flex items-center">
                                                <span class="block truncate">
                                                    {{ $role }}
                                                </span>
                                            </div>
                                        </x-dropdown-option>
                                        @endforeach
                                    </x-select-dropdown>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-row-2 gap-6 mt-4">
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <x-label for="password" :value="__('New password')" />
                                    <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                                        placeholder="Enter Password" />
                                </div>
                                <div>
                                    <x-label for="confirm-password" :value="__('Confirm password')" />
                                    <x-input id="confirm_password" class="block mt-1 w-full" type="password"
                                        placeholder="Repeat Password" name="confirm-password" />
                                </div>

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