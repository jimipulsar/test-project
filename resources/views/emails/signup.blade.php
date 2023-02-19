@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{(asset('/uploads/logo/logo.png'))}}" style="height:100px;">
        @endcomponent
    @endslot
    {{-- Body --}}
    <h2>New registration from {{env('APP_NAME')}} </h2>
    <br>
    <strong>Full Name</strong>
    <p>{{$data->name}}</p>
    <strong>Email</strong>
    <p>{{$data->email}}</p>
    <br>
    <hr>
    <p><strong>PUBLIC IPV4</strong> : {{\request()->ip()}}</p>
    <p><strong>Browser</strong> : {{\request()->header('User-Agent')}}</p>
    <p><strong>Tracking date</strong> : {{date('d/m/Y H:i:s')}}</p>
    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }} -  | All rights reserved
        @endcomponent
    @endslot
@endcomponent
