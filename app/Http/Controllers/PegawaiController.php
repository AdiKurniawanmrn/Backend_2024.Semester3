<?php

namespace App\Http\Controllers;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index(){
        $pegawai = Pegawai::all();

        if ($pegawai->isEmpty()) {
            $data = [
                'message' => 'data is empty',
                'data' => []
            ];
            return response()->json($data, 200);
        }

        $data = [
            'message' => 'get all resource',
            'data' => $pegawai
        ];

        return response()->json($data, 200);
    }
    public function store(Request $request){
        // Validasi data input
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'jenis_kelamin' => 'required|string|max:1',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
            'email' => 'required|email',
            'status' => 'required|string',
            'tanggal_masuk' => 'required|date',
        ]);

        // Jika semua data valid, buat data baru
        $pegawai = Pegawai::create($validatedData);
        $data = [
            'message' => 'resource is added successfully',
            'data' => $pegawai
        ];

        return response()->json($data, 201);
    }
    public function update(Request $request, $id) {
        $pegawai = Pegawai::find($id); // Perbaikan dari `find->{$id}` menjadi `find($id)`

        if ($pegawai) {
            $input = [
                'nama' => $request->nama ?? $pegawai->nama,
                'jenis_kelamin' => $request->nim ?? $pegawai->nim,
                'no_hp' => $request->email ?? $pegawai->email,
                '' => $request->jurusan ?? $pegawai->jurusan,
            ];

            $pegawai->update($input);

            $data = [
                'message' => 'Student update successful',
                'data' => $pegawai
            ];
            return response()->json($data, 200);
        }
        else {
            $data = [
                'message'=>'student gagal di ubah'
            ];
            return response()->json($data, 404);
        }
        }


}
