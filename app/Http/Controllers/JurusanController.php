<?php

namespace App\Http\Controllers;

use App\Models\jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = jurusan::all();

        return response()->json($data);
    }

    public function read()
    {
        return view('jurusan.index');
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
            'jurusan' => 'required|unique:jurusan,jurusan,except,jurusan',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $jurusan = jurusan::create([
            'jurusan' => $request->jurusan,
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Jurusan Berhasil Disimpan!',
            'data'    => $jurusan
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $jurusan = jurusan::find($id);

        return response()->json($jurusan);
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         // Find the kelas by ID
         $jurusan = jurusan::find($id);

         // Check if the kelas exists
         if (!$jurusan) {
             return response()->json([
                 'success' => false,
                 'message' => 'Jurusan not found'
             ], 404);
         }

         // Define validation rules
         $validator = Validator::make($request->all(), [
             'jurusan' => 'required|unique:jurusan,jurusan,' . $jurusan->id,
         ]);

         // Check if validation fails
         if ($validator->fails()) {
             return response()->json($validator->errors(), 422);
         }

         // Update the kelas
         $jurusan->jurusan = $request->jurusan;
         $jurusan->save();

         // Return response
         return response()->json([
             'success' => true,
             'message' => 'Jurusan Berhasil Diupdate!',
             'data'    => $jurusan
         ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = jurusan::findOrFail($id);
        $data->delete();

        return response()->json(['message' => 'Jurusan deleted successfull']);
    }
}
