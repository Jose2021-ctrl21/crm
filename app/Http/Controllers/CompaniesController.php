<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Companies;
use App\Mail\CompanyCreated;


class CompaniesController extends Controller
{
    public function index(){
        $data = Companies::all();
        // dd($data);
        return view('companies',['companies' => $data]);
    } 


    
    public function create(Request $request) {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'website' => 'required|string|url|max:2048',
        ]);
    
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public', $filename);
            $data['logo'] = $filename;
        }
    
        $newCompany = Companies::create($data);
    
        if ($newCompany) {
            // dd($newCompany); 
            Mail::to($newCompany->email)->send(new CompanyCreated($newCompany));
            return redirect(route('companies.index'))->with('success', 'Company created successfully.');
        }
         else {
            return redirect()->back()->with('error', 'Failed to create company.');
        }
    }
    

    public function edit($id){
        $data = Companies::find($id);
        return response()->json([
            'status' => 200,
            'companies' => $data,
        ]);
    }

    public function update(Request $request){
        $request->validate([
            'company_name' => 'required', // Ensure employee_id exists in employees table
            'website' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('companies')->ignore($request->input('company_id')), // Ensure email is unique except for the current employee
            ],
        ]);

        
        // Fetch the company to update
        $company = Companies::find($request->input('company_id'));
        
        // Check if company exists
        if (!$company) {
            return redirect()->back()->with('error', 'Employee not found.');
        }

        // Update the employee attributes
        $company->update([
            'company_name' => $request->input('company_name'),
            'email' => $request->input('email'),
            'website' => $request->input('website'),
        ]);

        return redirect(route('companies.index'))->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        $company = Companies::find($id);

        if ($company) {
            $company->delete();
            return response()->json(['success' => 'Company deleted successfully.']);
        } else {
            return response()->json(['error' => 'Company not found.'], 404);
        }
    }

}
