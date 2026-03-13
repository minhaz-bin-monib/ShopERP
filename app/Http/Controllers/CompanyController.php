<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
        // [httpGet]
    public function show()
    {
        $companies = Company::where('action_type', '!=', 'DELETE')
                            ->orderBy('company_id', 'desc')
                            ->get();
        
        $data = compact('companies');

        return view('company.companyList')->with($data);
    }


    // API [httpGet]
    public function getList()
    {
        $companys = Company::where('action_type', '!=', 'DELETE')
                            ->orderBy('company_name')
                            ->get();
        
        return response()->json($companys);
    }

    // [httpGet]
    public function create()
    {
        $company = new Company(); 

        $url = url('/company/create');
        $toptitle = 'Add Company';
        $data = compact('company','url', 'toptitle');
        return view('company.addCompany')->with($data);
    }

    // [httpPost]
    public function store(Request $request)
    {
        $request->validate(
            [
                'company_name' => 'required'
            ]
        );

        $company = new Company();

        $company->company_name = $request['company_name'];  
        $company->company_code = $request['company_code'] ?? null;  
        $company->company_status =  $request['company_status'] ?? 'Active';  
        $company->action_type = 'INSERT';
        $company->user_id = $request->session()->get('loginId') ?? 'sys-user';
        $company->action_date = now();

        $company->save();

        return redirect('/company/list');
    }

    // [httpGet]
    public function delete($id, Request $request)
    {
        $company = Company::find($id);

        $company->action_type = 'DELETE';
        $company->user_id = $request->session()->get('loginId') ?? 'sys-user';
        $company->action_date = now();

        $company->save();

        return redirect('/company/list');
    }

    // [httpGet]
    public function edit($id)
    {
        $company = Company::find($id);

        if(is_null($company))
        {
            // company not found
            return redirect('/company/list');
        }
        else{
            $url = url('/company/update') ."/". $id;
            $toptitle = 'Edit Company';
          
            $data = compact('company','url', 'toptitle');
      
            return view('company.addCompany')->with($data);;
         
        }

    }

    // [httpPost]
    public function update($id, Request $request)
    {
        $request->validate(
            [
                'company_name' => 'required'
            ]
        );

        $company = Company::find($id);

        //$company->registration_date = $request['registration_date'];  
        $company->company_name = $request['company_name'];  
        $company->company_code = $request['company_code'] ?? null;  
        $company->company_status =  $request['company_status'] ?? 'Active';  
        $company->action_type = 'UPDATE';
        $company->user_id = $request->session()->get('loginId') ?? 'sys-user';
        $company->action_date = now();

        $company->save();

        return redirect('/company/list');

    }
}
