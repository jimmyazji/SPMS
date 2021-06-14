<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @forelse ($notifications as $notification)
                    <a href="{{ route('users.show',$notification->data['user']['id']) }}">
                        <div
                            class="mt-1 flex justify-between items-center p-4 rounded-lg border border-gray-300 @if(!$notification->read_at) bg-gray-100 @endif">
                            <div class="text-xs text-gray-800 flex flex-row">
                                <img class="h-10 w-10 rounded-full border border-gray-300"
                                    src="/uploads/avatars/{{ $notification->data['user']['avatar'] }}" alt="profile">
                                <div class="ml-2 flex items-center text-indigo-700">
                                    {{ $notification->data['user']['first_name'] }}
                                    {{ $notification->data['user']['last_name'] }}
                                    <div class="text-gray-700 ml-1">
                                        {{ __('Just Registered')}}
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col items-end text-xs text-gray-600">
                                <svg class="fill-current h-4 w-4" role="button" viewBox="0 0 20 20">
                                    <path d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0
                                    c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183
                                    l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15
                                    C14.817,13.62,14.817,14.38,14.348,14.849z" />
                                </svg>
                                <div class="flex flex-row">
                                    {{ $notification->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="text-gray-800">
                        There are no new notifications
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>