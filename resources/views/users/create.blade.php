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
                        <div>
                            <div class="grid grid-rows-2 gap-2">
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <x-label for="first_name" :value="__('First Name')" />
                                        <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                                            placeholder="First Name" value="{{ old('first_name') }}" autofocus />
                                    </div>
                                    <div>
                                        <x-label for="last_name" :value="__('Last Name')" />
                                        <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                                            placeholder="Last name" :value="old('last_name')" />
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <x-label for="serial_number" :value="__('Serial Number')" />
                                        <x-input id="serial_number" class="block mt-1 w-full" type="number"
                                            name="serial_number" placeholder="Serial Number"
                                            :value="old('serial_number')" />
                                    </div>
                                    <div>
                                        <x-label for="email" :value="__('Email')" />
                                        <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                            placeholder="Email" :value="old('email')" />
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <x-label for="roles" :value="__('Role')" />
                                        <x-multi-select-dropdown placeholder="Select Roles" name="roles[]">
                                            @foreach ($roles as $role)
                                            <option value="{{ $role }}" {{ in_array($role,old('roles') ?? []) ? 'selected' : '' }}>
                                                {{$role }}
                                            </option>
                                            @endforeach
                                        </x-multi-select-dropdown>
                                    </div>
                                    <div>
                                        <x-label for="spec" :value="__('Specialization')" />
                                        <x-select name="spec" id="spec" class="capitalize block mt-1 w-full">
                                            @foreach ($specs as $spec)
                                            <option class="capitalize" value="{{ $spec->value }}" {{ $spec->value ==
                                                old('spec') ? 'selected' : '' }}>{{ $spec->value }}
                                            </option>
                                            @endforeach
                                        </x-select>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
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