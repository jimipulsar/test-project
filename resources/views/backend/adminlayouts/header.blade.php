<header class="flex justify-between items-center py-4 px-6 bg-white border-b-4 border-blue-900">
    <div class="flex items-center">
        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round"/>
            </svg>
        </button>

    </div>

    <div class="flex items-center">
        <div x-data="{ notificationOpen: false }" class="relative">
            <button @click="notificationOpen = ! notificationOpen" class="flex mx-4 text-gray-600 focus:outline-none">
                @if($notifications->count())
                    <span class="fa-stack fa-1x" data-count="{{$notifications->count()}}">
                     <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"/>
                     </svg>
                </span>
                @else
                    <span class="fa-stack fa-1x">
                     <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"/>
                     </svg>
                @endif


            </button>

            <div x-show="notificationOpen" @click="notificationOpen = false"
                 class="fixed inset-0 h-full w-full z-10"></div>

            <div x-show="notificationOpen"
                 class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl overflow-hidden z-10"
                 style="width:20rem;">
            </div>
        </div>

        <div x-data="{ dropdownOpen: false }" class="relative">

            <button @click="dropdownOpen = ! dropdownOpen"
                    class="relative inline-block h-8 w-8 rounded-full overflow-hidden shadow focus:outline-none">
                <img class="h-full w-full object-cover" src="/uploads/icon/avatar.png" alt="Your avatar">
            </button>

            <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

            <div x-show="dropdownOpen"
                 class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10">
            {{-- <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-900 hover:text-white">Profile</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-900 hover:text-white">Products</a> --}}
            @if(auth()->guard('web')->user())

                <!-- Active: "bg-gray-100", Not Active: "" -->
                    {{--                     <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>--}}
                    {{--                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>--}}

                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-900 hover:text-white"
                       href="{{route('logout')}}"
                       onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          class="d-none">
                        @csrf
                    </form>

                @endif
            </div>
        </div>

    </div>
</header>
