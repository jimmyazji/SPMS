<div x-data="{ open: false }" {{ $attributes }}>
    <div class="flex justify-between hover:bg-gray-200 py-2 px-2">
        <x-label @click=" open =!open " class="flex justify-start items-start text-sm cursor-pointer">
            <div x-show="!open" class="inline-flex items-center">
                <svg class="h-5 w-5 fill-current text-gray-600" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 92 92">
                    <path
                        d="M63 46a4 4 0 01-1.2 2.9l-26 25C35 74.6 34 75 33 75a4 4 0 01-2.9-1.2c-1.5-1.6-1.5-4.1.1-5.7l23-22.1-23-22.1a4.07 4.07 0 01-.1-5.7c1.5-1.6 4.1-1.6 5.7-.1l26 25A4 4 0 0163 46z" />
                </svg>
                <svg class="h-5 w-5 fill-current text-gray-600" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 92 92">
                    <path
                        d="M80 23H45.5l-4.4-7.1c-.7-1.2-2-1.9-3.4-1.9H12c-2.2 0-4 1.8-4 4v56c0 2.2 1.8 4 4 4h68c2.2 0 4-1.8 4-4V27.1c0-2.2-1.8-4.1-4-4.1zm-4 47H16V22h19.4l4.4 7.1c.7 1.2 2 1.9 3.4 1.9H76v39z" />
                </svg>
            </div>
            <div x-show="open" class="text-gray-800 inline-flex items-center">
                <svg class="h-5 w-5 fill-current text-gray-600" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 92 92">
                    <path
                        d="M46 63a4 4 0 01-2.9-1.2l-25-26c-1.5-1.6-1.5-4.1.1-5.7 1.6-1.5 4.1-1.5 5.7.1l22.1 23 22.1-23c1.5-1.6 4.1-1.6 5.7-.1 1.6 1.5 1.6 4.1.1 5.7l-25 26A4 4 0 0146 63z" />
                </svg>
                <svg class="h-5 w-5 fill-current text-gray-600" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 92 92">
                    <path
                        d="M91.1 38.6c-.8-1-1.9-1.6-3.1-1.6h-5V26.1c0-1.9-1.4-3.1-3.3-3.1h-35l-4.5-7.4c-.6-1-1.8-1.6-3-1.6H11.4C9.5 14 8 15.1 8 17v20H4a4.04 4.04 0 00-3.9 4.9l7.4 33.9c.4 1.8 2 3.2 3.9 3.2h68.3c1.8 0 3.4-1.3 3.9-3l8.3-34c.3-1.2 0-2.4-.8-3.4zM15 21h20.2l4.5 7.4c.6 1 1.8 1.6 3 1.6H76v7H15V21zm61.5 50H14.6L9 45h73.9l-6.4 26z" />
                </svg>
            </div>
            <span class="ml-1 text-gray-600">{{ $directory->name }}</span>
        </x-label>
        <div class="flex flex-row " x-data="{ requestMenu:false } " @click.away=" requestMenu=false ">
            <a href="{{ route('directory.download',$directory) }}">
                <svg class="mr-1 h-4 w-4 fill-current text-opacity-75 cursor-pointer opacity-20 text-gray-700 hover:opacity-100 transition ease-in-out duration-150"
                    stroke="currentColor" xmlns=" http://www.w3.org/2000/svg" viewBox="0 0 92 92">
                    <path
                        d="M89 59v27c0 3-2 5-5 5H8c-3 0-5-2-5-5V59c0-3 2-5 5-5s5 2 5 5v22h66V59c0-3 2-5 5-5s5 2 5 5zm-47 6l4 2 4-2 20-20c1-2 1-5-1-7s-5-2-7 0L51 49V6c0-3-2-5-5-5s-5 2-5 5v43L30 38c-2-2-5-2-7 0s-2 5-1 7l20 20z" />
                </svg>
            </a>
            <div @keydown.escape="requestMenu = false">
                <a href="#" @click.prevent=" requestMenu = !requestMenu">
                    <svg class="mr-1.5 h-5 w-5 fill-current text-opacity-75 cursor-pointer opacity-20 text-gray-700 hover:opacity-100 focus:opacity-100 transition ease-in-out duration-150"
                        stroke="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 92 92">
                        <path
                            d="M21 53a6.97 6.97 0 01-7-7c0-1.8.8-3.6 2-5 1.3-1.3 3.1-2 5-2 1.8 0 3.6.8 4.9 2 1.3 1.3 2.1 3.1 2.1 5 0 1.8-.8 3.6-2.1 4.9A7.07 7.07 0 0121 53zm29.9-2.1c1.3-1.3 2.1-3.1 2.1-4.9 0-1.8-.8-3.6-2.1-5-1.3-1.3-3.1-2-4.9-2-1.8 0-3.7.8-5 2-1.3 1.3-2 3.1-2 5 0 1.8.8 3.6 2 4.9 1.3 1.3 3.1 2.1 5 2.1 1.8 0 3.6-.8 4.9-2.1zm25 0c1.3-1.3 2.1-3.1 2.1-4.9 0-1.8-.8-3.6-2.1-5-1.3-1.3-3.1-2-4.9-2-1.8 0-3.7.8-5 2-1.3 1.3-2 3.1-2 5 0 1.8.8 3.6 2 4.9 1.3 1.3 3.1 2.1 5 2.1 1.8 0 3.6-.8 4.9-2.1z" />
                    </svg>
                </a>
                <div x-show="requestMenu"
                    class="absolute z-50 mt-2 bg-white rounded-lg shadow-lg w-32 overflow-hidden text-xs ring-1 ring-black ring-opacity-5">
                    <form method="POST" action="{{ route('media.store',$directory) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <label
                            class="block px-4 py-2 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 cursor-pointer"
                            for="file-upload">
                            <span>Upload a file</span>
                            <input id="file-upload" name="file-upload" type="file" onchange="form.submit()"
                                class="sr-only">
                        </label>
                    </form>
                    <a href="#"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                        Create directory
                    </a>
                    <a href="#"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                        Rename
                    </a>
                    <a href="#"
                        class="block px-4 py-2 text-red-600 hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                        Delete
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div x-show="open" class="ml-4 border-l border-gray-300 border-dashed">
        @foreach ($directory->directories as $directory)
        <x-directory :directory="$directory" />
        @endforeach
        @foreach ($directory->media as $media)
        <x-document name="{{ $media->name }}" />
        @endforeach
    </div>
</div>