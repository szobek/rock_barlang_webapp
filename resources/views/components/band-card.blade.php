@props(['band'])

<a href="{{ route('bands.show', $band->id) }}" class="band"  style="background: url( @if (!$band->image_path){{ asset('assets/images/band_bg_3.png') }}@else {{ $band->image_path }} @endif) no-repeat center; background-size: cover; ;" >
    <h2>{{ $band->name }}</h2>
    <div class="logo">
        @if ($band->image_path)
            <img src="{{ $band->image_path }}" alt="{{ $band->name }} képe" class="band-image">
        @else
            <div class="no-image-placeholder"></div>
        @endif
    </div>
</a>