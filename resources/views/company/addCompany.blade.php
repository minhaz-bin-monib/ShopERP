@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Company</title>
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
                        <label for="company_name">Company Name <span class="text-danger"><b>*</b></span></label>
                        <input type="text" name="company_name" value="{{ old('company_name', $company->company_name) }}"
                            class="form-control" id="company_name">
                        <span class="text-danger">
                            @error('company_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="company_code">Company Code <span class="text-danger"><b></b></span></label>
                        <input type="text" name="company_code" value="{{ old('company_code', $company->company_code) }}"
                            class="form-control" id="company_code">
                        <span class="text-danger">
                            @error('company_code')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>


                    <div class="form-group col-md-4">
                        <label for="company_status">Company Status</label>
                        <select name="company_status" class="form-control">

                            <option value="Active" {{ old('company_status', $company->company_status ?? '') == 'Active' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="Inactive" {{ old('company_status', $company->company_status ?? '') == 'Inactive' ? 'selected' : '' }}>
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