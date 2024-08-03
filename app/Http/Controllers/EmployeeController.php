<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        return view('components.create-employee', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_id' => 'required',
            'email' => 'nullable|email|unique:companies',
            'phone' => 'nullable|numeric',
        ]);

        Employee::create([
            'first_name' => $validate['first_name'],
            'last_name' => $validate['last_name'],
            'company_id' => $validate['company_id'],
            'email' => $validate['email'],
            'phone' => $validate['phone'],
        ]);

        // dd($company);

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
        $employee = Employee::find($id);
        $companies = Company::all();
        return view('components.edit-employee', compact(['employee', 'companies']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_id' => 'required',
            'email' => 'nullable|email|unique:companies',
            'phone' => 'nullable|numeric',
        ]);

        $employee = Employee::find($id);
        $employee->update([
            'first_name' => $validate['first_name'],
            'last_name' => $validate['last_name'],
            'company_id' => $validate['company_id'],
            'email' => $validate['email'],
            'phone' => $validate['phone'],
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect()->route('dashboard');
    }
}
