@extends('layout.main')

@section('content')
    <div class="album-wrapper">
        @foreach ($albums as $album)
            <div class="album">
                <h2>{{ $album->name }}</h2>
                <p>
                @if ($album->release_year)
                    <span class="release-year">Megjelenés éve: {{ $album->release_year }}</span>
                @endif
            </p>
            <div class="description">
                <p>{{ $album->description }}</p>
            </div>
            @if ($album->band)
                <p>Zenekar: {{ $album->band->name }}</p>
            @endif
        </div>
    @endforeach
</div>
@endsection