<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Groups') }}
        </h2>
        <div>
            @can('group-create')
            @if(!Auth::user()->group_id)
            <a href="{{ route('groups.create') }}">
                <x-button type="button">
                    {{ __('Create New group') }}
                </x-button>
            </a>
            @endif
            @endcan
        </div>
    </x-slot>
    <div class="max-w-6xl flex justify-center mx-auto py-6">
        <div class="relative mt-2 md:mt-0">
            <x-search />
        </div>
    </div>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <x-flash-message />
                    <div class="shadow-lg overflow-hidden border-b border-gray-200 sm:rounded-lg">
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
                                        Type</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @forelse ($groups as $group)
                                <tr class="border-b border-gray-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><a
                                            href="{{ route('groups.show',$group) }}">
                                            #{{ $group->id }}</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($group->project_id)
                                        <a href="{{ route('projects.show',$group->project->id) }}">{{
                                            $group->project->title }}</a>
                                        @else
                                        No project yet
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-500">
                                        <div class="flex flex-col justify-start ">
                                            @foreach($group->users as $user)
                                            <a class="text-blue-700" href="{{ route('users.show',$user->id)}}">
                                                {{ $user->first_name }}
                                                {{ $user->last_name }}
                                            </a>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td
                                        class="capitalize px-6 py-4 whitespace-nowrap text-sm @if($group->state->value === 'full' ){ text-red-600 }@elseif($group->state->value === 'looking for members'){ text-green-500 }@endif">
                                        {{ $group->state->value }}
                                    </td>
                                    <td
                                        class="capitalize px-6 py-4 whitespace-nowrap text-sm text-red-600 @if($group->type->value === 'mixed' | $group->type->name === Auth::user()->spec->name){ text-green-500 } @endif">
                                        {{ $group->type->value }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @can('group-edit')
                                        <a href="{{ route('groups.edit',$group->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        @endcan
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
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