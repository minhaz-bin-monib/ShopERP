@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Category</title>
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
                        <label for="category_name">Category Name <span class="text-danger"><b>*</b></span></label>
                        <input type="text" name="category_name" value="{{ old('category_name', $category->category_name) }}"
                            class="form-control" id="category_name">
                        <span class="text-danger">
                            @error('category_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>


                    <div class="form-group col-md-4">
                        <label for="category_status">Category Status</label>
                        <select name="category_status" class="form-control">

                            <option value="Active" {{ old('category_status', $category->category_status ?? '') == 'Active' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="Inactive" {{ old('category_status', $category->category_status ?? '') == 'Inactive' ? 'selected' : '' }}>
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