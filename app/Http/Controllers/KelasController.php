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
    public function index(Request $request)
    {
        $kelas = kelas::paginate();
        return view('kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'kelas'     => 'required',
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
    function show(kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    function edit(kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    function update(Request $request, kelas $kelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    function destroy(kelas $kelas)
    {
        //
    }
}
