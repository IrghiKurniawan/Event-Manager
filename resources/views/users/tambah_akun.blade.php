@extends('layout')


@section('content')

    <form action="{{ route('kelola_akun.tambah.proses') }}" method="POST" class="card p-5">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Nama: </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Email </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Password </label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Kirim</button>
    </form>
@endsection