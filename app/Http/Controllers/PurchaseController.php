<?php

namespace App\Http\Controllers;

use App\Models\Attributes;
use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseHistory;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    // [httpGet]
    public function show()
    {
        $purchases = DB::table('purchases as p')
            ->leftJoin('products as prod', 'p.product', '=', 'prod.product_id')
            ->leftJoin('suppliers as sup', 'p.supplier', '=', 'sup.supplier_id')
            ->select(
                'p.*',
                'prod.product_name',
                'sup.supplier_name'
            )
            ->where('p.action_type', '!=', 'DELETE')
            ->orderByDesc('p.purchase_id')
            ->get();

        $data = compact('purchases');

        return view('purchase.purchaseList')->with($data);
    }

    // [httpGet]
    public function create()
    {
        $purchase = new Purchase();
        $purchase->purchase_date = Carbon::now()->format('Y-m-d');
        $purchase->production_date = Carbon::now()->format('Y-m-d');
        $purchase->expiry_date = Carbon::now()->addYears(10)->format('Y-m-d');

        $products = Product::where('action_type', '!=', 'DELETE')
            ->orderBy('product_name')
            ->get();
        $suppliers = Supplier::where('action_type', '!=', 'DELETE')
            ->orderBy('supplier_name')
            ->get();
        $companies = Company::where('action_type', '!=', 'DELETE')
            ->orderBy('company_name')
            ->get();
        $categorys = Category::where('action_type', '!=', 'DELETE')
            ->orderBy('category_name')
            ->get();
        $aributes = Attributes::where('action_type', '!=', 'DELETE')
            ->orderBy('attribute_name')
            ->get();

        $latestChalan = DB::table('purchases as p')
            ->where('p.action_type', '!=', 'DELETE')
            ->orderByDesc('p.purchase_id')
            ->value('p.chalan_no');

        $recentPurchases = DB::table('purchases as p')
            ->leftJoin('products as prod', 'p.product', '=', 'prod.product_id')
            ->leftJoin('suppliers as sup', 'p.supplier', '=', 'sup.supplier_id')
            ->select(
                'p.*',
                'prod.product_name',
                'sup.supplier_name'
            )
            ->where('p.action_type', '!=', 'DELETE')
            ->where('p.chalan_no', $latestChalan)
            ->orderByDesc('p.purchase_id')
            ->get();

        $latestChalan = $latestChalan ?? 'N/A';
        $recentTotal = $recentPurchases->sum('total_price');

        $url = url('/purchase/create');
        $toptitle = 'Add Purchase';

        $data = compact(
            'purchase',
            'products',
            'suppliers',
            'companies',
            'categorys',
            'aributes',
            'recentPurchases',
            'latestChalan',
            'recentTotal',
            'url',
            'toptitle'
        );

        return view('purchase.addPurchase')->with($data);
    }

    // [httpGet]
    public function edit($id)
    {
        $purchase = Purchase::find($id);

        if (is_null($purchase)) {
            return redirect('/purchase/list');
        }

        $products = Product::where('action_type', '!=', 'DELETE')
            ->orderBy('product_name')
            ->get();
        $suppliers = Supplier::where('action_type', '!=', 'DELETE')
            ->orderBy('supplier_name')
            ->get();
        $companies = Company::where('action_type', '!=', 'DELETE')
            ->orderBy('company_name')
            ->get();
        $categorys = Category::where('action_type', '!=', 'DELETE')
            ->orderBy('category_name')
            ->get();
        $aributes = Attributes::where('action_type', '!=', 'DELETE')
            ->orderBy('attribute_name')
            ->get();

        $latestChalan = DB::table('purchases as p')
            ->where('p.action_type', '!=', 'DELETE')
            ->orderByDesc('p.purchase_id')
            ->value('p.chalan_no');

        $recentPurchases = DB::table('purchases as p')
            ->leftJoin('products as prod', 'p.product', '=', 'prod.product_id')
            ->leftJoin('suppliers as sup', 'p.supplier', '=', 'sup.supplier_id')
            ->select(
                'p.*',
                'prod.product_name',
                'sup.supplier_name'
            )
            ->where('p.action_type', '!=', 'DELETE')
            ->where('p.chalan_no', $latestChalan)
            ->orderByDesc('p.purchase_id')
            ->get();

        $latestChalan = $latestChalan ?? 'N/A';
        $recentTotal = $recentPurchases->sum('total_price');

        $url = url('/purchase/update') . "/" . $id;
        $toptitle = 'Edit Purchase';

        $data = compact(
            'purchase',
            'products',
            'suppliers',
            'companies',
            'categorys',
            'aributes',
            'recentPurchases',
            'latestChalan',
            'recentTotal',
            'url',
            'toptitle'
        );

        return view('purchase.addPurchase')->with($data);
    }

    // [httpPost]
    public function store(Request $request)
    {
        $request->validate([
            'purchase_date' => 'required|date',
            'chalan_no' => 'required|string|max:120',
            'product' => 'required',
            'quantity' => 'required|numeric',
            'unit_price' => 'nullable|numeric',
            'selling_price' => 'nullable|numeric',
            'total_price' => 'nullable|numeric'
        ]);

        $purchase = new Purchase();

        $purchase->purchase_date = $request['purchase_date'];
        $purchase->chalan_no = $request['chalan_no'];
        $purchase->update_stock = $request['update_stock'];
        $purchase->product = $request['product'];
        $purchase->quantity = $request['quantity'];
        $purchase->unit_price = $request['unit_price'];
        $purchase->profit_percent = $request['profit_percent'];
        $purchase->selling_price = $request['selling_price'];
        $totalPrice = $request['total_price'];
        if ($totalPrice === null || $totalPrice === '') {
            $qty = (float) ($request['quantity'] ?? 0);
            $unit = (float) ($request['unit_price'] ?? 0);
            $totalPrice = $qty * $unit;
        }
        $purchase->total_price = $totalPrice;
        $purchase->batch_no = $request['batch_no'];
        $purchase->production_date = $request['production_date'];
        $purchase->expiry_date = $request['expiry_date'];
        $purchase->adjustment_cost = $request['adjustment_cost'];
        $purchase->supplier = $request['supplier'];
        $purchase->receiver_name = $request['receiver_name'];
        $purchase->color = $request['color'];
        $purchase->size = $request['size'];
        $purchase->weight = $request['weight'];
        $purchase->material = $request['material'];
        $purchase->brands = $request['brands'];
        $purchase->category = $request['category'];
        $purchase->availability = $request['availability'] ?? 'Yes';
        $purchase->action_type = 'INSERT';
        $purchase->user_id = $request->session()->get('loginId') ?? 'sys-user';
        $purchase->action_date = now();

        $purchase->save();

        $this->logPurchaseHistory($purchase, 'INSERT', $request);

        return redirect('/purchase/create');
    }

    // [httpPost]
    public function update($id, Request $request)
    {
        $request->validate([
            'purchase_date' => 'required|date',
            'chalan_no' => 'required|string|max:120',
            'product' => 'required',
            'quantity' => 'required|numeric',
            'unit_price' => 'nullable|numeric',
            'selling_price' => 'nullable|numeric',
            'total_price' => 'nullable|numeric'
        ]);

        $purchase = Purchase::find($id);

        $purchase->purchase_date = $request['purchase_date'];
        $purchase->chalan_no = $request['chalan_no'];
        $purchase->update_stock = $request['update_stock'];
        $purchase->product = $request['product'];
        $purchase->quantity = $request['quantity'];
        $purchase->unit_price = $request['unit_price'];
        $purchase->profit_percent = $request['profit_percent'];
        $purchase->selling_price = $request['selling_price'];
        $totalPrice = $request['total_price'];
        if ($totalPrice === null || $totalPrice === '') {
            $qty = (float) ($request['quantity'] ?? 0);
            $unit = (float) ($request['unit_price'] ?? 0);
            $totalPrice = $qty * $unit;
        }
        $purchase->total_price = $totalPrice;
        $purchase->batch_no = $request['batch_no'];
        $purchase->production_date = $request['production_date'];
        $purchase->expiry_date = $request['expiry_date'];
        $purchase->adjustment_cost = $request['adjustment_cost'];
        $purchase->supplier = $request['supplier'];
        $purchase->receiver_name = $request['receiver_name'];
        $purchase->color = $request['color'];
        $purchase->size = $request['size'];
        $purchase->weight = $request['weight'];
        $purchase->material = $request['material'];
        $purchase->brands = $request['brands'];
        $purchase->category = $request['category'];
        $purchase->availability = $request['availability'] ?? 'Yes';
        $purchase->action_type = 'UPDATE';
        $purchase->user_id = $request->session()->get('loginId') ?? 'sys-user';
        $purchase->action_date = now();

        $purchase->save();

        $this->logPurchaseHistory($purchase, 'UPDATE', $request);

        return redirect('/purchase/list');
    }

    private function logPurchaseHistory(Purchase $purchase, string $actionType, Request $request)
    {
        $history = new PurchaseHistory();

        $history->purchase_id = $purchase->purchase_id;
        $history->purchase_date = $purchase->purchase_date;
        $history->chalan_no = $purchase->chalan_no;
        $history->update_stock = $purchase->update_stock;
        $history->product = $purchase->product;
        $history->quantity = $purchase->quantity;
        $history->unit_price = $purchase->unit_price;
        $history->profit_percent = $purchase->profit_percent;
        $history->selling_price = $purchase->selling_price;
        $history->total_price = $purchase->total_price;
        $history->batch_no = $purchase->batch_no;
        $history->production_date = $purchase->production_date;
        $history->expiry_date = $purchase->expiry_date;
        $history->adjustment_cost = $purchase->adjustment_cost;
        $history->supplier = $purchase->supplier;
        $history->receiver_name = $purchase->receiver_name;
        $history->color = $purchase->color;
        $history->size = $purchase->size;
        $history->weight = $purchase->weight;
        $history->material = $purchase->material;
        $history->brands = $purchase->brands;
        $history->category = $purchase->category;
        $history->availability = $purchase->availability;
        $history->action_type = $actionType;
        $history->user_id = $request->session()->get('loginId') ?? 'sys-user';
        $history->action_date = now();

        $history->save();
    }
}
