<?php

namespace App\Http\Controllers;

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
            ->paginate(10);

        return view('pages.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'           => 'required|exists:users,id',
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
        $permission->is_apprived = 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $hashNameImage = $image->hashName();
            $image->storeAs('public/permission/', $hashNameImage);
            $permission->image = $hashNameImage;
        }

        $permission->save();

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        $permission['image_profile'] = $permission->user->image_url == "null" ? Storage::url('images/' . $permission->user->image_url) : 'https://demo.getstisla.com/assets/img/avatar/avatar-1.png';
        $permission['total_kehadiran'] = User::find($permission->user_id)->loadCount('attendance');
        return view('pages.permission.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        //
        return view('pages.permission.edit', compact('permission'));
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

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully');
    }
}
