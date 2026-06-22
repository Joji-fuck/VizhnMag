@extends('layout.include')

@section('content')
    <div class="navbar-about">
        <a href="/about" style="font-weight: 600;">О нас</a>
        <a href="/mission" style="font-weight: 400;">Наша миссия</a>
    </div>
    <div class="team-wrapper">
        <div class="team-list">
            @foreach($team as $index => $person)
                <div class="team-item {{ $index === 0 ? 'active' : '' }}"
                     data-image="{{ asset('storage/'. $person['image']) }}"
                     data-details="{{ $person['details'] }}">

                    <div class="team-role">{{ $person['role'] }}</div>
                    <div class="team-name">{{ $person['name'] }}</div>
                    <a href="{{'https://t.me/' . $person['social'] }}" class="team-media">{{'@' . $person['social'] }}</a>

                </div>
            @endforeach
        </div>
        <div class="team-preview">
            <div class="preview-sticky">
                <img id="preview-img" src="{{ asset('storage/' . $team[0]['image']) }}" alt="Team Member">
                <div id="preview-text" class="preview-details">
                    {!! $team[0]['details'] !!}
                </div>
            </div>
        </div>

    </div>
@endsection
