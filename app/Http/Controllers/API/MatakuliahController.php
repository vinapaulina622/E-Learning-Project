<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matakuliah = Matakuliah::all();
        return response()->json([
            'status' => 'success',
            'data' => $matakuliah
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validator
        $validator = Validator::make($request->all(), [
            'matakuliah' => 'required',
            'sks' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }
        
        $matakuliah = Matakuliah::create([
            'nama_matakuliah' => $request->matakuliah,
            'sks' => $request->sks
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $matakuliah
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $matakuliah = Matakuliah::find($id);
        if (!$matakuliah) {
            return response()->json([
                'status' => 'error',
                'message' => 'Matakuliah dengan id ' . $id . ' tidak ditemukan'
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'data' => $matakuliah
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $matakuliah = Matakuliah::find($id);
        if (!$matakuliah) {
            return response()->json([
                'status' => 'error',
                'message' => 'Matakuliah dengan id ' . $id . ' tidak ditemukan'
            ], 404);
        }

        $matakuliah->update([
            'nama_matakuliah' => $request->matakuliah ? $request->matakuliah : $matakuliah->nama_matakuliah,
            'sks' => $request->sks ? $request->sks : $matakuliah->sks
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $matakuliah
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $matakuliah = Matakuliah::find($id);
        if (!$matakuliah) {
            return response()->json([
                'status' => 'error',
                'message' => 'Matakuliah dengan id ' . $id . ' tidak ditemukan'
            ], 404);
        }

        $matakuliah->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Matakuliah berhasil dihapus'
        ], 200);
    }
}
