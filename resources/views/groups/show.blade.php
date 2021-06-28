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
                    <div class="mt-2 bg-gray-50 px-2 py-2 w-72 rounded-lg border border-gray-300 hover:bg-gray-100">
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
                    {{-- Send Join Request --}}
                    @if(auth()->user()->group_id != $group->id)
                    @if (count($requested) == 0)
                    <a href="{{ route('groupRequests.store',$group->id) }}"
                        class="mt-1 py-2 bg-gray-50 px-2 flex justify-center rounded-lg font-semibold text-blue-700 border border-gray-300">Send
                        join request</a>
                    @else
                    <form method="POST" action="{{ route('groupRequests.destroy',$group->id) }}">
                        @csrf
                        @method('DELETE')
                        <button
                            class="mt-1 px-2 py-2 w-full focus:outline-none bg-gray-50 flex justify-center rounded-lg font-semibold text-blue-700 border border-gray-300">Cancel
                            join request</button>
                    </form>

                    @endif
                    @else
                    <x-modal action="{{ __('Leave') }}">
                        <x-slot name="trigger">
                            <button @click="showModal = true"
                                class="mt-1 px-2 py-2 w-full bg-gray-50 flex justify-center rounded-lg font-semibold text-red-700 border border-red-700 hover:border-red-500 hover:text-red-500 focus:outline-none">
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
                                Are you sure you want to this group? This action cannot be undone.
                            </p>
                        </x-slot>
                    </x-modal>

                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>