@extends('layouts.dark')

@section('content')
    <livewire:room-page :room='$room' is-participant />
@endsection
