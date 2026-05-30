<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SiswaController extends Controller
{

    public function index()
    {
        $siswa = Siswa::get();

        return response()->json([
            'message' => 'Get all siswa successful',
            'data' => [
                'siswa' => $siswa
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nisn' => 'required|integer|min:1',
            'nama_lengkap' => 'required|string|max:255',
            'kelas' => 'required|integer|min:1',
            'tanggal_lahir' => 'required|date',
            
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Field',
                'errors' => $validator->errors()
            ], 422);
        }

        $siswa = Siswa::create([
           'nisn' => $request->nisn,
            'nama_lengkap' => $request->nama_lengkap,
            'kelas' => $request->kelas,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);

        return response()->json([
            'message' => 'Create siswa successful',
            'data' => $siswa
        ], 201);
    }

    public function destroy($id)
    {
        $siswa = Siswa::find($id);

        if(!$siswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Siswa Notn Found',
            ], 404);
        }

        return response()->json([
            'status' => 'Success',
            'message' => 'Delete siswa Success',
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
         $validator = Validator::make($request->all(), [
         'nisn' => 'required|integer|min:1',
            'nama_lengkap' => 'required|string|max:255',
            'kelas' => 'required|integer|min:1',
            'tanggal_lahir' => 'required|date',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Field',
                'errors' => $validator->errors()
            ], 422);
        }

        $siswa->update([
            'nisn' => $request->nisn,
            'nama_lengkap' => $request->nama_lengkap,
            'kelas' => $request->kelas,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);

        return response()->json([
            'message' => 'Update siswa successful',
            'data' => $siswa
        ], 200);
    
}
}
