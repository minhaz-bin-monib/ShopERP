@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Supplier</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->

    <div class="container mt-4">
        {{-- <h5>{{$toptitle}}</h5> --}}
        <div class="card p-4">
            <form action="{{ $url }}" method="post">
                @csrf

                <div class="form-row">

                    <div class="row">

                        <div class="form-group col-md-4">
                            <label>Registration Date</label>
                            <input type="date" name="registration_date"
                                value="{{ old('registration_date', $supplier->registration_date ?? '') }}"
                                class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Supplier Name <span class="text-danger"><b>*</b></span></label>
                            <input type="text" name="supplier_name"
                                value="{{ old('supplier_name', $supplier->supplier_name ?? '') }}" class="form-control">

                            <span class="text-danger">
                                @error('supplier_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Proprietor Name</label>
                            <input type="text" name="proprietor_name"
                                value="{{ old('proprietor_name', $supplier->proprietor_name ?? '') }}" class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Date of Birth</label>
                            <input type="date" name="supplier_dob"
                                value="{{ old('supplier_dob', $supplier->supplier_dob ?? '') }}" class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Supplier Phone</label>
                            <input type="text" name="supplier_phone"
                                value="{{ old('supplier_phone', $supplier->supplier_phone ?? '') }}" class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Supplier NID</label>
                            <input type="text" name="supplier_nid"
                                value="{{ old('supplier_nid', $supplier->supplier_nid ?? '') }}" class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Supplier Remark</label>
                            <input type="text" name="supplier_remark"
                                value="{{ old('supplier_remark', $supplier->supplier_remark ?? '') }}" class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Supplier Address</label>
                            <input type="text" name="supplier_address"
                                value="{{ old('supplier_address', $supplier->supplier_address ?? '') }}"
                                class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Supplier Reminder</label>
                            <input type="text" name="supplier_reminder"
                                value="{{ old('supplier_reminder', $supplier->supplier_reminder ?? '') }}"
                                class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Supplier Note</label>
                            <input type="text" name="supplier_note"
                                value="{{ old('supplier_note', $supplier->supplier_note ?? '') }}" class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Status</label>
                            <select name="supplier_status" class="form-control">

                                <option value="Active" {{ old('supplier_status', $supplier->supplier_status ?? '') == 'Active' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="Inactive" {{ old('supplier_status', $supplier->supplier_status ?? '') == 'Inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>

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