<?php

namespace App\Http\Controllers;

use App\Models\Kontrak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KontrakControl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kontrak = Kontrak::with(['mahasiswa', 'semester'])->get();
        return view('kontrak.list', compact('kontrak'));
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
            'mahasiswa_id' => 'required',
            'semester_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }
        
        $kontrak = Kontrak::create($request->all());

        return redirect()->route('kontrak.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kontrak = Kontrak::find($id);
        if (!$kontrak) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kontrak dengan id ' . $id . ' tidak ditemukan'
            ], 400);
        }
        
        return response()->json([
            'status' => 'success',
            'data' => $kontrak
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
        $kontrak = Kontrak::find($id);
        if (!$kontrak) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kontrak dengan id ' . $id . ' tidak ditemukan'
            ], 400);
        }
        
        $kontrak->update($request->all());
        return redirect()->route('kontrak.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kontrak = Kontrak::find($id);
        if (!$kontrak) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kontrak dengan id ' . $id . ' tidak ditemukan'
            ], 400);
        }
        
        $kontrak->delete();
        return redirect()->route('kontrak.index');
    }
}
