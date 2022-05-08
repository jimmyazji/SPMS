<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
        <a href="{{ route('users.create') }}">
            <x-button type="button">
                {{ __('Create New User') }}
            </x-button>
        </a>
    </x-slot>
    <div class="flex justify-center py-6">
        <div class="relative mt-2 md:mt-0">
            <x-search/>
        </div>
    </div>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
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
                                        ID
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-bald text-gray-500 uppercase tracking-wider">
                                        Specialization
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
                                                            src="/uploads/avatars/{{ $user->avatar }}" alt="profile">
                                                    </a>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <a href="{{ route('users.show',$user->id) }}">{{
                                                            $user->first_name }}
                                                            {{ $user->last_name }}</a>
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        <a href="{{ route('users.show',$user->id) }}">{{
                                                            $user->email }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <div class="">
                                                <div class="text-sm font-medium text-gray-900">
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $user->stdsn }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="capitalize px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->spec->value }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">
                                        @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $v)
                                        <label class=" px-2 py-0.5 bg-gray-100 rounded-full border border-gray-300">{{
                                            $v }}</label>
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
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        No Results found
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="py-8">
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>