@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Purchase</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Manrope:wght@300;400;500;600;700&display=swap');

        :root {
            --ink: #1f1b16;
            --ink-soft: #3a332c;
            --sea: #2f6f74;
            --sea-soft: #7cc9b0;
            --sun: #f7c243;
            --paper: #fffdf9;
            --line: #eadfce;
            --shadow: 0 18px 50px rgba(28, 23, 16, 0.12);
        }

        .purchase-page {
            min-height: 72vh;
            padding: 20px 8px 50px;
        }

        .purchase-shell {
            background: var(--paper);
            border-radius: 22px;
            box-shadow: var(--shadow);
            border: 1px solid var(--line);
            overflow: hidden;
        }

        .purchase-hero {
            background: linear-gradient(160deg, #2f6f74, #3c8f8a);
            color: #ffffff;
            padding: 16px 22px;
        }

        .purchase-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.18);
            border-radius: 999px;
            padding: 6px 14px;
            font-family: 'Manrope', Arial, sans-serif;
            font-size: 18px;
        }

        .purchase-badge span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--sun);
        }

        .purchase-body {
            padding: 10px 12px 18px;
        }

        .purchase-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.1fr) minmax(0, 1fr);
            gap: 12px;
            align-items: start;
        }

        .purchase-card {
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 10px 12px 12px;
        }

        .purchase-card-title {
            font-family: 'DM Serif Display', Georgia, serif;
            font-size: 22px;
            color: var(--ink);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .purchase-card-title span {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--sun);
            box-shadow: 0 0 0 6px rgba(247, 194, 67, 0.2);
            flex: none;
        }

        .purchase-form label {
            font-family: 'Manrope', Arial, sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: var(--ink);
        }

        .purchase-section {
            border: 1px dashed rgba(234, 223, 206, 0.9);
            border-radius: 14px;
            padding: 10px 12px 12px;
            margin-bottom: 12px;
            background: #fffcf7;
        }

        .purchase-section-title {
            font-family: 'Manrope', Arial, sans-serif;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.6px;
            text-transform: uppercase;
            color: rgba(31, 27, 22, 0.6);
            margin-bottom: 8px;
        }

        .purchase-form .form-control,
        .purchase-form select {
            border-radius: 12px;
            border: 1px solid #e8dcca;
            background: #fffdf9;
            height: 38px;
            padding: 6px 10px;
            font-family: 'Manrope', Arial, sans-serif;
            font-size: 14px;
        }

        .purchase-form textarea.form-control {
            height: auto;
            min-height: 90px;
        }

        .purchase-form .form-control:focus,
        .purchase-form select:focus {
            border-color: var(--sea);
            box-shadow: 0 0 0 3px rgba(47, 111, 116, 0.15);
        }

        .purchase-actions {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-top: 8px;
        }

        .purchase-btn {
            background: linear-gradient(135deg, #2f6f74, #7cc9b0);
            border: none;
            color: #ffffff;
            font-family: 'Manrope', Arial, sans-serif;
            font-weight: 700;
            padding: 8px 18px;
            border-radius: 999px;
            box-shadow: 0 14px 30px rgba(47, 111, 116, 0.3);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            font-size: 14px;
        }

        .purchase-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 38px rgba(47, 111, 116, 0.35);
        }

        .purchase-muted {
            font-family: 'Manrope', Arial, sans-serif;
            color: rgba(31, 27, 22, 0.7);
            font-size: 14px;
        }

        .purchase-table-wrap {
            margin-top: 8px;
        }

        #recentTable {
            width: 100%;
            font-family: 'Manrope', Arial, sans-serif;
            font-size: 13px;
            color: var(--ink);
        }

        #recentTable thead th {
            border: 1px solid rgba(78, 70, 60, 0.12);
            background: transparent;
            font-weight: 600;
            color: var(--ink-soft);
            padding: 6px 8px;
        }

        #recentTable tbody td {
            border: 1px solid rgba(78, 70, 60, 0.1);
            padding: 6px 8px;
        }

        .cat-edit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 10px;
            background: rgba(47, 111, 116, 0.12);
            color: var(--sea);
            transition: transform 0.2s ease, background 0.2s ease;
        }

        .cat-edit:hover {
            transform: translateY(-1px);
            background: rgba(47, 111, 116, 0.2);
            color: var(--sea);
            text-decoration: none;
        }

        .purchase-total {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 10px;
            border-top: 1px dashed var(--line);
            margin-top: 10px;
            font-family: 'Manrope', Arial, sans-serif;
            font-size: 14px;
            color: var(--ink-soft);
        }

        .purchase-total strong {
            color: var(--ink);
        }

        .purchase-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border-radius: 12px;
            border: 1px solid var(--line);
            background: #fffdf9;
            font-family: 'Manrope', Arial, sans-serif;
            font-size: 14px;
        }

        .purchase-toggle input {
            width: 18px;
            height: 18px;
            accent-color: var(--sea);
        }

        @media (max-width: 991px) {
            .purchase-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="container-fluid purchase-page">
        <div class="purchase-shell">
            <div class="purchase-hero">
                <div class="purchase-badge">
                    <span></span>
                    {{ $toptitle }}
                </div>
            </div>

            <div class="purchase-body">
                @php
                    $color = $aributes->filter(fn($a) => $a->attribute_category == 'Color')->values();
                    $size = $aributes->filter(fn($a) => $a->attribute_category == 'Size')->values();
                    $weight = $aributes->filter(fn($a) => $a->attribute_category == 'Weight')->values();
                    $material = $aributes->filter(fn($a) => $a->attribute_category == 'Material')->values();
                    $brands = $companies;
                @endphp

                <div class="purchase-grid">
                    <div class="purchase-card purchase-form">
                        <div class="purchase-card-title"><span></span>Purchase Details</div>

                        <form action="{{ $url }}" method="post">
                            @csrf

                            <div class="form-row">
                                <div class="purchase-section">
                                    <div class="purchase-section-title">Chalan Area</div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Purchase Date <span class="text-danger"><b>*</b></span></label>
                                            <input type="date" name="purchase_date"
                                                value="{{ old('purchase_date', $purchase->purchase_date ?? '') }}" class="form-control">
                                            <span class="text-danger">
                                                @error('purchase_date')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Chalan Details <span class="text-danger"><b>*</b></span></label>
                                            <input type="text" name="chalan_no"
                                                value="{{ old('chalan_no', $purchase->chalan_no ?? '') }}" class="form-control"
                                                placeholder="A303">
                                            <span class="text-danger">
                                                @error('chalan_no')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Supplier</label>
                                            <select name="supplier" class="form-control">
                                                <option value="">Select Supplier</option>
                                                @foreach ($suppliers as $sup)
                                                    <option value="{{ $sup['supplier_id'] }}" {{ old('supplier', $purchase->supplier ?? '') == $sup['supplier_id'] ? 'selected' : '' }}>
                                                        {{ $sup['supplier_name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Receiver Name</label>
                                            <input type="text" name="receiver_name"
                                                value="{{ old('receiver_name', $purchase->receiver_name ?? '') }}" class="form-control"
                                                placeholder="Enter Receiver name">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Update Stock</label>
                                            <input type="number" step="0.01" name="update_stock"
                                                value="{{ old('update_stock', $purchase->update_stock ?? '') }}" class="form-control"
                                                placeholder="Enter stock value">
                                        </div>
                                    </div>
                                </div>

                                <div class="purchase-section">
                                    <div class="purchase-section-title">Product Buy & Sales</div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Select Product <span class="text-danger"><b>*</b></span></label>
                                            <select name="product" class="form-control" id="purchaseProduct">
                                                <option value="">Select Product</option>
                                                @foreach ($products as $prod)
                                                    <option value="{{ $prod['product_id'] }}"
                                                        data-unit-price="{{ $prod['purchase_price'] ?? '' }}"
                                                        {{ old('product', $purchase->product ?? '') == $prod['product_id'] ? 'selected' : '' }}>
                                                        {{ $prod['product_name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">
                                                @error('product')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Quantity <span class="text-danger"><b>*</b></span></label>
                                            <input type="number" step="0.01" name="quantity"
                                                value="{{ old('quantity', $purchase->quantity ?? '') }}" class="form-control"
                                                placeholder="Enter Qty">
                                            <span class="text-danger">
                                                @error('quantity')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Unit Price</label>
                                            <input type="number" step="0.01" name="unit_price"
                                                value="{{ old('unit_price', $purchase->unit_price ?? '') }}" class="form-control"
                                                placeholder="Enter Unit price">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Profit (%)</label>
                                            <input type="number" step="0.01" name="profit_percent"
                                                value="{{ old('profit_percent', $purchase->profit_percent ?? '') }}" class="form-control"
                                                placeholder="%">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Selling Price</label>
                                            <input type="number" step="0.01" name="selling_price"
                                                value="{{ old('selling_price', $purchase->selling_price ?? '') }}" class="form-control"
                                                placeholder="Enter Selling price">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Total Price</label>
                                            <input type="number" step="0.01" name="total_price"
                                                value="{{ old('total_price', $purchase->total_price ?? '') }}" class="form-control"
                                                placeholder="Enter Total price">
                                        </div>
                                    </div>
                                </div>

                                <div class="purchase-section">
                                    <div class="purchase-section-title">Extra Info</div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Batch No.</label>
                                            <input type="text" name="batch_no"
                                                value="{{ old('batch_no', $purchase->batch_no ?? '') }}" class="form-control"
                                                placeholder="Enter Batch No.">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Production Date</label>
                                            <input type="date" name="production_date"
                                                value="{{ old('production_date', $purchase->production_date ?? '') }}" class="form-control">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Expiry Date</label>
                                            <input type="date" name="expiry_date"
                                                value="{{ old('expiry_date', $purchase->expiry_date ?? '') }}" class="form-control">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Adjustment Cost</label>
                                            <input type="number" step="0.01" name="adjustment_cost"
                                                value="{{ old('adjustment_cost', $purchase->adjustment_cost ?? '') }}" class="form-control"
                                                placeholder="Enter Adjustment Cost">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Color</label>
                                            <select name="color" class="form-control">
                                                <option value="">Select Color</option>
                                                @foreach ($color as $col)
                                                    <option value="{{ $col['attribute_id'] }}" {{ old('color', $purchase->color ?? '') == $col['attribute_id'] ? 'selected' : '' }}>
                                                        {{ $col['attribute_name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Size</label>
                                            <select name="size" class="form-control">
                                                <option value="">Select Size</option>
                                                @foreach ($size as $sz)
                                                    <option value="{{ $sz['attribute_id'] }}" {{ old('size', $purchase->size ?? '') == $sz['attribute_id'] ? 'selected' : '' }}>
                                                        {{ $sz['attribute_name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Weight</label>
                                            <select name="weight" class="form-control">
                                                <option value="">Select Weight</option>
                                                @foreach ($weight as $w)
                                                    <option value="{{ $w['attribute_id'] }}" {{ old('weight', $purchase->weight ?? '') == $w['attribute_id'] ? 'selected' : '' }}>
                                                        {{ $w['attribute_name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Material</label>
                                            <select name="material" class="form-control">
                                                <option value="">Select Material</option>
                                                @foreach ($material as $mat)
                                                    <option value="{{ $mat['attribute_id'] }}" {{ old('material', $purchase->material ?? '') == $mat['attribute_id'] ? 'selected' : '' }}>
                                                        {{ $mat['attribute_name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Brands</label>
                                            <select name="brands" class="form-control">
                                                <option value="">Select Brand</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand['company_id'] }}" {{ old('brands', $purchase->brands ?? '') == $brand['company_id'] ? 'selected' : '' }}>
                                                        {{ $brand['company_name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Category</label>
                                            <select name="category" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach ($categorys as $cat)
                                                    <option value="{{ $cat['category_id'] }}" {{ old('category', $purchase->category ?? '') == $cat['category_id'] ? 'selected' : '' }}>
                                                        {{ $cat['category_name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Availability</label>
                                            <select name="availability" class="form-control">
                                                <option value="Yes" {{ old('availability', $purchase->availability ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="No" {{ old('availability', $purchase->availability ?? '') == 'No' ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="purchase-actions">
                                <button type="submit" class="purchase-btn">Save Purchase</button>
                                <div class="purchase-muted">Track every chalan entry with the latest stock snapshot.</div>
                            </div>
                        </form>
                    </div>

                    <div class="purchase-card">
                        <div class="purchase-card-title"><span></span>Chalan # {{ $latestChalan }}</div>
                        <div class="purchase-muted">Recent purchase entries</div>

                        <div class="purchase-table-wrap">
                            <table id="recentTable" class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Date</th>
                                        <th>Chalan</th>
                                        <th>Supplier</th>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Buying</th>
                                        <th>Selling</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentPurchases as $index => $row)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $row->purchase_date }}</td>
                                            <td>{{ $row->chalan_no }}</td>
                                            <td>{{ $row->supplier_name ?? '-' }}</td>
                                            <td>{{ $row->product_name ?? '-' }}</td>
                                            <td>{{ $row->quantity ?? 0 }}</td>
                                            <td>{{ $row->unit_price ?? 0 }}</td>
                                            <td>{{ $row->selling_price ?? 0 }}</td>
                                            <td>{{ $row->total_price ?? 0 }}</td>
                                            <td>
                                                <a class="cat-edit" href="{{ url('/purchase/edit') }}/{{ $row->purchase_id }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="purchase-total">
                            <span>Total:</span>
                            <strong>{{ number_format($recentTotal ?? 0, 2) }} Tk</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        const pageName = document.getElementById('PageName');
        if (pageName) {
            pageName.innerText = '{{ $toptitle }}';
        }
        const qtyInput = document.querySelector('input[name="quantity"]');
        const unitInput = document.querySelector('input[name="unit_price"]');
        const totalInput = document.querySelector('input[name="total_price"]');
        const productSelect = document.getElementById('purchaseProduct');

        const updateTotalPrice = () => {
            if (!qtyInput || !unitInput || !totalInput) {
                return;
            }
            const qty = parseFloat(qtyInput.value || '0');
            const unit = parseFloat(unitInput.value || '0');
            const total = qty * unit;
            if (!Number.isNaN(total)) {
                totalInput.value = total.toFixed(2);
            }
        };

        const updateUnitPriceFromProduct = () => {
            if (!productSelect || !unitInput) {
                return;
            }
            const selected = productSelect.options[productSelect.selectedIndex];
            const price = selected ? selected.getAttribute('data-unit-price') : '';
            if (price !== null && price !== '') {
                unitInput.value = parseFloat(price).toFixed(2);
                updateTotalPrice();
            }
        };

        if (qtyInput && unitInput) {
            qtyInput.addEventListener('input', updateTotalPrice);
            unitInput.addEventListener('input', updateTotalPrice);
        }
        if (productSelect) {
            productSelect.addEventListener('change', updateUnitPriceFromProduct);
            updateUnitPriceFromProduct();
        }
        document.addEventListener('DOMContentLoaded', function () {
            if (window.jQuery && $.fn.DataTable) {
                $('#recentTable').DataTable({
                    pageLength: 7,
                    ordering: false,
                    lengthChange: false,
                });
                return;
            }
            if (window.DataTable) {
                new DataTable('#recentTable', {
                    pageLength: 7,
                    ordering: false,
                    lengthChange: false,
                });
            }
        });
    </script>

    <!-- END View Content Here -->
@endsection
