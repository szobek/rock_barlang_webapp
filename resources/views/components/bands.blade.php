@extends('layout.main')

@section('content')
    <div class="band-wrapper ">

        @foreach ($bands as $band)
            <div class="band ">
                <h2>{{ $band->name }}</h2>
                <p>
                    @if ($band->formed_year)
                        <span class="formed-year">Alapítás éve:{{ $band->formed_year }}</span>
                    @endif
                </p>
                <div class="description">
                    <p>{{ $band->description }}</p>
                </div>
                @if ($band->members->count() > 0)
                    <p>Tagok: </p>
                    <ul>
                        @foreach ($band->members as $member)
                            <li>{{ $member->name }}</li>
                        @endforeach
                    </ul>
                    
                @endif
               

                    @if ($band->albums->count() > 0)
                        <p>Albumok: </p>
                        <ul>
                            @foreach ($band->albums as $album)
                                <li>{{ $album->name }}</li>
                            @endforeach
                        </ul>
                    @endif
            </div>
        @endforeach
    </div>
@endsection