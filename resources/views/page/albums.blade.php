@extends('layout.main')

@section('content')
<x-filter-bar />
    <div class="album-wrapper flex-container ">

        @foreach ($albums as $album)
            <div class="album filter-card" data-album-id="{{ $album->id }}" data-name="{{ $album->name }}" data-album-release-year="{{ $album->release_year }}"
                <a href="{{ route('album.show', $album->id) }}" class=" ">
                    <h2>{{ $album->name }}</h2>
                    <p>
                        @if ($album->release_year)
                            <span class="release-year">Megjelenés éve: {{ $album->release_year }}</span>
                        @endif
                    </p>
                </a>
                <div class="description">
                    <p>{{ $album->description }}</p>
                </div>
                @if ($album->band)
                    <p>Zenekar: <a href="{{ route('band.show', $album->band->id) }}">{{ $album->band->name }}</a></p>
                @endif
            </div>
        @endforeach
    </div>
@endsection