@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Product</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->

    <div class="container mt-4">
        {{-- <h5>{{$toptitle}}</h5> --}}
        <div class="card p-4">
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


                        <!-- Company -->
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


                        <!-- Department -->
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


                        <!-- Supplier -->
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


                        <!-- Color -->
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


                        <!-- Size -->
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


                        <!-- Weight -->
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


                        <!-- Material -->
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


                        <!-- Brands -->
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


                        <!-- Category -->
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


                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

    </div>
    <script type="text/javascript">
        document.getElementById('PageName').innerText = '{{ $toptitle }}';
    </script>

    <!-- END View Content Here -->
@endsection