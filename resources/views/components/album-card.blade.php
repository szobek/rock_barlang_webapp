@props(['album'])
<div class="album filter-card" data-album-id="{{ $album->id }}" data-name="{{ $album->name }}"
    data-album-release-year="{{ $album->release_year }}" <a href="{{ route('album.show', $album->id) }}" class=" ">
    <h2><a href="{{ route('album.show', $album->id) }}">{{ $album->name }}</a></h2>
    <p>
        @if ($album->release_year)
            <span class="release-year">Megjelenés éve: {{ $album->release_year }}</span>
        @endif
    </p>
    
    <div class="description">
        <p>{{ $album->description }}</p>
    </div>
    @if ($album->band)
        <p>Zenekar: <a href="{{ route('band.show', $album->band->id) }}">{{ $album->band->name }}</a></p>
    @endif
</div>