<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MapelController extends Controller
{
    public function index()
    {
        $mapel = Mapel::all();

        return response()->json([
            'message' => 'Get all mapel successful',
            'data' => [
                'mapel' => $mapel
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_mapel' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Field',
                'errors' => $validator->errors()
            ], 422);
        }

        $mapel = Mapel::create([
            'nama_mapel' => $request->nama_mapel,
        ]);

        return response()->json([
            'message' => 'Create mapel successful',
            'data' => $mapel
        ], 201);
    }

    public function destroy($id)
    {
        $mapel = Mapel::find($id);

        if (!$mapel) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mapel Not Found',
            ], 404);
        }

        $mapel->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Delete mapel Success',
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $mapel = Mapel::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_mapel' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Field',
                'errors' => $validator->errors()
            ], 422);
        }

        $mapel->update([
            'nama_mapel' => $request->nama_mapel,
        ]);

        return response()->json([
            'message' => 'Update mapel successful',
            'data' => $mapel
        ], 200);
    }
}