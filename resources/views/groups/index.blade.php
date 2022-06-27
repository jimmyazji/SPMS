<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Groups') }}
        </h2>
        <div>
            @can('create',App\Models\Group::class)
            <a href="{{ route('groups.create') }}">
                <x-button class="text-xs" type="button">
                    {{ __('Create New group') }}
                </x-button>
            </a>
            @endcan
        </div>
    </x-slot>
    <x-slot name="filters">
        <span>Filters:</span>
        <div class="relative mt-2 md:mt-0">
            <x-search />
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col">
            <div class="overflow-x-auto scrollbar-none sm:-mx-6 lg:-mx-8 ">
                <div class="align-middle inline-block min-w-full sm:px-6 lg:px-8 ">
                    <x-flash-message />
                    <div class="shadow-lg overflow-hidden sm:rounded-lg border border-gray-300">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-small text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-small text-gray-500 uppercase tracking-wider">
                                        Group's Project</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-small text-gray-500 uppercase tracking-wider">
                                        Members</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-small text-gray-500 uppercase tracking-wider">
                                        State</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-small text-gray-500 uppercase tracking-wider">
                                        Specialization</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-small text-gray-500 uppercase tracking-wider">
                                        Project Type</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @forelse ($groups as $group)
                                <tr class="border-b border-gray-200 align-text-top">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 "><a
                                             class="text-indigo-500 hover:text-indigo-700" href="{{ route('groups.show',$group) }}">
                                            #{{ $group->id }}</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($group->project_id)
                                        <a class="text-indigo-500 hover:text-indigo-700" href="{{ route('projects.show',$group->project->id) }}">{{
                                            $group->project->title }}</a>
                                        @else
                                        No project yet
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-500">
                                        <div class="flex flex-col justify-start ">
                                            @foreach($group->developers as $user)
                                            <a class="hover:text-indigo-700" href="{{ route('users.show',$user->id)}}">
                                                {{ $user->name }}
                                            </a>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td
                                        class="capitalize px-6 py-4 whitespace-nowrap text-sm @if($group->state->value === 'full' ){ text-red-600 }@elseif($group->state->value === 'looking for members'){ text-green-500 }@endif">
                                        {{ $group->state->value }}
                                    </td>
                                    <td
                                        class="capitalize px-6 py-4 whitespace-nowrap text-sm text-red-600 @if($group->spec->value === 'mixed' | $group->spec->name === Auth::user()->spec->name){ text-green-500 } @endif">
                                        {{ $group->spec->value }}
                                    </td>
                                    <td
                                        class="capitalize px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $group->project_type->value ?? null }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @can('edit',$group)
                                        <a href="{{ route('groups.edit',$group->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        @endcan
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        No Results found
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="py-8">
                    {!! $groups->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>