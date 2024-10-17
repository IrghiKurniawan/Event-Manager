@extends('layout')

@section('content') 

<!-- Form untuk mengubah data pengguna -->
<form action="{{ route('kelola_akun.ubah.proses', $user['id'])}}" method="POST" class="card p-5">
    @csrf <!-- Menambahkan token CSRF untuk keamanan -->
    @method('PATCH') <!-- Mengubah method form menjadi PATCH untuk proses update -->
    <!--Memperbarui sebagian data yang sudah ada di server.-->

    <!-- Menampilkan pesan sukses jika ada -->
    @if(Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success')}}
        </div>
    @endif

    <!-- Menampilkan pesan error jika ada -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Input untuk nama pengguna -->
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Nama: </label>
        <div class="col-sm-10">
            <!-- Menampilkan input nama dengan nilai lama jika ada kesalahan -->
            <input type="text" class="form-control" id="name" name="name" value="{{ $user['name'] }}">
        </div>
    </div>

    <!-- Input untuk email pengguna -->
    <div class="mb-3 row">
        <label for="email" class="col-sm-2 col-form-label">Email </label>
        <div class="col-sm-10">
            <!-- Menampilkan input email dengan nilai lama jika ada kesalahan -->
            <input type="text" class="form-control" id="email" name="email" value="{{ $user['email'] }}">
        </div>
    </div>

    <!-- Dropdown untuk memilih tipe pengguna -->

    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Password </label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
        </div>
    </div>

    <!-- Tombol untuk menyimpan perubahan -->
    <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
</form>
@endsection
