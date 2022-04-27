<x-app-layout>
    <x-slot name="header">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Projects') }}
            </h2>
            <div>
                <div class="flex flex-col md:flex-row container mt-3 md:mt-0">
                    <a href="{{ route('projects.create') }}">
                        <x-button type="button">
                            {{ __('Create New project') }}
                        </x-button>
                    </a>
                </div>
            </div>
    </x-slot>
    <div class="max-w-6xl mx-auto py-6 space-y-2" x-data="{ more: false }">
        <div class=" flex justify-center items-center space-x-4">
            <span>Filters:</span>
            <x-dropdown name="type" id="type">
                <x-slot name="trigger">
                    <button
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm text-gray-600 p-4 bg-white border">
                        {{ isset(request()->type) ? ucwords(request()->type) : 'Select type' }}
                        <i class="fa fa-angle-down ml-2"></i>
                    </button>
                </x-slot>
                <x-slot name="content">
                    @if(isset(request()->type))
                    <x-dropdown-link href="/projects?{{ http_build_query(request()->except('type', 'page')) }}">All
                    </x-dropdown-link>
                    @endif
                    @if(!(request()->type === "senior"))
                    <x-dropdown-link
                        href="/projects?type=senior&{{ http_build_query(request()->except('type', 'page')) }}">
                        Senior projects</x-dropdown-link>
                    @endif
                    @if(!(request()->type === "first"))
                    <x-dropdown-link
                        href="/projects?type=first&{{ http_build_query(request()->except('type', 'page')) }}">
                        First Graduation projects</x-dropdown-link>
                    @endif
                    @if(!(request()->type === "final"))
                    <x-dropdown-link
                        href="/projects?type=final&{{ http_build_query(request()->except('type', 'page')) }}">
                        Final Graduation projects</x-dropdown-link>
                    @endif
                </x-slot>
            </x-dropdown>
            <x-dropdown name="category" id="categroy">
                <x-slot name="trigger">
                    <button
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm text-gray-600 p-4 bg-white border">
                        {{ isset(request()->category) ? ucwords(request()->category) : 'Select category' }}
                        <i class="fa fa-angle-down ml-2"></i>
                    </button>
                </x-slot>
                <x-slot name="content">
                    @if(isset(request()->category))
                    <x-dropdown-link href="/projects?{{ http_build_query(request()->except('category', 'page')) }}">All
                    </x-dropdown-link>
                    @endif
                    @if(!(request()->category === "software"))
                    <x-dropdown-link
                        href="/projects?category=software&{{ http_build_query(request()->except('category', 'page')) }}">
                        Software Engineering</x-dropdown-link>
                    @endif
                    @if(!(request()->category === "network"))
                    <x-dropdown-link
                        href="/projects?category=network&{{ http_build_query(request()->except('category', 'page')) }}">
                        Network</x-dropdown-link>
                    @endif
                    @if(!(request()->category === "ai"))
                    <x-dropdown-link
                        href="/projects?category=ai&{{ http_build_query(request()->except('category', 'page')) }}">AI
                    </x-dropdown-link>
                    @endif
                </x-slot>
            </x-dropdown>
            <x-dropdown name="category" id="categroy">
                <x-slot name="trigger">
                    <button
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm text-gray-600 p-4 bg-white border">
                        status
                        <i class="fa fa-angle-down ml-2"></i>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link>
                        Complete
                    </x-dropdown-link>
                    <x-dropdown-link>
                        incomplete
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>
            <div class="relative mt-2 md:mt-0 flex">
                <form action="{{ route('projects.index') }}" method="GET" role="search">
                    @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if (request('type'))
                    <input type="hidden" name="type" value="{{ request('type') }}">
                    @endif
                    <x-input name="search" id="search" type="text" class="w-36 md:w-60 p-4 pl-8" placeholder="Search..."
                        :value="request('search')" />
                    <div class="absolute top-3 left-3">
                        <i class="fa fa-search text-xs text-gray-400"></i>
                    </div>
                </form>
            </div>
            <div class="flex items-center">
                <span @click="more = ! more" class="cursor-pointer">
                    <i class="fa fa-arrow-down" title="More filters"></i>
                </span>
            </div>
        </div>
        <div x-show="more" class="flex justify-center space-x-2">
            <div date-rangepicker class="flex items-center justify-center space-x-2">
                <span class="relative mx-2">Created at:</span>
                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <x-input datepicker type="text" class="w-28 p-4 pl-8" placeholder="From" />
                </div>
                <div class="relative"><i class="fa fa-arrow-right"></i></div>
                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <x-input datepicker type="text" class="w-28 p-4 pl-8" placeholder="To" />
                </div>
            </div>
            <div date-rangepicker class="flex items-center space-x-2">
                <span class="relative mx-2">Updated at:</span>
                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <x-input datepicker type="text" class="w-28 p-4 pl-8" placeholder="From" />
                </div>
                <div class="relative"><i class="fa fa-arrow-right"></i></div>
                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <x-input datepicker type="text" class="w-28 p-4 pl-8" placeholder="To" />
                </div>
            </div>
            <x-button>Apply Filters</x-button>
        </div>
    </div>
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
                                        class="px-6 py-3 text-left text-xs font-small text-gray-500 uppercase">
                                        Project's Title</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-small text-gray-500 uppercase">
                                        Project's type</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-small text-gray-500 uppercase">
                                        Project's Supervisor</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-small text-gray-500 uppercase">
                                        Project's Group</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-small text-gray-500 uppercase">
                                        Category</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-small text-gray-500 uppercase">
                                        Status</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-small text-gray-500 uppercase">
                                        Last Updated</th>
                                    @can('project-edit')
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-small text-gray-500 uppercase">
                                    </th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($projects as $project)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <a href="{{ route('projects.show', $project->id) }}">{{ $project->title
                                            }}</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $project->type }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($project->supervisor)
                                        <a href="{{ route('users.show',$project->supervisor_id)}}">{{
                                            $project->supervisor->first_name }}
                                            {{ $project->supervisor->last_name }}</a>
                                        @else
                                        No supervisor yet
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex flex-col justify-start">
                                            @forelse($project->users as $user)
                                            <a href="{{ route('users.show',$user->id)}}">{{ $user->first_name }}
                                                {{ $user->last_name }}</a>
                                            @empty
                                            No assigned group yet
                                            @endforelse
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $project->dept->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">incomplete</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{
                                        $project->updated_at->diffforhumans() }}</td>
                                    @can('project-edit')
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a class="text-indigo-600 hover:text-indigo-900"
                                            href="{{ route('projects.edit',$project->id) }}">Edit</a>
                                    </td>
                                    @endcan
                                </tr>
                                @empty

                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        No Results found
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-4">
                    {!! $projects->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>