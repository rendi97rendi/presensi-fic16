<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{

    public function index()
    {
        $companies = Company::orderBy('id', 'desc')
            ->get();

        return response(['data' => $companies], 200);
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);

        return response(['data' => $company], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string',
            'email'     => 'required|email|unique:companies,email',
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

        $company = Company::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'address'   => $request->address,
            'latitude'  => $request->latitude,
            'longitude' => $request->longitude,
            'radius'    => $request->radius,
            'time_in'   => $request->time_in,
            'time_out'  => $request->time_out,
        ]);

        return response(['data' => $company], 200);
    }

    public function update(Request $request, Company $company)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:companies$companies,email,' . $company->id,
            'password'  => 'nullable|min:6|max:20',
            'phone'     => 'nullable|numeric|max_digits:15',
            'role'      => 'nullable|string',
            'position'  => 'nullable|string',
            'department' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $company->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'role'      => $request->role,
            'position'  => $request->position,
            'department'  => $request->department,
        ]);

        //if password filled
        if ($request->password) {
            $company->update([
                'password' => $request->password,
            ]);
        }

        return response(['data' => $company], 200);
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return response(['data' => $company], 200);
    }
}
