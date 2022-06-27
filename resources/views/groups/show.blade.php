<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Group #{{ $group->id }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto">
        <x-flash-message />
    </div>
    <div class="py-12 flex flex-col md:flex-row justify-center mx-auto gap-6">
        <div class="max-w-7xl">
            <div class="bg-white overflow-hidden shadow-lg rounded-3xl">
                <div class="p-8 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Group Members</h2>
                    @foreach ($group->developers as $user)
                    <div
                        class="mt-2 bg-gray-50 px-2 py-2 md:w-72 rounded-lg border border-gray-300 hover:bg-gray-100 mx-auto">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <a href="{{ route('users.show',$user->id) }}">
                                    <img class="h-10 w-10 rounded-full border border-gray-300"
                                        src="/uploads/avatars/{{ $user->avatar }}" alt="profile">
                                </a>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    <a href="{{ route('users.show',$user->id) }}">{{ $user->name }}</a>
                                </div>
                                <div class="text-sm text-gray-500">
                                    <a href="{{ route('users.show',$user->id) }}">{{ $user->email }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @if(!$group->developers->contains(auth()->user()))
                    @if (count($requested) == 0)
                    @can('create',App\Models\GroupRequest::class)
                    <a href="{{ route('requests.store',$group->id) }}"
                        class="mt-2 py-2 bg-gray-50 px-2 flex justify-center rounded-lg font-semibold text-blue-700 border border-gray-300">Send
                        join request</a>
                    @else
                    <span
                        class="mt-2 py-2 bg-gray-50 px-2 flex justify-center rounded-lg font-semibold text-gray-500 hover:text-gray-700 cursor-pointer border border-gray-300">Send
                        join request</span>
                    @endcan
                    @else
                    <form method="POST" action="{{ route('requests.destroy',$group->id) }}">
                        @csrf
                        @method('DELETE')
                        <button
                            class="mt-2 px-2 py-2 w-full focus:outline-none bg-gray-50 flex justify-center rounded-lg font-semibold text-blue-700 border border-gray-300">Cancel
                            join request</button>
                    </form>

                    @endif
                    @else
                    <a href="{{ route('groups.leave',$group->id) }}">
                        <x-modal action="{{ __('Leave') }}" type="{{ __('button') }}">
                            <x-slot name="trigger">
                                <button @click.prevent="showModal = true"
                                    class="mt-2 px-2 py-2 w-full bg-red-50 flex justify-center rounded-lg font-semibold text-red-700 border border-red-700 hover:border-red-500 hover:text-red-500 focus:outline-none">
                                    Leave group
                                </button>
                            </x-slot>
                            <x-slot name="title">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Leave group
                                </h3>
                            </x-slot>
                            <x-slot name="content">
                                <p class="text-sm text-gray-500">
                                    Are you sure you want to leave this group? This action cannot be undone.
                                </p>
                            </x-slot>
                        </x-modal>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @if($group->developers->contains(auth()->user()))
        <div class="flex flex-col items-center ">
            <div class="max-w-7xl w-full">
                <div class="bg-white overflow-hidden shadow-lg rounded-3xl">
                    <div class="p-6 bg-white border-b border-gray-200 ">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2 mb-4 flex">
                            {{ __('Requests') }}
                        </h2>
                        @forelse($groupRequests as $groupRequest)
                        <div
                            class="flex mt-2 bg-gray-50 px-2 py-2 md:w-80 rounded-lg border border-gray-300 hover:bg-gray-100 justify-between items-center">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <a href="{{ route('users.show',$user->id) }}">
                                        <img class="h-10 w-10 rounded-full border border-gray-300"
                                            src="/uploads/avatars/{{ $groupRequest->sender->avatar }}" alt="profile">
                                    </a>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        <a href="{{ route('users.show',$groupRequest->sender->id) }}">{{
                                            $groupRequest->sender->first_name }}
                                            {{ $groupRequest->sender->last_name }}</a>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <a href="{{ route('users.show',$groupRequest->sender->id) }}">{{
                                            $groupRequest->sender->email }}</a>
                                    </div>
                                </div>
                            </div>
                            <div x-data="{ requestMenu:false } " @click=" requestMenu = !requestMenu"
                                @keydown.escape="requestMenu = false" @click.away="requestMenu = false">
                                <button
                                    class="text-gray-400 bg-gray-200 focus:outline-none hover:bg-gray-300 rounded-full py-3 px-3">
                                    <svg fill="currentColor" width="24" height="6">
                                        <path
                                            d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z">
                                    </svg>
                                </button>
                                <div x-show="requestMenu" class="absolute z-50 mt-2 bg-white rounded-lg shadow-lg w-52">
                                    <a href="{{ route('requests.accept',$groupRequest->id) }}"
                                        class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                                        Accept request
                                    </a>
                                    <a href="{{ route('requests.reject',$groupRequest->id) }}"
                                        class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                                        Reject request
                                    </a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div
                            class="mt-2 bg-gray-50 flex justify-center py-4 md:w-72 rounded-lg border border-gray-300 hover:bg-gray-100">
                            <div class="flex items-center text-gray-600">
                                @if($group->state->name === 'Recruiting')
                                No join requests pending
                                @else
                                Group state is set to<span class="ml-1 capitalize text-green-500">{{
                                    $group->state->value }}</span>
                                @endif
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</x-app-layout>