@extends('layout.main')

@section('content')
<x-filter :placeholder="'Banda keresése...'" />
    <div class="wrapper flex-container">

        @foreach ($bands as $band)
            <x-band-card :band="$band" />
        @endforeach
    </div>
@endsection