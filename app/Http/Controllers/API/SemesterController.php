<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semester = Semester::all();
        return response()->json([
            'status' => 'success',
            'data' => $semester
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
            'semester' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }
        
        $semester = Semester::create($request->all());
    
        return response()->json([
            'status' => 'success',
            'data' => $semester
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
        $semester = Semester::find($id);
        if (!$semester) {
            return response()->json([
                'status' => 'error',
                'message' => 'Semester dengan id ' . $id . ' tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $semester
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
        $semester = Semester::find($id);
        if (!$semester) {
            return response()->json([
                'status' => 'error',
                'message' => 'Semester dengan id ' . $id . ' tidak ditemukan'
            ], 404);
        }
        
        $semester->update($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $semester
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
        $semester = Semester::find($id);
        if (!$semester) {
            return response()->json([
                'status' => 'error',
                'message' => 'Semester dengan id ' . $id . ' tidak ditemukan'
            ], 404);
        }
        
        $semester->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Semester dengan id ' . $id . ' berhasil dihapus'
        ], 200);
    }
}
