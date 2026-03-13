<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
      // [httpGet]
    public function show()
    {
        $categorys = Category::where('action_type', '!=', 'DELETE')
                            ->orderBy('category_id', 'desc')
                            ->get();
        
        $data = compact('categorys');

        return view('category.categoryList')->with($data);
    }


    // API [httpGet]
    public function getList()
    {
        $categorys = Category::where('action_type', '!=', 'DELETE')
                            ->orderBy('category_name')
                            ->get();
        
        return response()->json($categorys);
    }

    // [httpGet]
    public function create()
    {
        $category = new Category(); 

        $url = url('/category/create');
        $toptitle = 'Add Category';
        $data = compact('category','url', 'toptitle');
        return view('category.addCategory')->with($data);
    }

    // [httpPost]
    public function store(Request $request)
    {
        $request->validate(
            [
                'category_name' => 'required'
            ]
        );

        $category = new Category();

        $category->category_name = $request['category_name'];  
        $category->category_status =  $request['category_status'] ?? 'Active';  
        $category->action_type = 'INSERT';
        $category->user_id = $request->session()->get('loginId') ?? 'sys-user';
        $category->action_date = now();

        $category->save();

        return redirect('/category/list');
    }

    // [httpGet]
    public function delete($id, Request $request)
    {
        $category = Category::find($id);
        
        $category->action_type = 'DELETE';
        $category->user_id = $request->session()->get('loginId') ?? 'sys-user';
        $category->action_date = now();

        $category->save();

        return redirect('/category/list');
    }

    // [httpGet]
    public function edit($id)
    {
        $category = Category::find($id);

        if(is_null($category))
        {
            // category not found
            return redirect('/category/list');
        }
        else{
            $url = url('/category/update') ."/". $id;
            $toptitle = 'Edit Category';
          
            $data = compact('category','url', 'toptitle');
      
            return view('category.addCategory')->with($data);;
         
        }

    }

    // [httpPost]
    public function update($id, Request $request)
    {
        $request->validate(
            [
                'category_name' => 'required'
            ]
        );

        $category = Category::find($id);

        //$category->registration_date = $request['registration_date'];  
        $category->category_name = $request['category_name'];  
        $category->category_status =  $request['category_status'] ?? 'Active';  
        $category->action_type = 'UPDATE';
        $category->user_id = $request->session()->get('loginId') ?? 'sys-user';
        $category->action_date = now();

        $category->save();

        return redirect('/category/list');

    }
}
