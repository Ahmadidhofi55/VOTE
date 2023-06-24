<?php

namespace App\Http\Controllers;

use App\Models\users;
use Illuminate\Http\Request;
use App\Http\Requests\StoreusersRequest;
use App\Http\Requests\UpdateusersRequest;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = users::all();

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function read()
    {
        return view('user.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //define validation rules
         $validator = Validator::make($request->all(), [
            'name' => 'required|unique:name,name,except,users',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $users = users::create([
            'name' => $request->name,
            'email' => $request->email,
            'img' => $request->img,
            'password' => $request->password,
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $users
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $users = users::find($id);

        return response()->json($users);
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
         $users = users::find($id);

         // Check if the kelas exists
         if (!$users) {
             return response()->json([
                 'success' => false,
                 'message' => 'Jurusan not found'
             ], 404);
         }

         // Define validation rules
         $validator = Validator::make($request->all(), [
             'name' => 'required|unique:name,name,' . $users->id,
             'email' => 'required|unique:email,email,' . $users->id,
             'img' => 'required|unique:img,img,' . $users->id,
             'password' => 'required|min:6' . $users->id,
         ]);

         // Check if validation fails
         if ($validator->fails()) {
             return response()->json($validator->errors(), 422);
         }

         // Update the kelas
         $users->name = $request->name;
         $users->email = $request->email;
         $users->img = $request->img;
         $users->password = $request->password;
         $users->save();

         // Return response
         return response()->json([
             'success' => true,
             'message' => 'Data Berhasil Diupdate!',
             'data'    => $users
         ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = users::findOrFail($id);
        $data->delete();

        return response()->json(['message' => 'Users deleted successfull']);
    }
}
