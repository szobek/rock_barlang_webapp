@extends('layout.main')
@section('content')
    <div class="wrapper wrapper-block band-detail">
        <h1>{{ $band->name }}</h1>
        <p><small>Alapítva: {{ $band->formed_year }}</small></p>
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