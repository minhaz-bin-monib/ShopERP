<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockReportController extends Controller
{
    public function categoryWise(Request $request)
    {
        $filters = $request->validate([
            'category' => ['nullable', 'integer'],
            'search' => ['nullable', 'string', 'max:150'],
            'stock_status' => ['nullable', 'in:in_stock,low_stock,out_of_stock'],
        ]);

        $stockTotals = DB::table('stock_movements')
            ->selectRaw("product_id, SUM(CASE WHEN movement_type = 'OUT' THEN -COALESCE(qty, 0) ELSE COALESCE(qty, 0) END) AS current_stock")
            ->groupBy('product_id');

        $products = DB::table('products')
            ->leftJoin('categories', function ($join) {
                $join->on('products.category', '=', 'categories.category_id')
                    ->where('categories.action_type', '!=', 'DELETE');
            })
            ->leftJoinSub($stockTotals, 'stock_totals', function ($join) {
                $join->on('products.product_id', '=', 'stock_totals.product_id');
            })
            ->where('products.action_type', '!=', 'DELETE')
            ->select(
                'products.product_id',
                'products.product_name',
                'products.product_code',
                'products.unit_type',
                'products.purchase_price',
                'products.selling_price',
                'products.reminder_low',
                'products.product_status',
                'categories.category_id',
                'categories.category_name'
            )
            ->selectRaw('COALESCE(stock_totals.current_stock, 0) AS current_stock');

        if (!empty($filters['category'])) {
            $products->where('products.category', $filters['category']);
        }

        if (!empty($filters['search'])) {
            $search = trim($filters['search']);
            $products->where(function ($query) use ($search) {
                $query->where('products.product_name', 'like', "%{$search}%")
                    ->orWhere('products.product_code', 'like', "%{$search}%");
            });
        }

        if (($filters['stock_status'] ?? null) === 'in_stock') {
            $products->having('current_stock', '>', 0);
        }

        if (($filters['stock_status'] ?? null) === 'low_stock') {
            $products->having('current_stock', '>', 0)
                ->havingRaw('reminder_low IS NOT NULL AND current_stock <= reminder_low');
        }

        if (($filters['stock_status'] ?? null) === 'out_of_stock') {
            $products->having('current_stock', '<=', 0);
        }

        $products = $products
            ->orderByRaw('COALESCE(categories.category_name, \'Uncategorized\')')
            ->orderBy('products.product_name')
            ->get();

        $categoryReports = $products
            ->groupBy(fn ($product) => $product->category_id ? "category-{$product->category_id}" : 'uncategorized')
            ->map(function ($categoryProducts) {
                return (object) [
                    'name' => $categoryProducts->first()->category_name ?? 'Uncategorized',
                    'products' => $categoryProducts,
                    'product_count' => $categoryProducts->count(),
                    'total_stock' => $categoryProducts->sum('current_stock'),
                    'stock_value' => $categoryProducts->sum(
                        fn ($product) => (float) $product->current_stock * (float) ($product->purchase_price ?? 0)
                    ),
                ];
            })
            ->values();

        $categories = Category::where('action_type', '!=', 'DELETE')
            ->orderBy('category_name')
            ->get();

        return view('stock.categoryWise', compact('categoryReports', 'categories', 'filters'));
    }
}
