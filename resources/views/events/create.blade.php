@extends('layout')

@section('content')
    <h1>Create Event</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Name:</label>
        <input type="text" name="name" class="form-control">
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Description:</label>
        <div>
        <textarea name="description" class="form-control"></textarea>
    </div>
    </div>
        <label class="mb-3 row">Date:</label>
        <input type="date" name="event_date" class="form-control">
        <button type="submit" class="btn btn-primary mt-3">Create</button>
    </form>
@endsection
