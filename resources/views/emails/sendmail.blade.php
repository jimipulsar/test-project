@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{(asset('/uploads/logo/logo.png'))}}" style="height:100px;">
        @endcomponent
    @endslot
    {{-- Body --}}
    <h2>Hai ricevuto una nuova richiesta dal form di contatto del sito web jimipulsar@github.com </h2>
    <strong>Full Name</strong>
    <p>{{$data->name}}</p>
    <strong>Email</strong>
    <p>{{$data->email}}</p>
    <strong>Telefono</strong>
    <p>{{$data->phone}}</p>
    <strong>Richiesta</strong>
    <p>{{$data->message}}</p>
    <br>
    <hr>
    <p><strong>Public IPv4</strong> : {{$data->getClientIp()}}</p>
    <p><strong>Browser</strong> : {{$data->header('User-Agent')}}</p>
    <p><strong>Tracking Date</strong> : {{date('d/m/Y H:i:s')}}</p>
    <p>
        <a href="mailto:{{$data->email}}" style="text-align: center; padding: 10px; border: 2px solid #38aec7; background-color: #4295b4; border-radius: 3px; color: white; text-decoration: none;">Rispondi</a>
    </p>
    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }} -  | Tutti i diritti riservati
        @endcomponent
    @endslot
@endcomponent
