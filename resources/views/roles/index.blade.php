<x-app-layout>
    <x-slot name="header">
        <h2 class="flex items-center font-semibold text-xl text-gray-800">
            {{ __('Roles') }}
        </h2>
        <a href="{{ route('roles.create') }}">
            <x-button class="text-xs" type="button">
                {{ __('Create New role') }}
            </x-button>
        </a>
    </x-slot>
    <x-slot name="filters">
        <span>Filters:</span>
        <div class="relative mt-2 md:mt-0">
            <x-search />
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto scrollbar-none sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <x-flash-message />
                    <div class="shadow-lg overflow-hidden border border-gray-300 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-bald text-gray-500 uppercase tracking-wider">
                                        Role
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($roles as $key => $role)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-600">
                                        {{ $role->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @can('role-edit')
                                        <a class="text-indigo-600 hover:text-indigo-900"
                                            href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                        @endcan
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">

                                        No Results found
                                    </td>
                                    <td></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="py-8">
                    {!! $roles->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>