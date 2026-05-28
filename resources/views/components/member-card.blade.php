@props(['member'])
<div class="member"
    style="background-image: url({{ $member->image_path ?? asset('assets/images/member_bg.png') }});background-size: cover; background-position: center;">
    <h2>{{ $member->name }}</h2>
    <p><a href="{{ route('band.show', $member->band->id) }}">{{ $member->band->name }}</a></p>
</div>