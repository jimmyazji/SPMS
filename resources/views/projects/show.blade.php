<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight px-4">
            {{ $project->title }}
        </h2>
    </x-slot>
    <x-flash-message />
    <div class="mx-auto max-w-7xl py-12 flex flex-col md:flex-row container items-start justify-center gap-6">
        <div class="w-full md:w-3/5">
            <div class="bg-white overflow-hidden shadow-lg rounded-3xl">
                <div class="bg-white border-b border-gray-200">
                    <div class="p-8 bg-white text-gray-800">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Project's Files</h2>
                        <div class="mt-2 flex mx-1 flex-row justify-between items-center">
                            <span>
                            {{ count($project->directory->media) }} files
                            </span>
                            <div class="flex flex-row space-x-2">
                                <div x-data="{ requestMenu:false } " @click.away=" requestMenu = false " 
                                    @keydown.escape="requestMenu = false">
                                    <x-button @click=" requestMenu = !requestMenu">
                                        Add +
                                    </x-button>
                                    <div x-show="requestMenu"
                                        class="absolute z-50 mt-2 bg-white rounded-lg shadow-lg w-40 overflow-hidden text-xs ring-1 ring-black ring-opacity-5">
                                        <form method="POST"
                                            action="{{ route('directory.store',$project->directory_id) }}" x-data ="{ enableInput : false }">
                                            @csrf
                                            <a href="#"  @click.prevent=" enableInput =!enableInput "
                                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                                                Create a directory
                                            </a>
                                            <div x-show="enableInput" class="relative z-50 ">
                                                <input type="text" name="name" placeholder="Enter name" class="w-full px-1 py-1 focus:ring-none text-xs">
                                            </div>
                                        </form>
                                        <form method="POST" action="{{ route('media.store',$project->directory_id) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <label
                                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 cursor-pointer"
                                                for="file-upload">
                                                <span>Upload a file</span>
                                                <input id="file-upload" name="file-upload" type="file"
                                                    onchange="form.submit()" class="sr-only">
                                            </label>
                                        </form>
                                    </div>
                                </div>
                                <div x-data="{ requestMenu:false } " @click=" requestMenu = !requestMenu"
                                    @keydown.escape="requestMenu = false" @click.away="requestMenu = false">
                                    <x-button class="bg-green-700 hover:bg-green-600">
                                        Project
                                    </x-button>
                                    <div x-show="requestMenu"
                                        class="absolute z-50 mt-2 bg-white rounded-lg shadow-lg w-40 overflow-hidden text-xs ring-1 ring-black ring-opacity-5">
                                        <a href="{{ route('directory.download',$project->directory) }}"
                                            class="block px-4 py-2 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                                            Download ZIP
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-lg border border-gray-400 mt-2 overflow-hidden">
                            @foreach ($project->directory->directories as $directory)
                            <x-directory :directory="$directory" />
                            @endforeach
                            @foreach ($project->directory->media as $media)
                            <x-document :document="$media" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
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
                            @if ($project->group)
                            @if(auth()->user()->group_id == $project->group->id)
                            <a href="{{ route('projects.unAssignProject',$project->id) }}">
                                <x-modal action="{{ __('Unassign') }}" type="{{ __('button') }}">
                                    <x-slot name="trigger">
                                        <button @click.prevent="showModal = true"
                                            class="mt-2 px-2 py-2 w-full bg-red-50 flex justify-center rounded-lg font-semibold text-red-700 border border-red-700 hover:border-red-500 hover:text-red-500 focus:outline-none">
                                            Unassign group
                                        </button>
                                    </x-slot>
                                    <x-slot name="title">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                            Unassign group
                                        </h3>
                                    </x-slot>
                                    <x-slot name="content">
                                        <p class="text-sm text-gray-500">
                                            Are you sure you want unassign your group from this project? This action
                                            will cause the project to become open for assignments.
                                        </p>
                                    </x-slot>
                                </x-modal>
                            </a>
                            @else
                            <a href="{{ route('groupRequests.store',$project->group->id) }}"
                                class="mt-2 py-2 bg-gray-50 px-2 flex justify-center rounded-lg font-semibold text-blue-700 border border-gray-300">Send
                                Join Request</a>
                            @endif
                            @else
                            <a href="{{ route('projects.assignProject',$project->id) }}"
                                class="mt-6 py-2 bg-gray-50 px-2 flex justify-center rounded-lg font-semibold text-blue-700 border border-gray-300">Assign
                                project</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>