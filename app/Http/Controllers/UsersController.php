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
        // define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'img' => 'required|image|mimes:png,jpg,svg,jfif|max:200',
            'password' => 'required|min:5',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // process the image
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }

        // create user
        $user = users::create([
            'name' => $request->name,
            'email' => $request->email,
            'img' => $imageName,
            'password' => bcrypt($request->password),
        ]);

        // return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data' => $user
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
        // Find the user by ID
        $user = users::find($id);

        // Check if the user exists
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users,name,' . $user->id,
            'email' => 'required|unique:users,email,' . $user->id,
            'img' => 'image',
            'password' => 'required|min:5',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Process the image
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $user->img = $imageName;
        }

        // Update the user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diupdate!',
            'data' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = users::findOrFail($id);

        // Delete the associated image if it exists
        if ($user->img) {
            $imagePath = public_path('images') . '/' . $user->img;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
