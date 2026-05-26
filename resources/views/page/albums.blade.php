@extends('layout.main')

@section('content')
<x-filter :placeholder="'Album keresése...'" />
    <div class="album-wrapper flex-container ">

        @foreach ($albums as $album)
            <x-album-card :album="$album" />
        @endforeach
    </div>
@endsection