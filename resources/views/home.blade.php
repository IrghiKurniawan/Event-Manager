@extends('layout')

@section('content')
    <h1>Welcome to Event Manager</h1>
    <p>This is a simple application to manage your events.</p>
    <a href="{{ route('events.index') }}" class="btn btn-primary">View Events</a>
@endsection
