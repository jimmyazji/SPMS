<div x-data="{ dropdownOpen: false }" class="relative my-32 mr-4">
    <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false"
        class="relative z-10 block rounded-full focus:bg-gray-200 p-2 focus:outline-none text-gray-200 hover:bg-gray-600 focus:text-gray-800">
        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path
                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
        </svg>
    </button>

    <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

    <div x-show="dropdownOpen"
        class="absolute right-0 mt-2 bg-white rounded-md shadow-lg overflow-hidden z-20 max-w-4xl md:w-96"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95">
        <div class="py-2">
            <a href="#" class="flex items-center px-4 py-3 hover:bg-gray-100 -mx-2">
                <img class="h-8 w-8 rounded-full object-cover mx-1"
                    src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80"
                    alt="avatar">
                <p class="text-gray-600 text-sm mx-2">
                    <span class="font-bold" href="#">Sara Salah</span> replied on the <span
                        class="font-bold text-blue-500" href="#">Upload Image</span> article. 2m
                </p>
            </a>
        </div>
        <a href="#" class="block bg-gray-800 hover:bg-gray-600 text-gray-200 text-center font-bold py-2">View all notifications</a>
    </div>
</div>
