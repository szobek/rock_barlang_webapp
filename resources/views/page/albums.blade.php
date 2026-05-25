@extends('layout.main')

@section('content')
<x-filter-bar :placeholder="'Album keresése...'" />
    <div class="album-wrapper flex-container ">

        @foreach ($albums as $album)
            <x-album :album="$album" />
        @endforeach
    </div>
@endsection