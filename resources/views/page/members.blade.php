@extends('layout.main')

@section('content')
    <div class="member-wrapper flex-container">
        @foreach ($members as $member)
            <div class="member">
                <h2>{{ $member->name }}</h2>
                <p>Zenekar: <a href="{{ route('band.show', $member->band->id) }}">{{ $member->band->name }}</a></p>
            </div>
        @endforeach
    </div>
@endsection