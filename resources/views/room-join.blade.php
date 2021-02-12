@extends('layouts.dark')

@section('content')
    @if(participant())
        <livewire:room-page :room='$room' :participant="participant()" />
    @else
        <livewire:participant-form :room="$room" />
    @endif
@endsection
