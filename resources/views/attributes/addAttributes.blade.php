@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Attributes</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->

    <div class="container mt-4">
        {{-- <h5>{{$toptitle}}</h5> --}}
        <div class="card p-4">
            <form action="{{ $url }}" method="post">
                @csrf

                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="attribute_name">Attributes Name <span class="text-danger"><b>*</b></span></label>
                        <input type="text" name="attribute_name"
                            value="{{ old('attribute_name', $attributes->attribute_name) }}" class="form-control"
                            id="attribute_name">
                        <span class="text-danger">
                            @error('attribute_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="attribute_category">Attributes Category</label>

                        <select name="attribute_category" class="form-control">

                            <option value="Color" {{ old('attribute_category', $attributes->attribute_category ?? '') == 'Color' ? 'selected' : '' }}>
                                Color
                            </option>
                            <option value="Department" {{ old('attribute_category', $attributes->attribute_category ?? '') == 'Color' ? 'selected' : '' }}>
                                Department
                            </option>

                            <option value="Size" {{ old('attribute_category', $attributes->attribute_category ?? '') == 'Size' ? 'selected' : '' }}>
                                Size
                            </option>

                            <option value="Weight" {{ old('attribute_category', $attributes->attribute_category ?? '') == 'Weight' ? 'selected' : '' }}>
                                Weight
                            </option>

                            <option value="Material" {{ old('attribute_category', $attributes->attribute_category ?? '') == 'Material' ? 'selected' : '' }}>
                                Material
                            </option>

                            <option value="Qty" {{ old('attribute_category', $attributes->attribute_category ?? '') == 'Qty' ? 'selected' : '' }}>
                                Qty
                            </option>

                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="attribute_status">Attributes Status</label>
                        <select name="attribute_status" class="form-control">

                            <option value="Active" {{ old('attribute_status', $attributes->attribute_status ?? '') == 'Active' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="Inactive" {{ old('attribute_status', $attributes->attribute_status ?? '') == 'Inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>
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