<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

date_default_timezone_set('Asia/Jakarta');

class AttendanceController extends Controller
{

    public function index()
    {
        $attendances = Attendance::orderBy('id', 'desc')
            ->get();

        return response(['data' => $attendances], 200);
    }

    public function checkIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date'      => 'nullable|date',
            'check_in'  => 'nullable|date_format:H:i:s',
            'latitude'  => 'required',
            'longitude' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $attendace = new Attendance();
        $attendace->user_id = $request->user()->id;
        $attendace->date = date('Y-m-d');
        $attendace->check_in = date('H:i:s');
        $attendace->lat_long_in = $request->latitude . ',' . $request->longitude;
        $attendace->save();

        return response(['data' => $attendace, 'message' => 'Check In Success'], 200);
    }

    public function checkOut(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date'      => 'nullable|date',
            'check_out'  => 'nullable|date_format:H:i:s',
            'latitude'  => 'required',
            'longitude' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $attendace = Attendance::where([['user_id', $request->user()->id], ['date', date('Y-m-d')]])->first();
        if (!$attendace) {
            return response(["message" => "CheckIn first"], 400);
        }

        $attendace->check_out = date('H:i:s');
        $attendace->lat_long_out = $request->latitude . ',' . $request->longitude;
        $attendace->save();

        return response(['data' => $attendace, 'message' => 'Check Out Success'], 200);
    }

    public function isCheckIn(Request $request)
    {
        $attendace = Attendance::where([['user_id', $request->user()->id], ['date', date('Y-m-d')]])->first();
        return response([
            'isCheckIn' => $attendace ? true : false
        ], 200);
    }
}
