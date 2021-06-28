<div x-data="{ open: false }" {{ $attributes }}>
    <div class="flex justify-between hover:bg-gray-200 py-2 px-2" @mouseover=" options= true"
        @mouseover.leave="options= false">
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
            <span class="ml-1 text-gray-600">{{ $name }}</span>
        </x-label>
        <x-file-option />
    </div>
    <div x-show="open" class="ml-4 border-l border-gray-300 border-dashed">
        {{ $slot }}
    </div>
</div>