@extends('layout.main')
@section('content')
    <div class="wrapper band-detail" style="display: block">
        <h1>{{ $band->name }}</h1>
        <img src="{{ $band->image_path }}" alt="{{ $band->name }} képe" class="band-image">
        <p><small>Alapítva: {{ $band->formed_year }}</small></p>
        @if ($band->styles)
            <p><small>Stílusok: {!! $style_string !!}</small></p>
        @endif
        <p>{{ $band->description }}</p>
        @if ($band->members->count() > 0)
            <div class="band-members">

                <h2>Tagok:</h2>
                <ul>
                    @foreach ($band->members as $member)
                        <li><a href="{{ route('member.show', $member->id) }}">{{ $member->name }}</a> - {{ $member->role }}</li>
                    @endforeach
                </ul>
            </div>

        @endif

        @if ($band->albums->count() > 0)
            <div class="band-albums">
                <h2>Albumok:</h2>
                <ul>
                    @foreach ($band->albums as $album)
                        <li> <a href="{{ route('album.show', $album->id) }}">{{ $album->name }}</a> ({{ $album->release_year }})
                        </li>
                    @endforeach
                </ul>

            </div>
        @endif
    </div>
@endsection