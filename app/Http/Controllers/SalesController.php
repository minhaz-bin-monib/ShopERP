<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\SalesItem;
use App\Models\SalesOrder;
use App\Models\StockMovement;
use App\Models\User;
use App\Models\Attributes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    // [httpGet]
    public function create()
    {
        $sales = new SalesOrder();
        $sales->sales_date = Carbon::now()->format('Y-m-d');
        $sales->status = 'Paid';

        $products = Product::where('action_type', '!=', 'DELETE')
            ->orderBy('product_name')
            ->get();
        $customers = Customer::where('action_type', '!=', 'DELETE')
            ->orderBy('customer_name')
            ->get();
        $employees = User::orderBy('name')->get();
        $paymentMethods = Attributes::where('action_type', '!=', 'DELETE')
            ->where('attribute_status', '!=', 'Inactive')
            ->where('attribute_category', 'Payment Method')
            ->orderBy('attribute_name')
            ->get();

        $billNo = 'PM' . now()->format('YmdHis');
        $url = url('/sales/create');
        $toptitle = 'Sales Order';

        $data = compact('sales', 'products', 'customers', 'employees', 'billNo', 'url', 'toptitle', 'paymentMethods');

        return view('sales.addSales')->with($data);
    }

    // [httpPost]
    public function store(Request $request)
    {
        $request->validate([
            'sales_date' => 'required|date',
            'product_id' => 'required|array|min:1',
            'product_id.*' => 'required|exists:products,product_id',
            'qty' => 'required|array|min:1',
            'qty.*' => 'required|numeric|gt:0'
        ], [
            'product_id.required' => 'Please add at least one product.',
            'product_id.*.required' => 'Please select a product for each row.',
            'product_id.*.exists' => 'Selected product is not valid.',
            'qty.required' => 'Please add quantity for each product.',
            'qty.*.required' => 'Quantity is required for each product.',
            'qty.*.numeric' => 'Quantity must be a number.',
            'qty.*.gt' => 'Quantity must be greater than 0.'
        ]);

        $userId = $request->session()->get('loginId') ?? 'sys-user';

        $gross = 0;
        $items = [];
        foreach ($request->product_id as $index => $productId) {
            if (empty($productId)) {
                continue;
            }
            $product = Product::find($productId);
            $qty = (float) ($request->qty[$index] ?? 0);
            $price = $request->price[$index] ?? null;
            if ($price === null || $price === '') {
                $price = $product ? $product->selling_price : 0;
            }
            $price = (float) $price;
            $total = $qty * $price;
            $gross += $total;
            $items[] = [
                'product_id' => $productId,
                'product_name' => $product->product_name ?? null,
                'qty' => $qty,
                'price' => $price,
                'total' => $total,
                'remarks' => $request->remarks[$index] ?? null
            ];
        }
        if (count($items) === 0) {
            return back()->withErrors(['product_id' => 'Please add at least one valid product.'])->withInput();
        }

        $specialPercent = (float) ($request->special_discount_percent ?? 0);
        $manualPercent = (float) ($request->manual_discount_percent ?? 0);
        $specialAmount = ($gross * $specialPercent) / 100;
        $manualAmount = ($gross * $manualPercent) / 100;
        $netAmount = $gross - $specialAmount - $manualAmount;

        $sales = new SalesOrder();
        $sales->sales_date = $request['sales_date'];
        $sales->customer_id = $request['customer_id'];
        $sales->customer_name = $request['customer_name'];
        $sales->customer_address = $request['customer_address'];
        $sales->customer_phone = $request['customer_phone'];
        $sales->bill_no = $request['bill_no'];
        $sales->assistant_name = $request['assistant_name'];
        $sales->sold_by = $request['sold_by'] ?? $userId;
        $sales->reference = $request['reference'];
        $sales->special_discount_percent = $specialPercent;
        $sales->offer = $request['offer'];
        $sales->gross_amount = $gross;
        $sales->loyalty = $request['loyalty'];
        $sales->manual_discount_percent = $manualPercent;
        $sales->net_amount = $request['net_amount'] ?? $netAmount;
        $sales->payment_method = $request['payment_method'];
        $sales->payment_details = $request['payment_details'];
        $sales->bonus_card = $request['bonus_card'];
        $sales->given_amount = $request['given_amount'];
        $sales->paid_amount = $request['paid_amount'];
        $sales->new_paid_amount = $request['new_paid_amount'];
        $sales->payable_amount = $request['payable_amount'] ?? ($netAmount - (float) ($request['paid_amount'] ?? 0));
        $sales->status = $request['status'] ?? 'Paid';
        $sales->action_type = 'INSERT';
        $sales->user_id = $userId;
        $sales->action_date = now();
        $sales->save();

        foreach ($items as $item) {
            $salesItem = new SalesItem();
            $salesItem->sales_id = $sales->sales_id;
            $salesItem->product_id = $item['product_id'];
            $salesItem->product_name = $item['product_name'];
            $salesItem->qty = $item['qty'];
            $salesItem->price = $item['price'];
            $salesItem->total = $item['total'];
            $salesItem->remarks = $item['remarks'];
            $salesItem->action_type = 'INSERT';
            $salesItem->user_id = $userId;
            $salesItem->action_date = now();
            $salesItem->save();

            $movement = new StockMovement();
            $movement->product_id = $item['product_id'];
            $movement->movement_type = 'OUT';
            $movement->qty = $item['qty'];
            $movement->unit_cost = null;
            $movement->selling_price = $item['price'];
            $movement->ref_type = 'sales';
            $movement->ref_id = $sales->sales_id;
            $movement->user_id = $userId;
            $movement->action_date = now();
            $movement->save();
        }

        if ($request->input('action_print') === '1') {
            return redirect('/sales/create')->with('print_url', url('/sales/print/' . $sales->sales_id));
        }
        return redirect('/sales/list');
    }

    // [httpGet]
    public function show()
    {
        $sales = DB::table('sales_orders')
            ->orderByDesc('sales_id')
            ->get();

        $data = compact('sales');

        return view('sales.salesList')->with($data);
    }

    // [httpGet]
    public function print($id)
    {
        $sales = SalesOrder::find($id);
        if (!$sales) {
            return redirect('/sales/list');
        }
        $items = SalesItem::where('sales_id', $id)->get();

        $data = compact('sales', 'items');
        return view('sales.printInvoice')->with($data);
    }
}
