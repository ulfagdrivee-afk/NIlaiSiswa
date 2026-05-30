<?php
namespace App\Http\Controllers;
use App\Models\Nilai;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
   public function index()
{
    $nilai = Nilai::with('siswa', 'mapel')->get();

    $data = $nilai->map(function($nilai) {
        return [
            'id' => $nilai->id,
            'siswa_id' => $nilai->siswa_id,
            'mapel_id' => $nilai->mapel_id,
            'siswa' => $nilai->siswa->nama_lengkap,
            'mapel' => $nilai->mapel->nama_mapel,
            'nilai_tugas' => $nilai->nilai_tugas,
            'nilai_uts' => $nilai->nilai_uts,
            'nilai_uas' => $nilai->nilai_uas,
            'nilai_akhir' => $nilai->nilai_akhir,
            'kategori' => $nilai->kategori,
        ];
    });

    return response()->json([
        'message' => 'Get all Nilai Successful',
        'data' => $data
    ], 200);
}

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'siswa_id' => 'required|exists:siswas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'nilai_tugas' => 'required|integer',
            'nilai_uts' => 'required|integer',
            'nilai_uas' => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Field',
                'errors' => $validator->errors()
            ], 422);
        }

            $nilai = Nilai::find($request->nilai_id);
        $nilai_akhir = ($request->nilai_tugas + $request->nilai_uts + $request->nilai_uas) /3;

    $kategori = $nilai_akhir > 74 ? 'Kompeten' :  'Tidak Kompeten';  

            $nilai = Nilai::create([
                'siswa_id' => $request->siswa_id,
            'mapel_id' => $request->mapel_id,
            'nilai_tugas' => $request->nilai_tugas,
            'nilai_uts' => $request->nilai_uts,
            'nilai_uas' => $request->nilai_uas,
            'nilai_akhir' => $nilai_akhir,
            'kategori' => $kategori,
            ]);
           
                  
           return response()->json([
            'message' => 'Create Nilai Sucessful',
            'data' => $nilai
        ], 201);
    }

    public function destroy($id)
    {
          $nilai = Nilai::find($id);

        if(!nilai) {
            return response()->json([
                'status' => 'error',
                'message' => 'Nilai Notn Found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Delete nilai success',
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $nilai = Nilai::findOrFail($id);

         $validator = Validator::make($request->all(), [
            'siswa_id' => 'required|exists:siswas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'nilai_tugas' => 'required|integer',
            'nilai_uts' => 'required|integer',
            'nilai_uas' => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json([
            'status' => 'error',
            'message' => 'Invalid Field',
            'errors' => $validator->errors()
            ], 422);
        }

          $nilai->update([
            'siswa_id' => $request->siswa_id,
            'mapel_id' => $request->mapel_id,
            'nilai_tugas' => $request->nilai_tugas,
            'nilai_uts' => $request->nilai_uts,
            'nilai_uas' => $request->nilai_uas,
        ]);

        $nilai_akhir = ($request->nilai_tugas + $request->nilai_uts + $request->nilai_uas) / 3;

        $kategori = $nilai_akhir > 74 ? 'Kompeten' : 'Tidak Kompeten';

      

          return response()->json([
            'message' => 'update nilai successful',
            'data' => $nilai
        ], 200);
    }
   
}
 