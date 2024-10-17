@extends('layout')

@section('content')
    <h1>Event List</h1>
    <a href="{{ route('events.create') }}" class="btn btn-primary">Create New Event</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-2">
            {{ $message }}
        </div>
    @endif

    <ul class="list-group mt-3">
        @foreach ($events as $event)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('events.show', $event->id) }}">{{ $event->name }}</a>
                <div>
                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
