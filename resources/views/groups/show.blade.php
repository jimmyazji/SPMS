<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Group #{{ $group->id }}
        </h2>
    </x-slot>

    <div class="py-12 flex flex-col md:flex-row container justify-center gap-6">
        <div class="max-w-7xl">
            <div class="bg-white overflow-hidden shadow-lg rounded-3xl">
                <div class="p-8 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Group Members</h2>
                    @foreach ($group->users as $user)
                    <div
                        class="mt-2 bg-gray-50 px-2 py-2 w-72 rounded-lg border border-gray-300 hover:bg-gray-300 hover:border-gray-100">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <a href="{{ route('users.show',$user->id) }}">
                                    <img class="h-10 w-10 rounded-full border border-gray-300"
                                        src="/uploads/avatars/{{ $user->avatar }}" alt="profile">
                                </a>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    <a href="{{ route('users.show',$user->id) }}">{{ $user->first_name }}
                                        {{ $user->last_name }}</a>
                                </div>
                                <div class="text-sm text-gray-500">
                                    <a href="{{ route('users.show',$user->id) }}">{{ $user->email }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>