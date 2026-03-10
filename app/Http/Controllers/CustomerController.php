<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Carbon\Carbon;

class CustomerController extends Controller
{
       // [httpGet]
    public function show()
    {
        $customers = Customer::where('action_type', '!=', 'DELETE')
                            ->orderBy('customer_id', 'desc')
                            ->get();
        
        $data = compact('customers');

        return view('customer.customerList')->with($data);
    }


    // API [httpGet]
    public function getList()
    {
        $customers = Customer::where('action_type', '!=', 'DELETE')
                            ->orderBy('customer_name')
                            ->get();
        
        return response()->json($customers);
    }

    // [httpGet]
    public function create()
    {
        $customer = new Customer(); 
        $customer->registration_date = Carbon::now()->format('Y-m-d');
        $url = url('/customer/create');
        $toptitle = 'Add Customer';
        $data = compact('customer','url', 'toptitle');
        return view('customer.addCustomer')->with($data);
    }

    // [httpPost]
   public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required'
        ]);

        $customer = new Customer();

        $customer->registration_date = $request['registration_date'];
        $customer->customer_name = $request['customer_name'];
        $customer->customer_code = $request['customer_code'];
        $customer->proprietor_name = $request['proprietor_name'];
        $customer->profession = $request['profession'];
        $customer->organization_name = $request['organization_name'];
        $customer->customer_fathers_name = $request['customer_fathers_name'];
        $customer->customer_type = $request['customer_type'];
        $customer->customer_discount = $request['customer_discount'];
        $customer->customer_dob = $request['customer_dob'];
        $customer->customer_phone = $request['customer_phone'];
        $customer->customer_nid = $request['customer_nid'];
        $customer->customer_zone = $request['customer_zone'];
        $customer->customer_reminder = $request['customer_reminder'];
        $customer->customer_address = $request['customer_address'];
        $customer->customer_note = $request['customer_note'];

        $customer->customer_status = $request['customer_status'] ?? 'Active';

        // system fields
        $customer->action_type = 'INSERT';
        $customer->user_id = 'sys-user';
        $customer->action_date = now();

        $customer->save();

        return redirect('/customer/list');
    }

    // [httpGet]
    public function delete($id)
    {
        $customer = Customer::find($id);
        
        $customer->action_type = 'DELETE';
        $customer->action_date = now();

        $customer->save();

        return redirect('/customer/list');
    }

    // [httpGet]
    public function edit($id)
    {
        $customer = Customer::find($id);

        if(is_null($customer))
        {
            // customer not found
            return redirect('/customer/list');
        }
        else{
            $url = url('/customer/update') ."/". $id;
            $toptitle = 'Edit Customer';
          
            $data = compact('customer','url', 'toptitle');
      
            return view('customer.addCustomer')->with($data);;
         
        }

    }

    // [httpPost]
    public function update($id, Request $request)
    {
        $request->validate(
            [
                'customer_name' => 'required'
            ]
        );

        $customer = Customer::find($id);

        $customer->registration_date = $request['registration_date'];
        $customer->customer_name = $request['customer_name'];
        $customer->customer_code = $request['customer_code'];
        $customer->proprietor_name = $request['proprietor_name'];
        $customer->profession = $request['profession'];
        $customer->organization_name = $request['organization_name'];
        $customer->customer_fathers_name = $request['customer_fathers_name'];
        $customer->customer_type = $request['customer_type'];
        $customer->customer_discount = $request['customer_discount'];
        $customer->customer_dob = $request['customer_dob'];
        $customer->customer_phone = $request['customer_phone'];
        $customer->customer_nid = $request['customer_nid'];
        $customer->customer_zone = $request['customer_zone'];
        $customer->customer_reminder = $request['customer_reminder'];
        $customer->customer_address = $request['customer_address'];
        $customer->customer_note = $request['customer_note'];
        $customer->customer_status = $request['customer_status'] ?? 'Active';
        $customer->action_type = 'UPDATE';
        $customer->user_id = 'sys-user';
        $customer->action_date = now();

        $customer->save();

        return redirect('/customer/list');

    }
}
