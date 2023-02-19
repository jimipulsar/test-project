@extends('backend.adminlayouts.master')

@section('body')

    <h3 class="text-gray-700 text-3xl font-medium mb-10">Customer</h3>
    <table>
        <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-2 text-xs text-gray-500">
                ID
            </th>
            <th class="px-6 py-2 text-xs text-gray-500">
                Full Name
            </th>
            <th class="px-6 py-2 text-xs text-gray-500">
                Email
            </th>
            <th class="px-6 py-2 text-xs text-gray-500">
                Created at
            </th>
        </tr>
        </thead>
        <tbody class="bg-white">
        <tr class="whitespace-nowrap">
            <td class="px-6 py-4 text-sm text-gray-500">
                {{$customer->id}}
            </td>
            <td class="px-6 py-4">
                <div class="text-sm text-gray-900">
                    {{$customer->name}}
                </div>
            </td>
            <td class="px-6 py-4">
                <div class="text-sm text-gray-500">{{$customer->email}}</div>
            </td>
            <td class="px-6 py-4 text-sm text-gray-500">
                {{$customer->created_at}}
            </td>
        </tr>

        </tbody>
    </table>
    <div class="text-left pb-10 mt-8">
        <a href="{{url()->previous()}}"
           class="btn px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white font-medium text-xs leading-tight uppercase rounded shadow-md  hover:shadow-lg focus:bg-green-900  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out items-center">
            Return back
        </a>
    </div>
@endsection
