@extends('layout.main')

@section('content')
    <div class="album-detail wrapper">
        <h1>{{ $album->name }}</h1>
        <p>
            @if ($album->release_year)
                <span class="release-year">Megjelenés éve: {{ $album->release_year }}</span>
            @endif
        </p>
        <div class="description">
            <p>{{ $album->description }}</p>
        </div>
        <div>
            <p>Számok:</p>
            <ul>
                @if ($album->tracks->isEmpty())
                    <li>Nincsenek számok ehhez az albumhoz.</li>
                @else
                    @foreach ($album->tracks as $track)
                        <li>{{ $track->title }} ({{ $track->duration }}) @if ($track->url) | <a href="{{ $track->url }}" target="_blank">Hallgatás</a> @endif</li>
                    @endforeach
                @endif
            </ul>
        </div>
        @if ($album->band)
            <p>Zenekar: <a href="{{ route('band.show', $album->band->id) }}">{{ $album->band->name }}</a></p>
        @endif
    </div>
@endsection