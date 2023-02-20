@extends('layouts.app')

@section('content')

    <section class="h-full gradient-form bg-gray-200 md:h-screen justify-content-center" style="height: 100vh;">
        <div class="flex justify-center items-center flex-wrap justify-content-center h-full text-gray-800">
            <div class="xl:w-4/12 ml-12 text-center" style="display: block;margin:auto;">
                <div class=" bg-white shadow-lg rounded-lg py-8">
                    <div class="lg:w-12/12 px-4 md:px-0 py-4">
                        <div class="md:p-12 md:mx-6">
                            <div class="text-center">
                                <img
                                        class="mx-auto w-28"
                                        src="/uploads/logo/logo.png"
                                        alt="logo"
                                />
                                <h4 class="text-xl font-semibold mt-1 mb-12 pb-1">Dashboard </h4>
                            </div>
                            <p class="mb-4">Before proceeding, please check your email for a verification link. If you
                                did not receive the email,
                            </p>
                            <form action="{{ route('verification.resend') }}" method="POST" class="d-inline">
                                @csrf
                                <button
                                        class="inline-block px-6 py-2.5 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out w-full mb-3"
                                        type="submit"
                                        data-mdb-ripple="true"
                                        data-mdb-ripple-color="light"
                                        style=" background: linear-gradient( to right,#ee7724, #d8363a,  #dd3675,#b44593);">
                                    Request a link
                                </button>

                            </form>
                            <div class="text-center pt-1 mb-12 pb-1">

                            </div>
                            <div class="d-block text-center">
                                <a href="{{route('login')}}"
                                   class="inline-block px-6 py-2 border-2 border-red-600 text-red-600 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out"
                                   data-mdb-ripple="true"
                                   data-mdb-ripple-color="light">
                                    Torna in Home Page
                                </a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
