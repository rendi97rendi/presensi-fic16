<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = Attendance::whereHas('user', function ($query) {
            $query->where('name', 'like', "%" . request('name') . '%');
        })
            ->orderBy('date', 'asc')
            ->orderBy('check_in', 'asc')
            ->paginate(10);

        return view('pages.attendance.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.attendance.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string',
            'email'     => 'required|email|unique:attendance,email',
            'address'   => 'nullable|string|max:255',
            'latitude'  => 'nullable|',
            'longitude' => 'nullable|',
            'radius'    => 'nullable|',
            'time_in'   => 'nullable|',
            'time_out'  => 'nullable|',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $attendance = Attendance::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'address'   => $request->address,
            'latitude'  => $request->latitude,
            'longitude' => $request->longitude,
            'radius'    => $request->radius,
            'time_in'   => $request->time_in,
            'time_out'  => $request->time_out,
        ]);

        return redirect()->route('attendance.index')->with('success', 'Attendance created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
        return view('pages.attendance.edit', compact('Attendance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:attendance,email,' . $attendance->id,
            'address'   => 'nullable|string|max:255',
            'latitude'  => 'nullable|',
            'longitude' => 'nullable|',
            'radius'    => 'nullable|',
            'time_in'   => 'nullable|',
            'time_out'  => 'nullable|',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $attendance->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'address'   => $request->address,
            'latitude'  => $request->latitude,
            'longitude' => $request->longitude,
            'radius'    => $request->radius,
            'time_in'   => $request->time_in,
            'time_out'  => $request->time_out,
        ]);

        return redirect()->route('attendance.index')->with('success', 'Attendance updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendance.index')->with('success', 'Attendance deleted successfully');
    }
}
