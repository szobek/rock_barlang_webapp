@extends('layout.main')

@section('content')
<x-filter-bar />
    <div class="wrapper flex-container">

        @foreach ($bands as $band)
            <x-band-card :band="$band" />
        @endforeach
    </div>
@endsection