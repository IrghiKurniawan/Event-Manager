<?php

namespace App\Http\Controllers;

use App\Models\User;  // Menggunakan model User untuk akun
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Tampilkan daftar akun dengan opsi pencarian.
     */
    public function index(Request $request)
    {
        $search = $request->input('cari');

        // Filter data akun berdasarkan pencarian
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->paginate(10); // Paginate

        return view('pages.kelola_akun', compact('users'));
    }

    /**
     * Tampilkan form untuk menambahkan akun.
     */
    public function create()
    {
        return view('users.tambah_akun'); // Sesuaikan dengan view tambah akun
    }

    /**
     * Simpan data akun yang baru ditambahkan.
     */
    public function store(Request $request)
    {
        // Validasi data yang dimasukkan
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required',
        ]);

        $password = substr($request->name,0,3) . substr($request->email, 0, 3);
        // Tambahkan akun ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($password),
        ]);

        return redirect()->route('kelola_akun.data')->with('success', 'Akun berhasil ditambahkan.');
    }

    /**
     * Tampilkan form untuk mengubah data akun.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id); // Cari akun berdasarkan ID
        return view('users.edit_akun', compact('user')); // Sesuaikan dengan view edit akun
    }

    /**
     * Simpan perubahan data akun.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diperbarui
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'required',  // Password opsional, jika ingin diubah
        ]);

        // Cari akun berdasarkan ID dan perbarui
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));  // Hash password jika diisi
        }

        $user->save();

        return redirect()->route('kelola_akun.data')->with('success', 'Data akun berhasil diperbarui.');
    }

    /**
     * Hapus akun.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('kelola_akun.data')->with('success', 'Akun berhasil dihapus.');
    }
    public function simpan(Request $request)
{
    // Validasi data yang dimasukkan
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
    ]);

    // Simpan data ke dalam database
    User::create([
        'name' => $request->name,
        'email' => $request->email, // Menggunakan enum field role di database
        'password' => Hash::make($request->password), // Hash password
    ]);

    // Redirect ke halaman daftar akun dengan pesan sukses
    return redirect()->route('kelola_akun.data')->with('success', 'Akun berhasil ditambahkan');
}

}
