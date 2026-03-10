@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Customer</title>
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
                        <label>Registration Date</label>
                        <input type="date" name="registration_date"
                            value="{{old('registration_date', $customer->registration_date ?? '')}}" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Customer Name <span class="text-danger"><b>*</b></span></label>
                        <input type="text" name="customer_name"
                            value="{{old('customer_name', $customer->customer_name ?? '')}}" class="form-control">
                        <span class="text-danger">@error('customer_name') {{$message}} @enderror</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Customer Code</label>
                        <input type="text" name="customer_code"
                            value="{{old('customer_code', $customer->customer_code ?? '')}}" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Proprietor Name</label>
                        <input type="text" name="proprietor_name"
                            value="{{old('proprietor_name', $customer->proprietor_name ?? '')}}" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Profession</label>
                        <input type="text" name="profession" value="{{old('profession', $customer->profession ?? '')}}"
                            class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Organization Name</label>
                        <input type="text" name="organization_name"
                            value="{{old('organization_name', $customer->organization_name ?? '')}}" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Father's Name</label>
                        <input type="text" name="customer_fathers_name"
                            value="{{old('customer_fathers_name', $customer->customer_fathers_name ?? '')}}"
                            class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Customer type</label>
                        <select class="form-control" id="customer_type" name="customer_type">

                            <option value="General" {{ old('customer_type', $customer->customer_type ?? '') == 'General' ? 'selected' : '' }}>
                                General (0%)
                            </option>

                            <option value="Platinum" {{ old('customer_type', $customer->customer_type ?? '') == 'Platinum' ? 'selected' : '' }}>
                                Platinum (5%)
                            </option>

                            <option value="Silver" {{ old('customer_type', $customer->customer_type ?? '') == 'Silver' ? 'selected' : '' }}>
                                Silver (10%)
                            </option>

                            <option value="Gold" {{ old('customer_type', $customer->customer_type ?? '') == 'Gold' ? 'selected' : '' }}>
                                Gold (15%)
                            </option>

                            <option value="Diamond" {{ old('customer_type', $customer->customer_type ?? '') == 'Diamond' ? 'selected' : '' }}>
                                Diamond (20%)
                            </option>

                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Customer Discount</label>
                        <input id="customer_discount" type="number" step="0.01" name="customer_discount"
                            value="{{old('customer_discount', $customer->customer_discount ?? '')}}" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Date of Birth</label>
                        <input type="date" name="customer_dob"
                            value="{{old('customer_dob', $customer->customer_dob ?? '')}}" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Customer Phone</label>
                        <input type="text" name="customer_phone"
                            value="{{old('customer_phone', $customer->customer_phone ?? '')}}" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Customer NID</label>
                        <input type="text" name="customer_nid"
                            value="{{old('customer_nid', $customer->customer_nid ?? '')}}" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Customer Zone</label>
                        <input type="text" name="customer_zone"
                            value="{{old('customer_zone', $customer->customer_zone ?? '')}}" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Customer Reminder</label>
                        <input type="text" name="customer_reminder"
                            value="{{old('customer_reminder', $customer->customer_reminder ?? '')}}" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Customer Address</label>
                        <input type="text" name="customer_address"
                            value="{{old('customer_address', $customer->customer_address ?? '')}}" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Customer Note</label>
                        <input type="text" name="customer_note"
                            value="{{old('customer_note', $customer->customer_note ?? '')}}" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Status</label>
                        <select name="customer_status" class="form-control">
                            <option value="Active" {{ old('customer_status', $customer->customer_status ?? '') == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ old('customer_status', $customer->customer_status ?? '') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

    </div>
    <script type="text/javascript">
        document.getElementById('PageName').innerText = '{{ $toptitle }}';
        document.getElementById("customer_type").addEventListener("change", function () {

            let discountMap = {
                "General": 0,
                "Platinum": 5,
                "Silver": 10,
                "Gold": 15,
                "Diamond": 20
            };

            let selectedType = this.value;

            if (discountMap[selectedType] !== undefined) {
                document.getElementById("customer_discount").value = discountMap[selectedType];
            } else {
                document.getElementById("customer_discount").value = '';
            }

        });
    </script>

    <!-- END View Content Here -->
@endsection