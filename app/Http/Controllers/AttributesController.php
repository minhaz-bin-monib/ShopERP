<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attributes;

class AttributesController extends Controller
{
      // [httpGet]
    public function show()
    {
        $attributes = Attributes::where('action_type', '!=', 'DELETE')
                            ->orderBy('attribute_id', 'desc')
                            ->get();
        
        $data = compact('attributes');

        return view('attributes.attributesList')->with($data);
    }


    // API [httpGet]
    public function getList()
    {
        $attributes = Attributes::where('action_type', '!=', 'DELETE')
                            ->orderBy('attributes_name')
                            ->get();
        
        return response()->json($attributes);
    }

    // [httpGet]
    public function create()
    {
        $attributes = new Attributes(); 

        $url = url('/attributes/create');
        $toptitle = 'Add Attributes';
        $data = compact('attributes','url', 'toptitle');
        return view('attributes.addAttributes')->with($data);
    }

    // [httpPost]
    public function store(Request $request)
    {
        $request->validate(
            [
                'attribute_name' => 'required'
            ]
        );

        $attributes = new Attributes();

        $attributes->attribute_name = $request['attribute_name'];  
        $attributes->attribute_category = $request['attribute_category'];  
        $attributes->attribute_status =  $request['attribute_status'] ?? 'Active';  
        $attributes->action_type = 'INSERT';
        $attributes->user_id = $request->session()->get('loginId') ?? 'sys-user';
        $attributes->action_date = now();

        $attributes->save();

        return redirect('/attributes/list');
    }

    // [httpGet]
    public function delete($id, Request $request)
    {
        $attributes = Attributes::find($id);
        
        $attributes->action_type = 'DELETE';
        $attributes->user_id = $request->session()->get('loginId') ?? 'sys-user';
        $attributes->action_date = now();

        $attributes->save();

        return redirect('/attributes/list');
    }

    // [httpGet]
    public function edit($id)
    {
        $attributes = Attributes::find($id);

        if(is_null($attributes))
        {
            // attributes not found
            return redirect('/attributes/list');
        }
        else{
            $url = url('/attributes/update') ."/". $id;
            $toptitle = 'Edit Attributes';
          
            $data = compact('attributes','url', 'toptitle');
      
            return view('attributes.addAttributes')->with($data);;
         
        }

    }

    // [httpPost]
    public function update($id, Request $request)
    {
        $request->validate(
            [
                'attribute_name' => 'required'
            ]
        );

        $attributes = Attributes::find($id);

        //$attributes->registration_date = $request['registration_date'];  
        $attributes->attribute_name = $request['attribute_name'];  
        $attributes->attribute_category = $request['attribute_category'];  
        $attributes->attribute_status =  $request['attribute_status'] ?? 'Active';  
        $attributes->action_type = 'UPDATE';
        $attributes->user_id = $request->session()->get('loginId') ?? 'sys-user';
        $attributes->action_date = now();

        $attributes->save();

        return redirect('/attributes/list');

    }
}
