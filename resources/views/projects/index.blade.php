<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
        @can('create',App\Models\Project::class)
        <a href="{{ route('projects.create') }}">
            <x-button class="text-xs" type="button">
                {{ __('Create New project') }}
            </x-button>
        </a>
        @endcan
    </x-slot>
    <x-slot name="filters">
        <div class="space-y-2 md:space-y-0 transition-padding" x-data="{ more: false }">
            <div class="flex flex-col md:flex-row justify-center items-center space-y-2 md:space-y-0 sm:space-x-4">
                <span>Filters:</span>
                <x-dropdown name="type" id="type">
                    <x-slot name="trigger">
                        <button
                            class="w-[95vw] md:w-auto text-left rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm text-gray-600 p-4 bg-white border">
                            {{ isset(request()->type) ? ucwords(request()->type) : 'Select Type' }}
                            <i class="fa fa-angle-down ml-2"></i>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        @foreach($types as $type)
                        @if(!(request()->type === $type->name))
                        <x-dropdown-link class="capitalize"
                            href="/projects?type={{ $type->value }}&{{ http_build_query(request()->except('type', 'page')) }}">
                            {{
                            $type->value }}
                        </x-dropdown-link>
                        @endif
                        @endforeach
                    </x-slot>
                </x-dropdown>
                <x-dropdown name="spec" id="spec">
                    <x-slot name="trigger">
                        <button
                            class="w-[95vw] md:w-auto text-left rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm text-gray-600 p-4 bg-white border">
                            {{ isset(request()->spec) ? ucwords(request()->spec) : 'Select Specialization' }}
                            <i class="fa fa-angle-down ml-2"></i>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        @foreach($specs as $spec)
                        @if(!(request()->spec === $spec->name))
                        <x-dropdown-link class="capitalize"
                            href="/projects?spec={{ $spec->value }}&{{ http_build_query(request()->except('spec', 'page')) }}">
                            {{
                            $spec->value }}
                        </x-dropdown-link>
                        @endif
                        @endforeach
                    </x-slot>
                </x-dropdown>
                <x-dropdown name="state" id="state">
                    <x-slot name="trigger">
                        <button
                            class="w-[95vw] md:w-auto text-left rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm text-gray-600 p-4 bg-white border">
                            {{ isset(request()->state) ? ucwords(request()->state) : 'Select State' }}
                            <i class="fa fa-angle-down ml-2"></i>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        @foreach($states as $state)
                        @if(!(request()->state === $state->name))
                        <x-dropdown-link class="capitalize"
                            href="/projects?state={{ $state->value }}&{{ http_build_query(request()->except('state', 'page')) }}">
                            {{
                            $state->value }}
                        </x-dropdown-link>
                        @endif
                        @endforeach
                    </x-slot>
                </x-dropdown>
                <div class="relative mt-2 md:mt-0 flex">
                    <x-search>
                        @if (request('spec'))
                        <input type="hidden" name="spec" value="{{ request('spec') }}">
                        @endif
                        @if (request('type'))
                        <input type="hidden" name="type" value="{{ request('type') }}">
                        @endif
                        @if (request('state'))
                        <input type="hidden" name="state" value="{{ request('state') }}">
                        @endif
                    </x-search>
                </div>
                <div class="flex items-center">
                    <span @click="more = ! more" class="cursor-pointer">
                        <i class="fa fa-arrow-down transform transition" :class="{'rotate-180': more}"
                            title="More filters"></i>
                    </span>
                </div>
            </div>
            <form id="search" action="{{ route('projects.index') }}" method="GET" role="search">
                <div x-cloak x-show="more"
                    class="sm:flex flex-wrap justify-center items-center sm:space-x-2 space-y-4 sm:space-y-0 mt-4"
                    x-transition:enter="transition-transform transition-opacity ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-end="opacity-0 transform -translate-y-3">
                    <div date-rangepicker class="sm:flex space-y-2 md:space-y-0 justify-center items-center">
                        <span class="flex justify-center">Created at:</span>
                        <div class="flex justify-center items-center space-x-2 mx-2.5">
                            <div class="relative w-1/2">
                                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <x-input id="created_from" name="created_from" datepicker type="text"
                                    class="w-full sm:w-28 p-4 pl-8" placeholder="From"
                                    value="{{ request('created_from') }}" />
                            </div>
                            <div class="relative"><i class="fa fa-arrow-right"></i></div>
                            <div class="relative w-1/2">
                                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <x-input id="created_to" name="created_to" datepicker type="text"
                                    class="w-full sm:w-28 p-4 pl-8" placeholder="To"
                                    value="{{ request('created_to') }}" />
                            </div>
                        </div>
                    </div>
                    <div date-rangepicker class="sm:flex space-y-2 md:space-y-0 justify-center items-center">
                        <span class="flex justify-center">Updated at:</span>
                        <div class="flex justify-center items-center space-x-2 mx-2.5">
                            <div class="relative">
                                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <x-input id="updated_from" name="updated_from" datepicker type="text"
                                    class="w-full sm:w-28 p-4 pl-8" placeholder="From"
                                    value="{{ request('updated_from') }}" />
                            </div>
                            <div class="relative"><i class="fa fa-arrow-right"></i></div>
                            <div class="relative">
                                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <x-input id="updated_to" name="updated_to" datepicker type="text"
                                    class="w-full sm:w-28 p-4 pl-8" placeholder="To"
                                    value="{{ request('updated_to') }}" />
                            </div>
                        </div>
                    </div>
                    @if (request('spec'))
                    <input type="hidden" name="spec" value="{{ request('spec') }}">
                    @endif
                    @if (request('type'))
                    <input type="hidden" name="type" value="{{ request('type') }}">
                    @endif
                    @if (request('state'))
                    <input type="hidden" name="state" value="{{ request('state') }}">
                    @endif
                    @if (request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <div class="flex justify-center items-center space-x-2 ">
                        <x-button class="py-4 text-xs">Apply</x-button>
                        <a class="inline-flex items-center px-4 py-4 bg-gray-800 border border-transparent rounded-md font-bold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                            href="{{ route('projects.index') }}">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto scrollbar-none xl:overflow-x-visible sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <x-flash-message />
                    <div class="shadow-lg overflow-hidden border border-gray-300 sm:rounded-lg">
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
                                        Specialization</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-small text-gray-500 uppercase">
                                        Project's Supervisor</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-small text-gray-500 uppercase">
                                        Project's Group</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-small text-gray-500 uppercase">
                                        State</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-small text-gray-500 uppercase">
                                        Last Updated</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-base font-small text-indigo-500 uppercase">
                                        @can('export',App\Models\Project::class)
                                        <form id="search" action="{{ route('projects.export') }}" method="GET"
                                            role="search">
                                            @if (request('spec'))
                                            <input type="hidden" name="spec" value="{{ request('spec') }}">
                                            @endif
                                            @if (request('type'))
                                            <input type="hidden" name="type" value="{{ request('type') }}">
                                            @endif
                                            @if (request('state'))
                                            <input type="hidden" name="state" value="{{ request('state') }}">
                                            @endif
                                            @if (request('search'))
                                            <input type="hidden" name="search" value="{{ request('search') }}">
                                            @endif
                                            @if (request('created_from'))
                                            <input type="hidden" name="created_from"
                                                value="{{ request('created_from') }}">
                                            @endif
                                            @if (request('created_to'))
                                            <input type="hidden" name="created_to" value="{{ request('created_to') }}">
                                            @endif
                                            @if (request('updated_from'))
                                            <input type="hidden" name="updated_from"
                                                value="{{ request('updated_from') }}">
                                            @endif
                                            @if (request('updated_to'))
                                            <input type="hidden" name="updated_to" value="{{ request('updated_to') }}">
                                            @endif
                                            <button class="hover:text-indigo-700" title="Export to excel file">
                                                <i class="fas fa-file-export"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($projects as $project)
                                <tr class="border-b border-gray-200 align-text-top">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-500">
                                        <a class="hover:text-indigo-700"
                                            href="{{ route('projects.show', $project->id) }}">{{ $project->title
                                            }}</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                        {{ $project->type->value }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                        {{ $project->spec->value }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($project->supervisor_id)
                                        <a class="text-indigo-500 hover:text-indigo-700"
                                            href="{{ route('users.show',$project->supervisor_id)}}">{{
                                            $project->supervisor->first_name }}
                                            {{ $project->supervisor->last_name }}</a>
                                        @else
                                        No supervisor yet
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex flex-col justify-start">
                                            @forelse($project->group->developers as $user)
                                            <a class="text-indigo-500 hover:text-indigo-700"
                                                href="{{ route('users.show',$user->id)}}">{{ $user->name }}</a>
                                            @empty
                                            No assigned group yet
                                            @endforelse
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                        {{ $project->state->value }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{
                                        $project->updated_at->diffforhumans() }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @can('edit',$project)
                                        <a class="text-indigo-600 hover:text-indigo-900"
                                            href="{{ route('projects.edit',$project->id) }}">Edit</a>
                                        @endcan
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        No Results found
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="py-8">
                    @if ($projects->hasMorePages())
                    {!! $projects->links() !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>