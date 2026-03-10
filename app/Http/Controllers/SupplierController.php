<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Carbon\Carbon;

class SupplierController extends Controller
{
    // [httpGet]
    public function show()
    {
        $suppliers = Supplier::where('action_type', '!=', 'DELETE')
            ->orderBy('supplier_id', 'desc')
            ->get();

        $data = compact('suppliers');

        return view('supplier.supplierList')->with($data);
    }


    // API [httpGet]
    public function getList()
    {
        $suppliers = Supplier::where('action_type', '!=', 'DELETE')
            ->orderBy('supplier_name')
            ->get();

        return response()->json($suppliers);
    }

    // [httpGet]
    public function create()
    {
        $supplier = new Supplier();
        $supplier->registration_date = Carbon::now()->format('Y-m-d');
        $url = url('/supplier/create');
        $toptitle = 'Add Supplier';
        $data = compact('supplier', 'url', 'toptitle');
        return view('supplier.addSupplier')->with($data);
    }

    // [httpPost]
    public function store(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required'
        ]);

        $supplier = new Supplier();

        $supplier->registration_date = $request['registration_date'];
        $supplier->supplier_name = $request['supplier_name'];
        $supplier->proprietor_name = $request['proprietor_name'];
        $supplier->supplier_dob = $request['supplier_dob'];
        $supplier->supplier_phone = $request['supplier_phone'];
        $supplier->supplier_nid = $request['supplier_nid'];
        $supplier->supplier_remark = $request['supplier_remark'];
        $supplier->supplier_address = $request['supplier_address'];
        $supplier->supplier_reminder = $request['supplier_reminder'];
        $supplier->supplier_note = $request['supplier_note'];
        $supplier->supplier_status = $request['supplier_status'] ?? 'Active';
        $supplier->action_type = 'INSERT';
        $supplier->user_id = 'sys-user';
        $supplier->action_date = now();

        $supplier->save();

        return redirect('/supplier/list');
    }
    // [httpGet]
    public function delete($id)
    {
        $supplier = Supplier::find($id);

        $supplier->action_type = 'DELETE';
        $supplier->action_date = now();

        $supplier->save();

        return redirect('/supplier/list');
    }

    // [httpGet]
    public function edit($id)
    {
        $supplier = Supplier::find($id);

        if (is_null($supplier)) {
            // supplier not found
            return redirect('/supplier/list');
        } else {
            $url = url('/supplier/update') . "/" . $id;
            $toptitle = 'Edit Supplier';

            $data = compact('supplier', 'url', 'toptitle');

            return view('supplier.addSupplier')->with($data);
            ;

        }

    }

    // [httpPost]
    public function update($id, Request $request)
    {
        $request->validate(
            [
                'supplier_name' => 'required'
            ]
        );

        $supplier = Supplier::find($id);

        //$supplier->registration_date = $request['registration_date'];  
        $supplier->registration_date = $request['registration_date'];
        $supplier->supplier_name = $request['supplier_name'];
        $supplier->proprietor_name = $request['proprietor_name'];
        $supplier->supplier_dob = $request['supplier_dob'];
        $supplier->supplier_phone = $request['supplier_phone'];
        $supplier->supplier_nid = $request['supplier_nid'];
        $supplier->supplier_remark = $request['supplier_remark'];
        $supplier->supplier_address = $request['supplier_address'];
        $supplier->supplier_reminder = $request['supplier_reminder'];
        $supplier->supplier_note = $request['supplier_note'];
        $supplier->supplier_status = $request['supplier_status'] ?? 'Active';
        $supplier->action_type = 'UPDATE';
        $supplier->user_id = 'sys-user';
        $supplier->action_date = now();

        $supplier->save();

        return redirect('/supplier/list');

    }
}
