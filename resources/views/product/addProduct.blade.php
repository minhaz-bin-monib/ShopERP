@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Product</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Manrope:wght@300;400;500;600;700&display=swap');

        :root {
            --ink: #1f1b16;
            --ink-soft: #3a332c;
            --sun: #f7c243;
            --ocean: #2f6f74;
            --shadow: 0 20px 60px rgba(33, 26, 18, 0.18);
        }

        .category-page {
            min-height: 72vh;
            padding: 28px 10px 60px;
            border-radius: 24px;
        }

        .category-shell {
            background: #fffdf9;
            border-radius: 24px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .category-hero {
            background: linear-gradient(160deg, #2f6f74, #3c8f8a);
            color: #ffffff;
            padding: 34px 32px;
            position: relative;
        }

        .category-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.18);
            border-radius: 999px;
            padding: 6px 14px;
            font-family: 'Manrope', Arial, sans-serif;
            font-size: 20px;
        }

        .category-badge span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--sun);
        }

        .category-body {
            padding: 32px 32px 36px;
        }

        .category-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 28px;
            align-items: center;
        }

        .category-card {
            background: #ffffff;
            border: 1px solid #efe4d6;
            border-radius: 18px;
            padding: 26px 24px 22px;
        }

        .category-card-title {
            font-family: 'DM Serif Display', Georgia, serif;
            font-size: 26px;
            color: var(--ink);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .category-card-title span {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--sun);
            box-shadow: 0 0 0 6px rgba(247, 194, 67, 0.2);
            flex: none;
        }

        .category-form label {
            font-family: 'Manrope', Arial, sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: var(--ink);
        }

        .category-form .form-control,
        .category-form select {
            border-radius: 12px;
            border: 1px solid #e8dcca;
            background: #fffdf9;
            height: 48px;
            padding: 10px 16px;
            font-family: 'Manrope', Arial, sans-serif;
            font-size: 17px;
        }

        .category-form .form-control:focus,
        .category-form select:focus {
            border-color: var(--ocean);
            box-shadow: 0 0 0 3px rgba(47, 111, 116, 0.15);
        }

        .category-actions {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-top: 8px;
        }

        .category-btn {
            background: linear-gradient(135deg, #2f6f74, #7cc9b0);
            border: none;
            color: #ffffff;
            font-family: 'Manrope', Arial, sans-serif;
            font-weight: 700;
            padding: 12px 26px;
            border-radius: 999px;
            box-shadow: 0 14px 30px rgba(47, 111, 116, 0.3);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            font-size: 17px;
        }

        .category-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 38px rgba(47, 111, 116, 0.35);
        }

        @keyframes floatIn {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .category-animated {
            animation: floatIn 0.6s ease both;
        }

        @media (max-width: 576px) {
            .category-body {
                padding: 24px 20px 28px;
            }
        }
    </style>

    <div class="container-fluid category-page">
        <div class="category-shell category-animated">
            <div class="category-hero">
                <div class="category-badge">
                    <span></span>
                    {{ $toptitle }}
                </div>
            </div>

            <div class="category-body">
                <div class="category-grid">
                    <div class="category-card category-form">
                        <div class="category-card-title"><span></span>{{ $toptitle }}</div>
                        @php
                            $color = $aributes->filter(fn($a) => $a->attribute_category == 'Color')->values();
                            $size = $aributes->filter(fn($a) => $a->attribute_category == 'Size')->values();
                            $material = $aributes->filter(fn($a) => $a->attribute_category == 'Material')->values();
                            $weight = $aributes->filter(fn($a) => $a->attribute_category == 'Weight')->values();
                            $department = $aributes->filter(fn($a) => $a->attribute_category == 'Department')->values();
                            $brands = $company;
                        @endphp

                        <form action="{{ $url }}" method="post">
                            @csrf

                            <div class="form-row">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Product Name</label>
                                        <input type="text" name="product_name"
                                            value="{{ old('product_name', $product->product_name ?? '') }}" class="form-control">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Unit Type</label>
                                        <input type="text" name="unit_type" value="{{ old('unit_type', $product->unit_type ?? '') }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Product Code</label>
                                        <input type="text" name="product_code"
                                            value="{{ old('product_code', $product->product_code ?? '') }}" class="form-control">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Purchase Price</label>
                                        <input type="number" step="0.01" name="purchase_price"
                                            value="{{ old('purchase_price', $product->purchase_price ?? '') }}" class="form-control">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Selling Price</label>
                                        <input type="number" step="0.01" name="selling_price"
                                            value="{{ old('selling_price', $product->selling_price ?? '') }}" class="form-control">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Reminder High</label>
                                        <input type="number" step="0.01" name="reminder_high"
                                            value="{{ old('reminder_high', $product->reminder_high ?? '') }}" class="form-control">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Reminder Low</label>
                                        <input type="number" step="0.01" name="reminder_low"
                                            value="{{ old('reminder_low', $product->reminder_low ?? '') }}" class="form-control">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Company</label>
                                        <select name="company" class="form-control">
                                            @foreach ($company as $comp)
                                                <option value="{{ $comp['company_id'] }}" {{ old('company', $product->company ?? '') == $comp['company_id'] ? 'selected' : '' }}>
                                                    {{ $comp['company_name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Department</label>
                                        <select name="department" class="form-control">
                                            @foreach ($department as $dept)
                                                <option value="{{ $dept['attribute_id'] }}" {{ old('department', $product->department ?? '') == $dept['attribute_id'] ? 'selected' : '' }}>
                                                    {{ $dept['attribute_name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Supplier</label>
                                        <select name="supplier" class="form-control">
                                            @foreach ($supplier as $sup)
                                                <option value="{{ $sup['supplier_id'] }}" {{ old('supplier', $product->supplier ?? '') == $sup['supplier_id'] ? 'selected' : '' }}>
                                                    {{ $sup['supplier_name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Color</label>
                                        <select name="color" class="form-control">
                                            @foreach ($color as $col)
                                                <option value="{{ $col['attribute_id'] }}" {{ old('color', $product->color ?? '') == $col['attribute_id'] ? 'selected' : '' }}>
                                                    {{ $col['attribute_name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Size</label>
                                        <select name="size" class="form-control">
                                            @foreach ($size as $sz)
                                                <option value="{{ $sz['attribute_id'] }}" {{ old('size', $product->size ?? '') == $sz['attribute_id'] ? 'selected' : '' }}>
                                                    {{ $sz['attribute_name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Weight</label>
                                        <select name="weight" class="form-control">
                                            @foreach ($weight as $w)
                                                <option value="{{ $w['attribute_id'] }}" {{ old('weight', $product->weight ?? '') == $w['attribute_id'] ? 'selected' : '' }}>
                                                    {{ $w['attribute_name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Material</label>
                                        <select name="material" class="form-control">
                                            @foreach ($material as $mat)
                                                <option value="{{ $mat['attribute_id'] }}" {{ old('material', $product->material ?? '') == $mat['attribute_id'] ? 'selected' : '' }}>
                                                    {{ $mat['attribute_name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Brand</label>
                                        <select name="brands" class="form-control">
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand['company_id'] }}" {{ old('brands', $product->brands ?? '') == $brand['company_id'] ? 'selected' : '' }}>
                                                    {{ $brand['company_name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Category</label>
                                        <select name="category" class="form-control">
                                            @foreach ($category as $cat)
                                                <option value="{{ $cat['category_id'] }}" {{ old('category', $product->category ?? '') == $cat['category_id'] ? 'selected' : '' }}>
                                                    {{ $cat['category_name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Status</label>
                                        <select name="product_status" class="form-control">
                                            <option value="Active" {{ old('product_status', $product->product_status ?? '') == 'Active' ? 'selected' : '' }}>Active</option>
                                            <option value="Inactive" {{ old('product_status', $product->product_status ?? '') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="category-actions">
                                <button type="submit" class="category-btn">Save</button>
                            </div>
                        </form>
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
    </script>

    <!-- END View Content Here -->
@endsection
