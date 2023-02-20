@extends('backend.adminlayouts.master')

@section('body')

    <br>
    <div>
        <div class="md:grid md:grid-cols-1 md:gap-2">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Crea Utente</h3>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="{{ route('users.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf

                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                            <div class="grid grid-cols-6 gap-6 mt-5">
                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="name"
                                           class="block text-sm font-medium text-gray-700">Name</label>
                                    <input type="text" name="name" id="name"
                                           class="focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @if ($errors->has('name'))
                                        <span class="help-block text-red-700">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                    @endif
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="email"
                                           class="block text-sm font-medium text-gray-700">E-mail</label>
                                    <input type="email" name="email" id="email"
                                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    >
                                    @if ($errors->has('email'))
                                        <span class="help-block text-red-700">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                    @endif
                                </div>

                            </div>
                            <div class="grid grid-cols-6 gap-6 mt-5">
                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="password"
                                           class="block text-sm font-medium text-gray-700">New Password</label>
                                    <input type="password" name="password" id="password"
                                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @if ($errors->has('password'))
                                        <span class="help-block text-red-700">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                    @endif
                                </div>
                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="nome"
                                           class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password-confirm"
                                           class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    >
                                    @if ($errors->has('password'))
                                        <span class="help-block text-red-700">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div>

                                <button type="submit"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-900 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Apply
                                </button>
                                <a href="{{url()->previous()}}"
                                   class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Return back

                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

@endsection
