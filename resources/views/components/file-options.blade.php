<div class="flex flex-row ">
    <svg class="mr-1 h-4 w-4 fill-current text-opacity-75 cursor-pointer opacity-20 text-gray-700 hover:opacity-100 transition ease-in-out duration-150" stroke="currentColor"
        xmlns=" http://www.w3.org/2000/svg" viewBox="0 0 92 92">
        <path
            d="M89 59v27c0 3-2 5-5 5H8c-3 0-5-2-5-5V59c0-3 2-5 5-5s5 2 5 5v22h66V59c0-3 2-5 5-5s5 2 5 5zm-47 6l4 2 4-2 20-20c1-2 1-5-1-7s-5-2-7 0L51 49V6c0-3-2-5-5-5s-5 2-5 5v43L30 38c-2-2-5-2-7 0s-2 5-1 7l20 20z" />
    </svg>
    <div x-data="{ requestMenu:false } " @click.prevent=" requestMenu = !requestMenu" @keydown.escape="requestMenu = false"
        @click.away="requestMenu = false">
        <a href="#">
            <svg class="mr-1.5 h-5 w-5 fill-current text-opacity-75 cursor-pointer opacity-20 text-gray-700 hover:opacity-100 focus:opacity-100 transition ease-in-out duration-150" stroke="currentColor"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 92 92">
                <path
                    d="M21 53a6.97 6.97 0 01-7-7c0-1.8.8-3.6 2-5 1.3-1.3 3.1-2 5-2 1.8 0 3.6.8 4.9 2 1.3 1.3 2.1 3.1 2.1 5 0 1.8-.8 3.6-2.1 4.9A7.07 7.07 0 0121 53zm29.9-2.1c1.3-1.3 2.1-3.1 2.1-4.9 0-1.8-.8-3.6-2.1-5-1.3-1.3-3.1-2-4.9-2-1.8 0-3.7.8-5 2-1.3 1.3-2 3.1-2 5 0 1.8.8 3.6 2 4.9 1.3 1.3 3.1 2.1 5 2.1 1.8 0 3.6-.8 4.9-2.1zm25 0c1.3-1.3 2.1-3.1 2.1-4.9 0-1.8-.8-3.6-2.1-5-1.3-1.3-3.1-2-4.9-2-1.8 0-3.7.8-5 2-1.3 1.3-2 3.1-2 5 0 1.8.8 3.6 2 4.9 1.3 1.3 3.1 2.1 5 2.1 1.8 0 3.6-.8 4.9-2.1z" />
            </svg>
        </a>
        <div x-show="requestMenu" class="absolute z-50 mt-2 bg-white rounded-lg shadow-lg w-52">
            {{ $slot }}
        </div>
    </div>

</div>