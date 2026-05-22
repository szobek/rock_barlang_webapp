@extends('layout.main')
@section('content')
<ul>
    @foreach ($bands as $band)
        <li><a href="/band/{{ $band->id }}">{{ $band->name }}</a></li>
    @endforeach
</ul>
@endsection