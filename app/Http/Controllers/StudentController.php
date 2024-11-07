<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Student;
class StudentController extends Controller
{
    public function index(){
        $students = Student::all();

        if ($students->isEmpty()) {
            $data = [
                'message' => 'No data available',
                'data' => []
            ];
            return response()->json($data, 404);
        }

        $data = [
            'message' => 'get all bangkolo team',
            'data' => $students
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request){
        // Validasi data input
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'nim' => 'required|string|max:20|unique:students',
            'email' => 'required|email|unique:students',
            'jurusan' => 'required|string',
        ]);

        // Jika semua data valid, buat data baru
        $students = Student::create($validatedData);
        $data = [
            'message' => 'Student is created successfully',
            'data' => $students
        ];

        return response()->json($data, 201);
    }
   public function update(Request $request, $id) {
    $students = Student::find($id); // Perbaikan dari `find->{$id}` menjadi `find($id)`

    if ($students) {
        $input = [
            'nama' => $request->nama ?? $students->nama,
            'nim' => $request->nim ?? $students->nim,
            'email' => $request->email ?? $students->email,
            'jurusan' => $request->jurusan ?? $students->jurusan,
        ];

        $students->update($input);

        $data = [
            'message' => 'Student update successful',
            'data' => $students
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

    public function destroy($id){
        $students = Student::find($id);

        if($students){
            $students ->delete();
            $data = [
                 'message'=>'delete is succesfull'
            ];
            return response()->json($data, 200);
        }
        else{
            $data = [
                'message'=>'student not found'
            ];
            return response()->json($data, 404);
        }
    }
    public function show($id)
    {
       $dtudents = Student::find($id);
       if ($students){
        $data=[
            'message'=>'get detail students',
            'data'=>$students
        ];
        return response()->json($data,200);
       } else
       {
        $data=[
            'message'=>'stundets not found',
        ];
        return response()->json($data,404);
       }
    }

}


