@extends('layout.main')

@section('content')
    <div class="member-wrapper flex-container">
        @foreach ($members as $member)
            <x-member-card :member="$member" />
        @endforeach
    </div>
@endsection