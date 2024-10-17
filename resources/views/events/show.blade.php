@extends('layout')

@section('content')
    <h1>{{ $event->name }}</h1>
    <p>{{ $event->description }}</p>
    <p>Date: {{ $event->event_date }}</p>
    <a href="{{ route('events.index') }}">Back to list</a>
@endsection
