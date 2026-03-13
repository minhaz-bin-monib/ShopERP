<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Models\Category;
use App\Models\Attributes;
use App\Models\Supplier;

class ProductController extends Controller
{
    // [httpGet]
    public function show()
    {
        $products = Product::where('action_type', '!=', 'DELETE')
            ->orderBy('product_id', 'desc')
            ->get();

        $data = compact('products');

        return view('product.productList')->with($data);
    }


    // API [httpGet]
    public function getList()
    {
        $products = Product::where('action_type', '!=', 'DELETE')
            ->orderBy('product_name')
            ->get();

        return response()->json($products);
    }

    // [httpGet]
    public function create()
    {
        $product = new Product();

        $companyes = Company::where('action_type', '!=', 'DELETE')
            ->orderBy('company_name')
            ->get();

        $aributes = Attributes::where('action_type', '!=', 'DELETE')
            ->orderBy('attribute_name')
            ->get();
        $categorys = Category::where('action_type', '!=', 'DELETE')
            ->orderBy('category_name')
            ->get();
        $suppliers = Supplier::where('action_type', '!=', 'DELETE')
            ->orderBy('supplier_name')
            ->get();

        $company = $companyes;
        $supplier = $suppliers;
        $category = $categorys;
       


        $url = url('/product/create');
        $toptitle = 'Add Product';
        $data = compact(
            'product',
            'url',
            'toptitle',
            'company',
            'supplier',
            'aributes',
            'category'
        );
        return view('product.addProduct')->with($data);
    }

    // [httpPost]
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required'
        ]);

        $product = new Product();

        $product->product_name = $request['product_name'];
        $product->unit_type = $request['unit_type'];
        $product->product_code = $request['product_code'];
        $product->purchase_price = $request['purchase_price'];
        $product->selling_price = $request['selling_price'];
        $product->reminder_high = $request['reminder_high'];
        $product->reminder_low = $request['reminder_low'];
        $product->company = $request['company'];
        $product->department = $request['department'];
        $product->supplier = $request['supplier'];
        $product->color = $request['color'];
        $product->size = $request['size'];
        $product->weight = $request['weight'];
        $product->material = $request['material'];
        $product->brands = $request['brands'];
        $product->category = $request['category'];
        $product->product_status = $request['product_status'] ?? 'Active';
        $product->action_type = 'INSERT';
        $product->user_id = $request->session()->get('loginId') ?? 'sys-user';
        $product->action_date = now();

        $product->save();

        return redirect('/product/list');
    }

    // [httpGet]
    public function delete($id, Request $request)
    {
        $product = Product::find($id);

        $product->action_type = 'DELETE';
        $product->user_id = $request->session()->get('loginId') ?? 'sys-user';
        $product->action_date = now();

        $product->save();

        return redirect('/product/list');
    }

    // [httpGet]
    public function edit($id)
    {
        $product = Product::find($id);

        $companyes = Company::where('action_type', '!=', 'DELETE')
            ->orderBy('company_name')
            ->get();

        $aributes = Attributes::where('action_type', '!=', 'DELETE')
            ->orderBy('attribute_name')
            ->get();
        $categorys = Category::where('action_type', '!=', 'DELETE')
            ->orderBy('category_name')
            ->get();
        $suppliers = Supplier::where('action_type', '!=', 'DELETE')
            ->orderBy('supplier_name')
            ->get();

        $company = $companyes;
        $supplier = $suppliers;
        $category = $categorys;


        if (is_null($product)) {
            // product not found
            return redirect('/product/list');
        } else {
            $url = url('/product/update') . "/" . $id;
            $toptitle = 'Edit Product';

            $data = compact(
                'product',
                'url',
                'toptitle',
               'company',
            'supplier',
            'aributes',
            'category'
            );

            return view('product.addProduct')->with($data);
            ;

        }

    }

    // [httpPost]
    public function update($id, Request $request)
    {
        $request->validate(
            [
                'product_name' => 'required'
            ]
        );

        $product = Product::find($id);

        //$product->registration_date = $request['registration_date'];  
        $product->product_name = $request['product_name'];
        $product->unit_type = $request['unit_type'];
        $product->product_code = $request['product_code'];
        $product->purchase_price = $request['purchase_price'];
        $product->selling_price = $request['selling_price'];
        $product->reminder_high = $request['reminder_high'];
        $product->reminder_low = $request['reminder_low'];
        $product->company = $request['company'];
        $product->department = $request['department'];
        $product->supplier = $request['supplier'];
        $product->color = $request['color'];
        $product->size = $request['size'];
        $product->weight = $request['weight'];
        $product->material = $request['material'];
        $product->brands = $request['brands'];
        $product->category = $request['category'];
        $product->product_status = $request['product_status'] ?? 'Active';
        $product->action_type = 'UPDATE';
        $product->user_id = $request->session()->get('loginId') ?? 'sys-user';
        $product->action_date = now();

        $product->save();

        return redirect('/product/list');

    }
}
