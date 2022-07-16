<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight px-4">
            {{ $project->title }}
        </h2>
        <div class="flex space-x-2">
            @can('project-approve')
            <form method="GET" action="{{route('projects.approve', $project->id)}}">
                @csrf
                <x-modal action="Approve" type="approve">
                    <x-slot name="trigger">
                        <x-button class="text-xs" type="button" @click="showModal = true" value="Click Here">Approve
                            Project
                        </x-button>
                    </x-slot>
                    <x-slot name="title">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Approve Project
                        </h3>
                    </x-slot>
                    <x-slot name="content">
                        <p class="text-sm text-gray-500">
                            Are you sure you want to Approve {{ $project->title }}?
                        </p>
                    </x-slot>
                </x-modal>
            </form>
            <form method="GET" action="{{route('projects.disapprove', $project->id)}}">
                @csrf
                <x-modal action="Disapprove">
                    <x-slot name="trigger">
                        <x-button class="text-xs bg-red-700 hover:bg-red-500" type="button" @click="showModal = true"
                            value="Click Here">Disapprove Project
                        </x-button>
                    </x-slot>
                    <x-slot name="title">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Disapprove Project
                        </h3>
                    </x-slot>
                    <x-slot name="content">
                        <p class="text-sm text-gray-500">
                            Are you sure you want to disapprove {{ $project->title }}?
                        </p>
                    </x-slot>
                </x-modal>
            </form>
            @endcan
            @can('complete',$project)
            <form method="GET" action="{{route('projects.complete', $project)}}">
                @csrf
                <x-modal action="complete">
                    <x-slot name="trigger">
                        <x-button class="text-xs" type="button" @click="showModal = true" value="Click Here">Complete
                            Project
                        </x-button>
                    </x-slot>
                    <x-slot name="title">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Complete Project
                        </h3>
                    </x-slot>
                    <x-slot name="content">
                        <p class="text-sm text-gray-500">
                            Are you sure you want to complete {{ $project->title }}?
                        </p>
                    </x-slot>
                </x-modal>
            </form>
            @endcan
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto">
        <x-flash-message />
    </div>
    <div class="mx-auto max-w-7xl py-12 flex flex-col md:flex-row container items-start justify-center gap-6">
        <div class="w-full md:w-3/5">
            <div class="bg-white overflow-hidden shadow-lg rounded-3xl">
                <div class="bg-white border-b border-gray-200">
                    <div class="p-8 bg-white text-gray-800">
                        <div class="flex justify-between">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Project's Proposition</h2>
                            @can('sync',$project)
                            <a class="text-green-600 hover:text-green-400 mr-2" href="{{ route('projects.sync',$project) }}"><i class="fas fa-sync-alt"></i></a>
                            @endcan
                        </div>
                        <div class="space-y-4 p-2">
                            <div class="border-b border-gray-300 pb-4">
                                <h1 class="font-semibold text-base text-gray-800 leading-tight pb-2">Aims:</h1>
                                <ol class="list-disc list-inside">
                                    @foreach ( json_decode($project->aims) as $aim)
                                    <li class="flex justify-between items-center text-sm py-0.5">
                                        <span class="text-sm align-middle">&#8226;{{ ' '.$aim->name }}</span>
                                        <input class="rounded-md text-gray-500" disabled type="checkbox" {{
                                            $aim->complete ? 'checked' : '' }}/>
                                    </li>
                                    @endforeach
                                </ol>
                            </div>
                            <div class="border-b border-gray-300 pb-4">
                                <h1 class="font-semibold text-base text-gray-800 leading-tight pb-2">Objectives:</h1>
                                <ol class="list-disc list-inside">
                                    @foreach ( json_decode($project->objectives) as $objective)
                                    <li class="flex justify-between text-center text-sm py-0.5">
                                        <span class="text-sm align-middle">&#8226;{{ ' '.$objective->name }}</span>
                                        <input class="rounded-md text-gray-500" disabled type="checkbox" {{
                                            $objective->complete ? 'checked' : '' }}></input>
                                    </li>
                                    @endforeach
                                </ol>
                            </div>
                            <div class="">
                                <h1 class="font-semibold text-base text-gray-800 leading-tight pb-2">Tasks:</h1>
                                <ol class="list-decimal list-inside">
                                    @foreach ( json_decode($project->tasks) as $key => $task)
                                    <li class="flex justify-between items-center text-sm py-1.5">
                                        <span class="text-sm align-middle">{{ $key+1 }}{{ '. '.$task->name }}</span>
                                        <input class="rounded-md text-gray-500" disabled type="checkbox" {{ $task->
                                        complete ? 'checked' : '' }}></input>
                                    </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-lg rounded-3xl mt-4">
                <div class="bg-white border-b border-gray-200">
                    <div class="p-8 bg-white text-gray-800">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Readme.md</h2>
                        <div class="mt-2 text-sm text-gray-700">
                            @if (!is_array($markdown))
                            <x-readme>
                                {!! $markdown ?? 'NA.'!!}
                            </x-readme>

                            @else
                            <p class="py-12">
                                No readme file yet.
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/4 space-y-4">
            <div class="bg-white overflow-hidden shadow-lg rounded-3xl">
                <div class="p-8 bg-white">
                    <div class="items-end">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">About</h2>
                        <div class="grid grid-cols-2 gap-1 mt-2">
                            <h2 class="font-semibold text-base text-gray-800 leading-tight">Type:</h2>
                            <span class="text-sm text-gray-700 text-right capitalize">{{ $project->type->value . '
                                Project'}}</span>
                            <h2 class="font-semibold text-base text-gray-800 leading-tight">Specialization:</h2>
                            <span class="text-sm text-gray-700 text-right capitalize">{{ $project->spec->value }}</span>
                            <h2 class="font-semibold text-base text-gray-800 leading-tight">State:</h2>
                            <span class="text-sm text-gray-700 text-right capitalize">{{ $project->state->value
                                }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-lg rounded-3xl">
                <div class="p-6 bg-white">
                    <div class="items-end p-2">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Description</h2>
                        <p class="text-sm text-gray-700 col-span-2 pt-2">{{ $github['description'] ?? 'No description
                            yet'}}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-lg rounded-3xl">
                <div class="p-6 bg-white">
                    <div class="items-end p-2">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Repository
                        </h2>
                        <div class="grid grid-cols-2 gap-1 mt-2">
                            <h2 class="font-semibold text-base text-gray-800 leading-tight">Github:</h2>
                            @if ($github)
                            <a href="{{ $github['html_url'] }}" target="_blank"
                                class="text-sm text-indigo-500 hover:text-indigo-700 text-right capitalize">{{
                                $github['full_name'] }}</a>
                            @else
                            <span class="text-sm text-gray-700 text-right">
                                NA
                            </span>
                            @endif
                            <h2 class="font-semibold text-base text-gray-800 leading-tight">Open Issues:</h2>
                            <span class="text-sm text-gray-700 text-right capitalize">{{ $github['open_issues_count'] ??
                                'NA'
                                }}</span>
                            <h2 class="font-semibold text-base text-gray-800 leading-tight col-span-2">Used Languages:
                            </h2>
                            @forelse ($languages as $language => $value)
                            <span class="text-sm text-gray-700 text-left capitalize">{{ $language }}:</span>
                            <span class="text-sm text-gray-700 text-right capitalize">{{
                                round($value/$languages->sum()*100,2).'%' }}</span>
                            @empty
                            <span class="text-sm text-gray-700 text-left capitalize">
                                NA
                            </span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-lg rounded-3xl">
                <div class="p-6 bg-white">
                    <div class="items-end p-2">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Development Group
                        </h2>
                        <h1 class="font-semibold text-base text-gray-800 leading-tight my-2">Supervisor:</h1>
                        @if ($project->supervisor_id)
                        <a href="{{ route('users.show',$project->supervisor->id) }}">
                            <div class="mt-1 bg-gray-50 px-1 py-1 rounded-lg border border-gray-300 hover:bg-gray-100">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8">
                                        <img class="h-8 w-8 rounded-full border border-gray-300"
                                            src="/uploads/avatars/{{ $project->supervisor->avatar }}" alt="profile">
                                    </div>
                                    <div class="ml-2">
                                        <div class="text-xs font-medium text-gray-900">
                                            {{ $project->supervisor->name }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $project->supervisor->email }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @if ($project->supervisor_id == Auth::id())
                        <a href="{{ route('projects.abandon',$project->id) }}">
                            <x-modal action="{{ __('Abandon') }}" type="{{ __('button') }}">
                                <x-slot name="trigger">
                                    <button @click.prevent="showModal = true"
                                        class="mt-1 px-2 py-2 w-full bg-red-50 flex justify-center rounded-lg font-semibold text-red-700 border border-red-700 hover:border-red-500 hover:text-red-500 focus:outline-none">
                                        Abandon Project
                                    </button>
                                </x-slot>
                                <x-slot name="title">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                        Abandon Project
                                    </h3>
                                </x-slot>
                                <x-slot name="content">
                                    <p class="text-sm text-gray-500">
                                        Are you sure you want abandon this project? This action
                                        will cause the project to become open for other supervisors.
                                    </p>
                                </x-slot>
                            </x-modal>
                        </a>
                        @endif
                        @else
                        @can('project-supervise')
                        <a href="{{ route('projects.supervise',$project->id) }}"
                            class="mt-1 py-2 bg-gray-50 px-2 flex justify-center rounded-lg font-semibold text-blue-700 border border-gray-300">Supervise
                            this project</a>
                        @else
                        No supervisor yet
                        @endcan
                        @endif
                        <h1 class="font-semibold text-base text-gray-800 leading-tight my-2">Team:</h1>
                        @forelse ($project->group->developers as $developer)
                        @once
                        @if(auth()->user()->groups->contains($project->group) || $project->supervisor == auth()->user()
                        || auth()->user()->can('project-edit'))
                        <a href="{{ route('projects.unassign',$project->id) }}">
                            <x-modal action="{{ __('Unassign') }}" type="{{ __('button') }}">
                                <x-slot name="trigger">
                                    <button @click.prevent="showModal = true"
                                        class="px-2 py-2 w-full bg-red-50 flex justify-center rounded-lg font-semibold text-red-700 border border-red-700 hover:border-red-500 hover:text-red-500 focus:outline-none">
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
                        <a href="{{ route('requests.store',$project->group->id) }}"
                            class="py-2 bg-gray-50 px-2 flex justify-center rounded-lg font-semibold text-blue-700 border border-gray-300">Send
                            Join Request</a>
                        @endif
                        @endonce
                        <a href="{{ route('users.show',$developer->id) }}">
                            <div class="mt-1 bg-gray-50 px-1 py-1 rounded-lg border border-gray-300 hover:bg-gray-100">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8">
                                        <img class="h-8 w-8 rounded-full border border-gray-300"
                                            src="/uploads/avatars/{{ $developer->avatar }}" alt="profile">
                                    </div>
                                    <div class="ml-2">
                                        <div class="text-xs font-medium text-gray-900">
                                            {{ $developer->name }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $developer->email }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @empty
                        <a href="{{ route('projects.assign',$project->id) }}"
                            class="py-2 bg-gray-50 px-2 flex justify-center rounded-lg font-semibold text-blue-700 border border-gray-300">Assign
                            project</a>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>