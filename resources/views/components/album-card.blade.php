@props(['album'])
<div class="album filter-card" data-album-id="{{ $album->id }}" data-name="{{ $album->name }}"
    data-album-release-year="{{ $album->release_year }}" <a href="{{ route('album.show', $album->id) }}" class=" ">
        <div class="blur"></div>
    <h2>{{ $album->name }}</h2>
    <p >
        @if ($album->release_year)
            <span class="release-year">{{ $album->release_year }}</span>
        @endif
    </p>
    
    <div class="description">
        <p>{{ $album->description }}</p>
    </div>
    @if ($album->band)
    <div class="album-band">
        <a href="{{ route('band.show', $album->band->id) }}">{{ $album->band->name }}</a>
    </div>
    @endif
</div>