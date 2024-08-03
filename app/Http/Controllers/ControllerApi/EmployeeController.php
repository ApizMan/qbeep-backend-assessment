<?php

namespace App\Http\Controllers\ControllerApi;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee = Employee::all();

        return [
            'success' => true,
            'message' => 'All Employee are retrieved',
            'data' => $employee,
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

        $employee = Employee::create([
            'first_name' => $validate['first_name'],
            'last_name' => $validate['last_name'],
            'company_id' => $validate['company_id'],
            'email' => $validate['email'],
            'phone' => $validate['phone'],
        ]);

        return [
            'success' => true,
            'message' => 'Successfully Created Employee',
            'data' => $employee,
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

        return [
            'success' => true,
            'message' => 'Successfully Updated Employee',
            'data' => $employee,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        $employee->delete();

        return [
            'success' => true,
            'message' => 'Successfully Deleted Employee',
            'data' => null,
        ];
    }
}
