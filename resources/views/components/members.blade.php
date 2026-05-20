@extends('layout.main')

@section('content')
    <div class="member-wrapper">
        @foreach ($members as $member)
            <div class="member">
                <h2>{{ $member->name }}</h2>
            </div>
        @endforeach
    </div>
@endsection