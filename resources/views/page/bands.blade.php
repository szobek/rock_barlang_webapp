@extends('layout.main')

@section('content')
    <div class="wrapper">

        @foreach ($bands as $band)
            <x-band-card :band="$band" />
        @endforeach
    </div>
@endsection