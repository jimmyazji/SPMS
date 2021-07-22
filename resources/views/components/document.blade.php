@props(['document'])
<div x-data="{ open: false }" {{ $attributes }}>
    <div class="flex justify-between hover:bg-gray-200 py-2 px-2">
        <x-label class="flex justify-start items-start text-sm cursor-pointer">
            <div class="inline-flex items-center">
                <svg class="ml-5 h-5 w-5 fill-current text-gray-600" stroke="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 92 92">
                    <path
                        d="M78.8 25.5L56.7 3.2c-.8-.8-1.8-1.2-2.9-1.2H16c-2.2 0-4 1.8-4 4v80c0 2.2 1.8 4 4 4h60c2.2 0 4-1.8 4-4V28.3c0-1.1-.4-2.1-1.2-2.8zM72 30H52V10h.2L72 30zM20 82V10h24v23.9c0 2.2 1.7 4.1 3.9 4.1H72v44H20zm38.5-23.5c0 1.9-1.6 3.5-3.5 3.5H37c-1.9 0-3.5-1.6-3.5-3.5S35 55 37 55h18c2 0 3.5 1.6 3.5 3.5z" />
                    </svg>
            </div>
            <span class="ml-1 text-gray-600">{{ $document->name }}</span>
        </x-label>
        <x-file-options>
            <a href="#"
                class="block px-4 py-2 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                Update
            </a>
            <a href="#"
                class="block px-4 py-2 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                Rename
            </a>
            <form method="POST" action="{{ route('media.destroy',$document->id) }}">
            @method('DELETE')
            @csrf
            <button type="submit"
                class="flex w-full px-4 py-2 text-red-600 hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                Delete
            </a>
            </form>
        </x-file-options>
    </div>
</div>