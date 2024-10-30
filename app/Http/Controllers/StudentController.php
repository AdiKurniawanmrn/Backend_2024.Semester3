<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Student;
class StudentController extends Controller
{
   public function index(){
    $students =Student::all();
    $data = [
        'massage' => 'get all bangkolo team',
        'data' => $students   ];

    return response()->json($data, 200);
   }

   public function store(Request $request){
    $input = [
        'nama' => $request->nama,
        'nim' => $request->nim,
        'email' => $request->email,
        'jurusan' => $request->jurusan,
    ];
    $students =Student::create($input);
    $data = [
        'massage' => 'student  is create succesfull',
        'data' => $students
    ];

    return response()->json($data,201);

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

}


