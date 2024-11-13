<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    // Menampilkan semua data pegawai
    public function index()
    {
        // Mengambil semua data pegawai
        $pegawais = Pegawai::all();
        return response()->json($pegawais);
    }

    // Menyimpan data pegawai baru
    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'phone' => 'required|numeric',
            'address' => 'nullable|string',
            'email' => 'required|email|unique:pegawais,email',
            'status' => 'required|string',
            'hired_on' => 'required|date',
        ]);

        // Menyimpan data pegawai ke database
        $pegawai = Pegawai::create($validated);

        // Menyiapkan respons
        $data = [
            'message' => 'resource succesfull',
            'data' => $pegawai,
        ];

        return response()->json($data, 201);
    }

    // Menampilkan data pegawai berdasarkan ID
    public function show($id)
    {
        // Mencari pegawai berdasarkan ID
        $pegawai = Pegawai::find($id);

        // Jika pegawai tidak ditemukan
        if (!$pegawai) {
            return response()->json(['message' => 'resource not found'], 404);
        }

        return response()->json($pegawai);
    }

    // Mengupdate data pegawai berdasarkan ID
    public function update(Request $request, $id)
    {
        // Mencari pegawai berdasarkan ID
        $pegawai = Pegawai::find($id);

        // Jika pegawai tidak ditemukan
        if (!$pegawai) {
            return response()->json(['message' => 'resource not found'], 404);
        }

        // Validasi data input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'phone' => 'required|numeric',
            'address' => 'nullable|string',
            'email' => 'required|email|unique:pegawais,email,' . $pegawai->id,
            'status' => 'required|string',
            'hired_on' => 'required|date',
        ]);

        // Mengupdate data pegawai
        $pegawai->update($validated);

        // Menyiapkan respons
        $data = [
            'message' => 'resource update succesfull',
            'data' => $pegawai,
        ];

        return response()->json($data);
    }

    // Menghapus data pegawai berdasarkan ID
    public function destroy($id)
    {
        // Mencari pegawai berdasarkan ID
        $pegawai = Pegawai::find($id);

        // Jika pegawai tidak ditemukan
        if (!$pegawai) {
            return response()->json(['message' => 'resource not found'], 404);
        }

        // Menghapus data pegawai
        $pegawai->delete();

        // Menyiapkan respons
        $data = [
            'message' => 'resource delete succesfull',
        ];

        return response()->json($data);
    }
}
