@props(['band'])

<div class="band">
    <h2>{{ $band->name }}</h2>
    <div class="logo">
        @if ($band->image_path)
            <img src="{{ $band->image_path }}" alt="{{ $band->name }} képe" class="band-image">
        @else
            <div class="no-image-placeholder">Nincs kép</div>
        @endif
    </div>
</div>