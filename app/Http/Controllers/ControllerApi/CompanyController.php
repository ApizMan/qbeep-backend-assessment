<?php

namespace App\Http\Controllers\ControllerApi;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = Company::all();

        return [
            'success' => true,
            'message' => 'All Company are retrieved',
            'data' => $company,
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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

        $company =  Company::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'logo' => $validate['logo'] ?? '',
            'website' => $validate['website'],
        ]);

        return [
            'success' => true,
            'message' => 'Successful created company',
            'data' => $company,
        ];
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'logo' => 'nullable',
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

        return [
            'success' => true,
            'message' => 'Successful updated company',
            'data' => $company,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::find($id);
        $company->delete();

        return [
            'success' => true,
            'message' => 'Successful deleted company',
            'data' => null,
        ];
    }
}
