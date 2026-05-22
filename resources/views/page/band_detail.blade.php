@extends('layout.main')
@section('content')
    <div class="wrapper band-detail" style="display: block">
        <h1>{{ $band->name }}</h1>
        <p><small>Alapítva: {{ $band->formed_year }}</small></p>
        @if ($band->styles)
            <p><small>Stílusok: {!! $style_string !!}</small></p>
        @endif
        <p>{{ $band->description }}</p>
        @if ($band->members->count()>0)
            <h2>Tagok:</h2>
            <ul>
                @foreach ($band->members as $member)
                    <li>{{ $member->name }} - {{ $member->role }}</li>
                @endforeach
            </ul>
            
        @endif

        @if ($band->albums->count()>0)
            <h2>Albumok:</h2>
            <ul>
                @foreach ($band->albums as $album)
                    <li>{{ $album->name }} ({{ $album->release_year }})</li>
                @endforeach
            </ul>
            
        @endif
    </div>
@endsection