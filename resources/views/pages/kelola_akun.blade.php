@extends('layout')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-end">
            <form class="d-flex me-3" action="{{ route('kelola_akun.data') }}" method="GET">
                {{-- Form pencarian akun --}}
                <input type="text" name="cari" placeholder="Cari Nama Akun..." class="form-control me-2">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
            {{-- Tombol tambah akun --}}
            <a href="{{ route('kelola_akun.tambah') }}" class="btn btn-secondary">Tambah Akun</a>
        </div>
        <br>
        @if (Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <table class="table table-stripped table-bordered mt-3 text-center">
            <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                {{-- jika data akun kosong --}}
                @if (count($users) == 0)
                    <tr>
                        <td colspan="4">Data Akun Kosong</td>
                    </tr>
                @else
                    {{-- Loop data akun dari controller --}}
                    @foreach ($users as $index => $item)
                        <tr>
                            <td>{{ ($users->currentPage() - 1) * $users->perpage() + ($index + 1) }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('kelola_akun.ubah', $item['id']) }}" class="btn btn-primary me-2">Edit</a>
                                <form action="{{ route('kelola_akun.hapus', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        {{-- memanggil pagination --}}
        <div class="d-flex justify-content-end my-3">
            {{ $users->links() }}
        </div>

        <!-- Modal Hapus Akun -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content" method="POST" action="" id="form-delete">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">HAPUS AKUN</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus akun <b id="nama_akun"></b>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection