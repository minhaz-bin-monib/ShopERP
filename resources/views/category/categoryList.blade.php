@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Categories</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
    <div class="container mt-4">
        
        {{-- <h5>Categories</h5> --}}

       
        <table id="myTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Edit</th>
                    <th>Name</th>
                    <th>Status</th>
                    {{-- <th>Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($categorys as  $prod)
                <tr>
                    <td style="width: 6%">{{ $prod->category_id }}</td>
                    <td style="width: 5%">
                        <a class="" href="{{url('/category/edit')}}/{{$prod->category_id}}"><i class="fa fa-edit"></i></a> 
                    </td>
                    <td>{{$prod->category_name}}</td>
                    <td>{{$prod->category_status}}</td>
                    {{-- <td style="width: 7%"> 
                       <a class="btn btn-sm btn-danger"onClick="confirmDelete('{{url('/category/delete')}}/{{$prod->category_id}}')"><i class="fa fa-trash"></i></a> 
                    </td> --}}
                </tr>
               @endforeach
            </tbody>
        </table>
   
    </div>
    <script type="text/javascript">
    document.getElementById('PageName').innerText = 'Category List';
       // let table = new DataTable('#myTable');
       let table = new DataTable('#myTable', {
            perPage: 10, // Number of entries per page
            sortable: true, // Allow sorting
            order: [[0, 'desc']], // Maintain initial order based on first column
        });
        function confirmDelete(url) {
                    if (confirm("Want to delete this item?")) {
                        window.location.href = url;
                    }
                }
    </script>


    <!-- END View Content Here -->
@endsection