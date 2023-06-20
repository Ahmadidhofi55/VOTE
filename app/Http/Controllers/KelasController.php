<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = kelas::all();

        return response()->json($data);
    }

    public function read()
    {
        return view('kelas.index');
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'kelas'     => 'required|unique:kelas,kelas,except,kelas',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $kelas = kelas::create([
            'kelas' => $request->kelas,
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $kelas
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kelas = kelas::find($id);

        return response()->json($kelas);
    }

    /**
     * Show the form for editing the specified resource.
     */
    function update(Request $request, kelas $kelas)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'kelas'     => 'required|unique:kelas,kelas,except,kelas',]);
                    //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $kelas->update([
            'kelas'     => $request->kelas,
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diupdate!',
            'data'    => $kelas
        ]);

    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    function destroy($id)
    {
        $data = Kelas::findOrFail($id);
        $data->delete();

        return response()->json(['message' => 'Data deleted successfull']);
    }
}
