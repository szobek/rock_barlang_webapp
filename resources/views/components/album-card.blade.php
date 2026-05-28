@props(['album'])
<div class="album filter-card" data-album-id="{{ $album->id }}" data-name="{{ $album->name }}"
    data-album-release-year="{{ $album->release_year }}" <a href="{{ route('album.show', $album->id) }}" class=" " style="background-image: url({{ $album->image_path ?? asset('assets/images/album_bg.png') }});background-size: cover; background-position: center;">
    @if (!($album->image_path))
        <div class="blur"></div>
    @endif
    <h2>{{ $album->name }}</h2>
    <p>
        @if ($album->release_year)
            <span class="release-year">{{ $album->release_year }}</span>
        @endif
    </p>

    <div class="description">
        <p>{{ $album->description }}</p>
    </div>
    @if ($album->band)
        <div class="album-band">
            {{ $album->band->name }}
        </div>
    @endif
</div>