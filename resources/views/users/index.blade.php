<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
            <div>
                <div class="flex flex-col md:flex-row container items-center">
                    <div class="relative mt-2 md:mt-0">
                        <form action="{{ route('users.index') }}" method="GET" role="search">
                            <x-input name="search" id="search" type="text"
                                class="rounded-full w-60 md:w-96 px-4 py-2 mr-6 pl-8 text-sm" placeholder="Search"
                                value="{{ request('search') }}" />
                            <div class="absolute top-0">
                                <svg class="fill-current text-gray-500 mt-3.5 ml-4 w-3 h-3"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 92 92">
                                    <path
                                        d="M57.8 2.2c-17.1 0-31 14.1-31 31.3 0 7.3 2.5 13.9 6.6 19.3L4 82.6a4.53 4.53 0 000 6.3c.9.9 2 1.3 3.1 1.3 1.2 0 2.3-.4 3.2-1.3l29.4-29.8c5.1 3.7 11.3 5.8 18 5.8 17.1 0 31-14.1 31-31.3S74.9 2.2 57.8 2.2zm0 54.8c-12.7 0-23-10.5-23-23.4 0-12.9 10.3-23.4 23-23.4s23 10.5 23 23.4c0 12.9-10.3 23.4-23 23.4zm15.5-23c-.2 1.7-1.7 3-3.4 3h-.5c-1.9-.3-3.2-2-3-3.9.7-5.2-5.1-7.9-5.4-8-1.7-.8-2.5-2.9-1.7-4.6s2.8-2.5 4.6-1.8c.4.1 10.8 4.9 9.4 15.3zM66 41.6c.7.7 1.2 1.8 1.2 2.8 0 1.1-.4 2.1-1.2 2.8-.7.7-1.8 1.2-2.8 1.2-1 0-2.1-.4-2.8-1.2a4.2 4.2 0 01-1.2-2.8c0-1 .4-2.1 1.2-2.8.7-.7 1.8-1.2 2.8-1.2 1 0 2 .4 2.8 1.2z" />
                                </svg>
                            </div>
                        </form>
                    </div>
                    <div class="flex flex-col md:flex-row container mt-3 md:mt-0">
                        <a href="{{ route('users.create') }}">
                            <x-button type="button">
                                {{ __('Create New User') }}
                            </x-button>
                        </a>
                    </div>
                </div>
            </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <x-flash-message />
                        <div class="shadow-lg overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bald text-gray-500 uppercase tracking-wider">
                                            User
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bald text-gray-500 uppercase tracking-wider">
                                            Department
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-bald text-gray-500 uppercase tracking-wider">
                                            Roles
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="flex items-center">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <a href="{{ route('users.show',$user->id) }}">
                                                            <img class="h-10 w-10 rounded-full border border-gray-300"
                                                                src="/uploads/avatars/{{ $user->avatar }}"
                                                                alt="profile">
                                                        </a>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            <a href="{{ route('users.show',$user->id) }}">{{ $user->first_name }}
                                                                {{ $user->last_name }}</a>
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            <a
                                                                href="{{ route('users.show',$user->id) }}">{{ $user->email }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="flex items-center">
                                                <div class="">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $user->dept->name }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ $user->stdsn }}
                                                    </div>
                                                </div>
                                            </div>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">
                                            @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $v)
                                            <label class=" px-2 py-0.5 bg-gray-100 rounded-full border border-gray-300">{{ $v }}</label>
                                            @endforeach
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('users.edit',$user->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">

                                            No Results found
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-4">
                        {!! $users->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>