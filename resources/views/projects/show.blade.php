<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight px-4">
            {{ $project->title }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-7xl py-12 flex flex-col md:flex-row container items-start justify-center gap-6">
        <div class="w-full md:w-3/5">
            <div class="bg-white overflow-hidden shadow-lg rounded-3xl">
                <div class="bg-white border-b border-gray-200">
                    <div class="p-8 bg-white text-gray-800">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Project's Files</h2>
                        <div class="bg-gray-50 rounded-lg border border-gray-400 mt-6">
                            <x-directory name="{{ __('Directory 1') }} " class="border-b border-gray-200">
                                <x-directory name=" {{ __('Directory 3') }} ">
                                    <x-directory name=" {{ __('Directory 4') }} " />
                                    <x-document name=" {{ __('Document.txt') }}" />
                                </x-directory>
                            </x-directory>
                            <x-directory class="border-b border-gray-200" name=" {{ __('Directory 2') }} " />
                            <x-document name=" {{ __('Readme.md') }}" />
                        </div>
                    </div>
                </div>
            </div>
            {{-- @if ($project->files has readme.md)     --}}
            <div class="bg-white overflow-hidden shadow-lg rounded-3xl mt-4">
                <div class="bg-white border-b border-gray-200">
                    <div class="p-8 bg-white text-gray-800">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Readme.md</h2>
                        <p class="mt-2 text-sm text-gray-700">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, voluptate quia. Delectus
                            doloribus ipsa fuga consequatur, quidem, dolorum ad eos maxime iure reiciendis porro nihil
                            culpa nam, eveniet amet tempore.
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Recusandae, temporibus ab nam
                            tempora facilis autem reiciendis accusamus doloremque, eveniet omnis nihil magnam aspernatur
                            ipsam exercitationem enim, vel consequatur mollitia quod?
                        </p>
                    </div>
                </div>
            </div>
            {{-- @endif --}}
        </div>
        <div class="w-full md:w-1/4 space-y-4">
            <div class="bg-white overflow-hidden shadow-lg rounded-3xl">
                <div class="p-8 bg-white">
                    <div class="items-end">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">About</h2>
                        <p class="mt-2 text-sm text-gray-700">{{ $project->description }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-lg rounded-3xl">
                <div class="p-6 bg-white">
                    <div class="items-end p-2">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Development Group
                        </h2>
                        <div class="mt-3">
                            @foreach ($project->users as $user)
                            <a href="{{ route('users.show',$user->id) }}">
                                <div
                                    class="mt-1 bg-gray-50 px-1 py-1 rounded-lg border border-gray-300 hover:bg-gray-100">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8">
                                            <img class="h-8 w-8 rounded-full border border-gray-300"
                                                src="/uploads/avatars/{{ $user->avatar }}" alt="profile">
                                        </div>
                                        <div class="ml-2">
                                            <div class="text-xs font-medium text-gray-900">
                                                {{ $user->first_name }} {{ $user->last_name }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $user->email }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                            @if ($project->group_id)
                            @if(auth()->user()->group_id == $project->group->id)
                            <a href=""
                                class="mt-1 py-2 bg-gray-50 px-2 flex justify-center rounded-lg font-semibold text-red-700 border border-red-700">
                                Leave group
                            </a>
                            @else
                            <a href="#"
                                class="mt-1 py-2 bg-gray-50 px-2 flex justify-center rounded-lg font-semibold text-blue-700 border border-gray-300">Send
                                Join Request</a>
                            @endif
                            @else
                            <a href="#"
                                class="mt-1 py-2 bg-gray-50 px-2 flex justify-center rounded-lg font-semibold text-blue-700 border border-gray-300">Assign
                                group to project</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>