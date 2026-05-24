@extends('layout.main')
@section('content')
<div class="wrapper">
    <h1>Bands by Style</h1>
    <ul>
        @foreach ($bands as $band)
            <li><a href="{{ route('band.show', ['id' => $band->id]) }}">{{ $band->name }}</a></li>
        @endforeach
    </ul>
</div>
@endsection