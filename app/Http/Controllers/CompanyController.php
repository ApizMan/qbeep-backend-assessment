<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $company = Company::find($id);
        $employee = Employee::where('company_id', $id)->get();

        return [
            'success' => true,
            'message' => 'All Employee are retrieved',
            'data' => [
                'company' => $company,
                'employee' => $employee,
            ]
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.create-company');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:companies',
            'logo' => 'nullable|image',
            'website' => 'nullable|url',
        ]);

        // dd($validate);
        if ($request->hasFile('logo')) {
            $destination_path = 'public/images/companies';
            $image = $request->file('logo');
            $image_name = $image->getClientOriginalName();
            $request->file('logo')->storeAs($destination_path, $image_name);
            $validate['logo'] = $image_name;
        }

        Company::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'logo' => $validate['logo'] ?? '',
            'website' => $validate['website'],
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::find($id);
        return view('components.edit-company', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'logo' => 'nullable|image',
            'website' => 'nullable|url',
        ]);

        // dd($validate);
        if ($request->hasFile('logo')) {
            $destination_path = 'public/images/companies';
            $image = $request->file('logo');
            $image_name = $image->getClientOriginalName();
            $request->file('logo')->storeAs($destination_path, $image_name);
            $validate['logo'] = $image_name;
        }

        $company = Company::find($id);
        $company->update([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'logo' => $validate['logo'],
            'website' => $validate['website'],
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::find($id);
        $company->delete();
        return redirect()->route('dashboard');
    }
}
