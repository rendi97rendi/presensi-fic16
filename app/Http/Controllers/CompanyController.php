<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::where('name', 'like', "%" . request('name') . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('pages.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

        return redirect()->route('companies.index')->with('success', 'Company created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
        return view('pages.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:companies,email,' . $company->id,
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

        $company->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'address'   => $request->address,
            'latitude'  => $request->latitude,
            'longitude' => $request->longitude,
            'radius'    => $request->radius,
            'time_in'   => $request->time_in,
            'time_out'  => $request->time_out,
        ]);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully');
    }
}
