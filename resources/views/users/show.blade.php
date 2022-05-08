<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Profile') }}
        </h2>
        @can('user-edit')
        <a href="{{ route('users.edit',$user->id) }}" class="flex justify-end">
            <x-button type="button">
                {{ __('Edit User') }}
            </x-button>
        </a>
        @endcan
    </x-slot>
    <div class="py-12 flex flex-col md:flex-row container justify-center gap-6">
        <div class="max-w-6xl">
            <div class="bg-white overflow-hidden shadow-lg rounded-3xl">
                <div class="p-6 bg-white border-b border-gray-200">
                    <img src="/uploads/avatars/{{ $user->avatar }}"
                        class="w-full md:h-96 md:w-96 rounded-full border-2 border-gray-300">
                    <div class="flex flex-col md:flex-row container justify-between border-b border-gray-300 py-4">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2 flex items-center">
                            {{ $user->first_name }} {{ $user->last_name }}
                        </h2>
                        <div class="text-sm text-gray-500 mt-3 md:ml-4">
                            <div class="container flex flex-row justify-between md:w-40">
                                <div>
                                    Last login
                                </div>
                                <div>
                                    @if($user->last_login_at)
                                    {{ $user->last_login_at->diffForHumans() }}
                                    @else
                                    never
                                    @endif
                                </div>
                            </div>
                            <div class="container flex flex-row justify-between md:w-40">
                                <div>
                                    From IP
                                </div>
                                <div>
                                    @if($user->last_login_ip)
                                    {{ $user->last_login_ip }}
                                    @else
                                    never
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row container justify-between border-b border-gray-300 text-sm py-4">
                        <div class="text-gray-600">
                            {{ $user->email }}
                        </div>
                        <div class="text-gray-600">
                            {{ $user->stdsn }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-center justify-start">
            <div class="max-w-6xl w-full md:w-96">
                <div class="bg-white overflow-hidden shadow-lg rounded-3xl">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2 flex items-center">
                            {{ __('Groups') }}
                        </h2>
                        <div class="flex flex-row justify-between py-4 border-b border-gray-300">
                            <div class="text-sm text-gray-800">
                                Current group
                            </div>
                            <div class="text-sm text-gray-500">
                                @if($user->group)
                                <a href="{{ route('groups.show',$user->group_id) }}">#{{ $user->group->id }}</a>
                                @else
                                None yet
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-6xl w-full md:w-96 mt-4">
                <div class="bg-white overflow-hidden shadow-lg rounded-3xl">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2 flex items-center">
                            {{ __('Projects') }}
                        </h2>
                        <div class="flex flex-row justify-between py-4 border-b border-gray-300">
                            <div class="text-sm text-gray-800">
                                Current project
                            </div>
                            <div class="text-sm text-gray-500">
                                @if($user->group)
                                @if ($user->group->project)
                                <a href="{{ route('projects.show',$user->group->project_id) }}">
                                    {{ $user->group->project->title }}
                                </a>
                                @else
                                None yet
                                @endif
                                @else
                                None yet
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-6xl w-full md:w-96 mt-4">
                <div class="bg-white overflow-hidden shadow-lg rounded-3xl">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2 flex items-center">
                            {{ __('Roles') }}
                        </h2>
                        <div class="flex flex-row justify-between py-4 border-b border-gray-300">
                            <div class="text-sm text-gray-800">
                                Roles
                            </div>
                            <div class="text-sm items-end text-gray-500">
                                @forelse($user->getRoleNames() as $roles)
                                {{ $roles }}
                                @empty
                                None yet
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>