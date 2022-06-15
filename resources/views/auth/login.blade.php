<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-40 h-40 fill-current text-gray-400" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-flash-message class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    placeholder="Email" required autofocus />
            </div>

            <!-- Password -->
            <div x-data="{ show: true }" class="mt-4">
                <x-label for="password" :value="__('Password')" />
                <div class="flex">
                    <x-input id="password" class="mt-1 w-full rounded-r-none" x-bind:type="show ? 'password' : 'text'" name="password"
                        placeholder="Password" required autocomplete="current-password" />
                    <span @click.prevent="show = !show" class="rounded-r-md h-10 mt-1 w-12 bg-gray-800 flex justify-center items-center text-gray-100"> <i class="fa" x-bind:class="show ? 'fa-eye' : 'fa-eye-slash'"></i></span>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4 space-x-2">
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif
            </div>
            <div class="block space-y-2 mt-2">
                <x-button class="block w-full justify-center">
                    Log in <i class="fas fa-sign-in-alt ml-2"></i>
                </x-button>
                <a class="flex justify-center items-center w-full py-2 bg-gray-800 border border-transparent rounded-md font-bold text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 text-sm"
                    href="{{ url('auth/github') }}">Log in <i class="fab fa-github ml-2"></i></a>
            </div>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>