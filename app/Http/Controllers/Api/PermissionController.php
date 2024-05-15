<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::whereHas('user', function ($query) {
            $query->where('name', 'like', "%" . request('name') . '%');
        })
            ->orderBy('date', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return response(['data' => $permissions], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'           => 'nullable|exists:users,id',
            'date'   => 'required|date',
            'reason'            => 'nullable|string|max:255',
            'image'             => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        
        $permission = new Permission();
        $permission->user_id = $request->user()->id;
        $permission->date = $request->date;
        $permission->reason = $request->reason;
        $permission->is_approved = 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $hashNameImage = $image->hashName();
            $image->storeAs('public/permission/', $hashNameImage);
            $permission->image = $hashNameImage;
        }

        $permission->save();

        return response(['data' => $permission], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        $permission['image_profile'] = $permission->user->image_url == "null" ? Storage::url('images/' . $permission->user->image_url) : 'https://demo.getstisla.com/assets/img/avatar/avatar-1.png';
        $permission['total_kehadiran'] = User::find($permission->user_id)->loadCount('attendance');
        return response(['data' => $permission], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $validator = Validator::make($request->all(), [
            'is_approved' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $permission->update([
            'is_approved' => $request->is_approved,
        ]);

        return response(['data' => $permission], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return response(['data' => $permission], 200);
    }
}
