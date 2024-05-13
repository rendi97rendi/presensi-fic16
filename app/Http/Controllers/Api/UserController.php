<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::orderBy('id', 'desc')
            ->get();

        return response(['data' => $users], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6|max:20',
            'phone'     => 'nullable|numeric|max_digits:15',
            'role'      => 'nullable|string',
            'position'  => 'nullable|string',
            'department' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => $request->password,
            'phone'     => $request->phone,
            'role'      => $request->role,
            'position'  => $request->position,
            'department'  => $request->department,
        ]);

        return response(['data' => $user], 200);
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'password'  => 'nullable|min:6|max:20',
            'phone'     => 'nullable|numeric|max_digits:15',
            'role'      => 'nullable|string',
            'position'  => 'nullable|string',
            'department' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $user->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'role'      => $request->role,
            'position'  => $request->position,
            'department'  => $request->department,
        ]);

        //if password filled
        if ($request->password) {
            $user->update([
                'password' => $request->password,
            ]);
        }

        return response(['data' => $user], 200);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response(['data' => $user], 200);
    }

    // Update Image & face embedded
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image'             => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'face_embedding'    => 'required',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $user   = $request->user();
        $image  = $request->file('image');
        $faceEmbedding = $request->face_embedding;

        $image->storeAs('public/images', $image->hashName());
        $user->image_url = $image->hashName();
        $user->face_embedding = $faceEmbedding;
        $user->save();

        return response(['data' => $user, 'message' => "Profile Updated"], 200);
    }
}
