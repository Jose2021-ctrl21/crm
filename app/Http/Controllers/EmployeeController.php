<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Employees; // Import the Employee model
use App\Models\Companies;
class EmployeeController extends Controller
{
    public function index()
    {
        $companies = Companies::all(); // Fetch all companies
        $employees = Employees::with('company')->get();
        
        // Pass both datasets to the view
        return view('employees', [
            'companies' => $companies,
            'employees' => $employees
        ]);
    }
    
    
    public function create_employee(Request $request)
    {
        // Validate the request data
        $data = $request->validate([
            'company_id' => 'required|exists:companies,id', // Ensure company_id exists in companies table
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email', // Ensure email is unique
            'phone' => 'nullable|string|max:255',
        ]);
    
        // Create a new employee record
        $newEmployee = Employees::create($data);
    
        // Check if the employee was successfully created
        if ($newEmployee) {
            // Redirect back with a success message
            return redirect(route('employees.index'))->with('success', 'Employee created successfully.');
        } else {
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Failed to create employee.');
        }
    }
    public function edit($id)
    {
        $data = Employees::find($id);
        return response()->json([
            'status' => 200,
            'employees' => $data,
        ]);
    }


        public function update(Request $request)
    {
        // Validate the request data
        $request->validate([
            'employee_id' => 'required|exists:employees,id', // Ensure employee_id exists in employees table
            'company_id' => 'required|exists:companies,id', // Ensure company_id exists in companies table
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('employees')->ignore($request->input('employee_id')), // Ensure email is unique except for the current employee
            ],
            'phone' => 'nullable|string|max:255',
        ]);

        // Fetch the employee to update
        $employee = Employees::find($request->input('employee_id'));
        
        // Check if employee exists
        if (!$employee) {
            return redirect()->back()->with('error', 'Employee not found.');
        }

        // Update the employee attributes
        $employee->update([
            'company_id' => $request->input('company_id'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        return redirect(route('employees.index'))->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        $employee = Employees::find($id);

        if ($employee) {
            $employee->delete();
            return response()->json(['success' => 'Employee deleted successfully.']);
        } else {
            return response()->json(['error' => 'Employee not found.'], 404);
        }
    }

    public function viewProfile($id)
    {
        $data = Employees::with('company')->find($id);
        return response()->json([
            'status' => 200,
            'employees' => $data,
            'company_name' => $data->company->company_name,
        ]);
    }

    
}
