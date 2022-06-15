<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="flex flex-row items-end justfiy-center">
                            <img src="/uploads/avatars/{{ $user->avatar }}" class="h-36 w-36 rounded-full border-2 border-gray-300">
                            <div class="ml-4 tracking-tight font-semibold text-xl ">
                                <div>
                                <label class="image">
                                    <span class="mt-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                        Select a file
                                    </span>
                                    <input type="file" id="image" name="image" class="hidden" />
                                </label>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-row-3 gap-6 mt-4">
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <x-label for="first_name" :value="__('First Name')" />
                                    <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                                        placeholder="First Name"
                                        value="{{ auth()->user()->first_name }}" autofocus />
                                </div>
                                <div>
                                    <x-label for="last_name" :value="__('Last Name')" />
                                    <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                                        placeholder="Last Name"
                                        value="{{ auth()->user()->last_name }}" />
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <x-label for="stdsn" :value="__('Serial Number')" />
                                    <x-input id="stdsn" class="block mt-1 w-full" type="text" name="stdsn"
                                        placeholder="Serial Number"
                                        value="{{ auth()->user()->stdsn }}" :disabled="true" />
                                </div>
                                <div>
                                    <x-label for="email" :value="__('Email')" />
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                        placeholder="Email"
                                        value="{{ auth()->user()->email }}" />
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <x-label for="new_password" :value="__('New password')" />
                                    <x-input id="new_password" class="block mt-1 w-full" type="password" name="password"
                                        placeholder="Enter Password"
                                        autocomplete="new-password" />
                                </div>
                                <div>
                                    <x-label for="confirm_password" :value="__('Confirm password')" />
                                    <x-input id="confirm_password" class="block mt-1 w-full" type="password"
                                        placeholder="Repeat Password"
                                        name="password_confirmation" autocomplete="confirm-password" />
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
