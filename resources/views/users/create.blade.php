<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="grid grid-row-2 gap-6 mt-4">
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <x-label for="first_name" :value="__('First Name')" />
                                    <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                                        placeholder="First Name" :value="old('first_name')" required autofocus />
                                </div>
                                <div>
                                    <x-label for="last_name" :value="__('Last Name')" />
                                    <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                                        placeholder="Last name" :value="old('last_name')" required />
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-row-2 gap-6 mt-4">
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <x-label for="serial_number" :value="__('Serial Number')" />
                                    <x-input id="serial_number" class="block mt-1 w-full" type="number"
                                        name="serial_number" placeholder="Serial Number" :value="old('serial_number')"
                                        required />
                                </div>
                                <div>
                                    <x-label for="email" :value="__('Email')" />
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                        placeholder="Email" :value="old('email')" required />
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-row-2 gap-6 mt-4">
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <x-label for="department" :value="__('Department')" />
                                    <select id="department" name="department"
                                        class="block mt-1 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full text-sm text-gray-800">
                                        <option value="">Select Department</option>
                                        @foreach ($depts as $dept)
                                        <option value="{{ $dept->id }}"
                                            {{ $dept->id == old('department') ? 'selected' : '' }}>
                                            {{ $dept->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <x-label for="roles" :value="__('Role')" />
                                    <x-multi-select-dropdown>
                                        <x-slot name="options">
                                            @foreach ($roles as $role)
                                            <option value="{{ $role }}" {{ $role==old('roles') ? 'selected' : '' }}>
                                                {{ $role }}</option>
                                            @endforeach
                                        </x-slot>
                                    </x-multi-select-dropdown>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-row-2 gap-6">
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <x-label for="password" :value="__('New password')" />
                                    <x-input id="password" class="block mt-1 w-full" type="password"
                                        placeholder="Enter Password" name="password" />
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
                                {{ __('Create') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>