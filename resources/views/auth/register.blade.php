<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-32 h-32 fill-current text-gray-400" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-flash-message class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="grid grid-row-2 gap-6 mt-2">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <x-label for="first_name" :value="__('First Name')" />

                        <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                            :value="old('first_name')" placeholder="First Name" required autofocus />
                    </div>
                    <div>
                        <x-label for="last_name" :value="__('Last Name')" />

                        <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                            :value="old('last_name')" placeholder="Last Name" required autofocus />
                    </div>
                </div>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    placeholder="Email" required />
            </div>
            <div class="grid grid-row-2 gap-6 mt-2">
                <div>
                    <x-label for="stdsn" :value="__('Serial Number')" />

                    <x-input id="serial_number" class="block mt-1 w-full" type="text" name="serial_number"
                        :value="old('serial_number')" placeholder="Serial Number" autofocus />
                </div>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    placeholder="Password" autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    placeholder="Confirm Password" name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>