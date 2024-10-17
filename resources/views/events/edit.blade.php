@extends('layout')

@section('content')
    <h1>Edit Event</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Name:</label>
        <input type="text" name="name" value="{{ $event->name }}" class="form-control">
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Description:</label>
        <textarea  class="form-control"  name="description">{{ $event->description }}</textarea>
    </div>
    <div>
        <label class="mb-3 row">Date:</label>
        <input type="date" name="event_date" value="{{ $event->event_date }}" class="form-control ">
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </div>
    </form>
@endsection
