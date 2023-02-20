<div class="flex flex-col mt-3">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">

        <div style="width: 100% !important;max-width: 450px">
            <div class="search-style-2 my-4">
                <form>
                    <label for="default-search"
                           class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input wire:model="searchTerm" type="search" id="default-search"
                               class="block p-4 pl-10 w-full text-sm text-gray-900 bg-white-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Search for Product, SKU code..." required>
                        {{--                        <button type="submit" class="btn px-6  py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium text-xs leading-tight uppercase rounded shadow-md  hover:shadow-lg focus:bg-blue-900  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out  absolute right-2.5 bottom-2.5">Search for</button>--}}
                    </div>
                </form>
            </div>
        </div>
        <div class="my-4">
            <p class="text-sm text-gray-700 leading-5">
                <span>{!! __('Showing') !!}</span>
                <span class="font-medium">{{ $users->firstItem() }}</span>
                <span>{!! __('to') !!}</span>
                <span class="font-medium">{{ $users->lastItem() }}</span>
                <span>{!! __('of') !!}</span>
                <span class="font-medium">{{ $users->total() }}</span>
                <span>{!! __('results') !!}</span>
            </p>
        </div>
        <div
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
            <table class="min-w-full">
                <thead>
                <tr>
                    <th style="width:200px; cursor:pointer" wire:click.prevent="sortBy('name')"
                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Name
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="{{ $sortColumnName === 'name' && $sortDirection === 'asc' ? 'black' : 'currentColor' }}"
                             class="w-3 h-3 inline-block">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8.25 6.75L12 3m0 0l3.75 3.75M12 3v18"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="{{ $sortColumnName === 'name' && $sortDirection === 'desc' ? 'black' : 'currentColor' }}"
                             class="w-3 h-3 inline-block">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15.75 17.25L12 21m0 0l-3.75-3.75M12 21V3"/>
                        </svg>
                    </th>

                    <th style="width:180px;cursor:pointer" wire:click.prevent="sortBy('email')"
                        class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Email
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="{{ $sortColumnName === 'email' && $sortDirection === 'asc' ? 'black' : 'currentColor' }}"
                             class="w-3 h-3 inline-block">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8.25 6.75L12 3m0 0l3.75 3.75M12 3v18"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="{{ $sortColumnName === 'email' && $sortDirection === 'desc' ? 'black' : 'currentColor' }}"
                             class="w-3 h-3 inline-block">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15.75 17.25L12 21m0 0l-3.75-3.75M12 21V3"/>
                        </svg>
                    </th>
                    <th style="width:150px"
                        class="pr-20 px-6 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
                </thead>

                <tbody class="bg-white">

                @foreach ($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div
                                    class="leading-5 text-gray-900 ">{{ $user->name }}</div>

                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div
                                    class="leading-5 text-gray-900 ">{{ $user->email }}</div>

                        </td>

                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center justify-content-center">
                            <a data-toggle="tooltip" data-placement="bottom"
                               class="px-4 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                               title="View"
                               href="{{ route('users.show', $user->id) }}" id="btLeft"><i
                                        class="fas fa-eye" title="View"></i></a>

                            <a data-toggle="tooltip" data-placement="bottom"
                               class="px-4 py-2.5 ml-2 bg-yellow-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-yellow-700 hover:shadow-lg focus:bg-yellow-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-800 active:shadow-lg transition duration-150 ease-in-out"
                               title="Edit"
                               href="{{ route('users.edit',$user->id) }}"
                               id="btLeft"><i
                                        class="fas fa-edit" title="Edit"></i></a>
                            <div
                                    x-data="{ 'showModal': false }"
                                    @keydown.escape="showModal = false" id="btLeft">
                                <button type="button" @click="showModal = true" title="Delete"
                                        class="px-4 py-2.5 ml-2 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lgfocus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0active:bg-red-800 active:shadow-lgtransition duration-150 ease-in-out mr-4">
                                    <i class="fas fa-trash-alt"></i></button>
                                <!-- Trigger for Modal -->

                                <!-- Modal -->
                                <div
                                        class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"
                                        x-show="showModal"
                                >
                                    <!-- Modal inner -->
                                    <div
                                            class="max-w-6xl px-6 py-6 mx-auto text-left rounded"
                                            @click.away="showModal = false"
                                            x-transition:enter="motion-safe:ease-out duration-300"
                                            x-transition:enter-start="opacity-0 scale-90"
                                            x-transition:enter-end="opacity-100 scale-100"
                                    >
                                        <!-- Title / Close-->
                                        <div class="flex items-center justify-between">
                                            <h5 class="mr-3 text-black max-w-none">Title</h5>

                                            <button type="button" class="z-50 cursor-pointer"
                                                    @click="showModal = false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- content -->
                                        <div
                                                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                            <div class="bg-white px-4 pt-5 pb-4 py-5 sm:p-6 sm:pb-4">
                                                <div class="md:flex sm:items-start py-3">
                                                    <div
                                                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                        <svg @click="toggleModal" class="h-6 w-6 text-red-600"
                                                             xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24"
                                                             stroke="currentColor" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                        </svg>
                                                    </div>
                                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                        <h3 class="text-lg leading-6 font-medium text-gray-900"
                                                            id="modal-title">
                                                            Are you sure to delete
                                                            <br><strong>{{ $user->name }}</strong> ?
                                                        </h3>
                                                        <div class="mt-2">
                                                            <p class="text-sm text-gray-500">
                                                                An order can only be canceled if it has not yet been shipped. This action is irreversible.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bg-gray-50 px-4 pb-7 sm:px-6 sm:flex sm:flex-row-reverse">
                                                <form action="{{ route('users.destroy' ,$user->id) }}"
                                                      method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" data-toggle="modal"
                                                            data-target="#my-modal"
                                                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto  mt-3">
                                                        Yes, I want to delete this user
                                                    </button>
                                                </form>
                                                <div class="flex items-center justify-between">


                                                    <button type="button" class="z-50 cursor-pointer"
                                                            @click="showModal = false">
                                                        <h5 class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500  sm:ml-3 sm:w-auto  mt-3">
                                                            No</h5>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-5 mb-5">
            {{ $users->links('vendor.pagination.tailwind') }}

        </div>
    </div>
</div>
