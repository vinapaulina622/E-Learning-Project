<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JadwalControl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwal = Jadwal::with('matakuliah')->get();
        return view('jadwal.list', compact('jadwal'));
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
            'matakuliah_id' => 'required',
            'jadwal' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }
        
        Jadwal::create($request->all());

        return redirect()->route('jadwal.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jadwal = Jadwal::find($id);
         if (!$jadwal) {
            return response()->json([
                'status' => 'error',
                'message' => 'Jadwal dengan id ' . $id . ' tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $jadwal
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
        $jadwal = Jadwal::find($id);
        if (!$jadwal) {
            return response()->json([
                'status' => 'error',
                'message' => 'Jadwal dengan id ' . $id . ' tidak ditemukan'
            ], 404);
        }
        
        $validator = Validator::make($request->all(), [
            'matakuliah_id' => 'required',
            'jadwal' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }
        
        $jadwal->update($request->all());
        
        return redirect()->route('jadwal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::find($id);
        if (!$jadwal) {
            return response()->json([
                'status' => 'error',
                'message' => 'Jadwal dengan id ' . $id . ' tidak ditemukan'
            ], 404);
        }
        
        $jadwal->delete();
        
        return redirect()->route('jadwal.index');
    }
}
