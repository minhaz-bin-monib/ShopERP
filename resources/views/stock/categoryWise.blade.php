@extends('layouts.main')

@push('title')
    <title>Category Wise Stock Report</title>
@endpush

@section('main-section')
    <style>
        .stock-report { max-width: 1320px; margin: 28px auto; }
        .stock-report-header { display: flex; justify-content: space-between; gap: 16px; align-items: flex-end; margin-bottom: 20px; }
        .stock-report-header h2 { margin: 0; font-weight: 700; color: #202a3a; }
        .stock-report-header p { margin: 5px 0 0; color: #6c757d; }
        .stock-filter-card, .stock-category-card { background: #fff; border: 1px solid #e5e8ec; border-radius: 10px; box-shadow: 0 3px 12px rgba(20, 37, 63, .05); }
        .stock-filter-card { padding: 18px; margin-bottom: 22px; }
        .stock-filter-card label { color: #475467; font-size: 13px; font-weight: 600; }
        .stock-filter-card .form-control, .stock-filter-card .form-select { min-height: 38px; }
        .stock-category-card { margin-bottom: 20px; overflow: hidden; }
        .stock-category-head { padding: 16px 20px; display: flex; justify-content: space-between; gap: 16px; align-items: center; background: #f8fafc; border-bottom: 1px solid #e5e8ec; }
        .stock-category-head h4 { margin: 0; color: #23395d; font-weight: 700; }
        .stock-summary { display: flex; flex-wrap: wrap; justify-content: flex-end; gap: 18px; color: #586474; font-size: 13px; }
        .stock-summary strong { color: #1f2937; }
        .stock-table { margin: 0; min-width: 920px; }
        .stock-table thead th { background: #fff; color: #475467; font-size: 12px; text-transform: uppercase; letter-spacing: .03em; white-space: nowrap; }
        .stock-table th, .stock-table td { padding: 12px 16px; border-color: #edf0f3; vertical-align: middle; }
        .stock-table tbody tr:last-child td { border-bottom: 0; }
        .stock-number { font-weight: 700; color: #1f2937; }
        .stock-status { display: inline-block; padding: 4px 9px; border-radius: 999px; font-size: 12px; font-weight: 700; }
        .stock-in { color: #176b3a; background: #e8f7ee; }
        .stock-low { color: #975d00; background: #fff4d6; }
        .stock-out { color: #a63232; background: #ffebeb; }
        .stock-empty { padding: 52px 20px; text-align: center; color: #6c757d; background: #fff; border: 1px dashed #ccd4dd; border-radius: 10px; }
        @media (max-width: 768px) { .stock-report-header, .stock-category-head { align-items: flex-start; flex-direction: column; } .stock-summary { justify-content: flex-start; } }
    </style>

    @php
        $formatQty = static function ($quantity): string {
            $quantity = (float) $quantity;
            return $quantity == (int) $quantity ? (string) (int) $quantity : rtrim(rtrim(number_format($quantity, 2, '.', ''), '0'), '.');
        };
    @endphp

    <div class="container-fluid stock-report">
        <div class="stock-report-header">
            <div>
                <h2>Category Wise Stock Report</h2>
                <p>Live available stock calculated from purchase and sales movements.</p>
            </div>
        </div>

        <form class="stock-filter-card" method="GET" action="{{ url('/stock-report/category-wise') }}">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="category">Category</label>
                    <select class="form-select" id="category" name="category">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}" @selected(($filters['category'] ?? null) == $category->category_id)>{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="search">Product Name or Code</label>
                    <input class="form-control" id="search" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Search product">
                </div>
                <div class="col-md-2">
                    <label for="stock_status">Stock Status</label>
                    <select class="form-select" id="stock_status" name="stock_status">
                        <option value="">All Stock</option>
                        <option value="in_stock" @selected(($filters['stock_status'] ?? '') === 'in_stock')>In Stock</option>
                        <option value="low_stock" @selected(($filters['stock_status'] ?? '') === 'low_stock')>Low Stock</option>
                        <option value="out_of_stock" @selected(($filters['stock_status'] ?? '') === 'out_of_stock')>Out of Stock</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button class="btn btn-primary flex-grow-1" type="submit">Filter</button>
                    <a class="btn btn-outline-secondary" href="{{ url('/stock-report/category-wise') }}">Reset</a>
                </div>
            </div>
        </form>

        @forelse ($categoryReports as $report)
            <section class="stock-category-card">
                <div class="stock-category-head">
                    <h4>{{ $report->name }}</h4>
                    <div class="stock-summary">
                        <span><strong>{{ $report->product_count }}</strong> Products</span>
                        <span><strong>{{ $formatQty($report->total_stock) }}</strong> Total Quantity</span>
                        <span>Stock Value: <strong>{{ number_format($report->stock_value, 2) }}</strong></span>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table stock-table">
                        <thead>
                            <tr><th>Product</th><th>Code</th><th>Unit</th><th class="text-end">Available Stock</th><th class="text-end">Purchase Price</th><th class="text-end">Selling Price</th><th class="text-end">Stock Value</th><th>Status</th></tr>
                        </thead>
                        <tbody>
                            @foreach ($report->products as $product)
                                @php
                                    $isOut = $product->current_stock <= 0;
                                    $isLow = !$isOut && $product->reminder_low !== null && $product->current_stock <= $product->reminder_low;
                                @endphp
                                <tr>
                                    <td class="stock-number">{{ $product->product_name }}</td>
                                    <td>{{ $product->product_code ?: '-' }}</td>
                                    <td>{{ $product->unit_type ?: '-' }}</td>
                                    <td class="text-end stock-number">{{ $formatQty($product->current_stock) }}</td>
                                    <td class="text-end">{{ number_format($product->purchase_price ?? 0, 2) }}</td>
                                    <td class="text-end">{{ number_format($product->selling_price ?? 0, 2) }}</td>
                                    <td class="text-end stock-number">{{ number_format($product->current_stock * ($product->purchase_price ?? 0), 2) }}</td>
                                    <td><span class="stock-status {{ $isOut ? 'stock-out' : ($isLow ? 'stock-low' : 'stock-in') }}">{{ $isOut ? 'Out of Stock' : ($isLow ? 'Low Stock' : 'In Stock') }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        @empty
            <div class="stock-empty">No products match the selected filters.</div>
        @endforelse
    </div>

    <script>
        const pageName = document.getElementById('PageName');
        if (pageName) pageName.innerText = 'Category Wise Stock Report';
    </script>
@endsection
