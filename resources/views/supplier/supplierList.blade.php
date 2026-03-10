@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Supplier</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
    <div class="container mt-4">
        
        {{-- <h5>Supplier</h5> --}}

       
        <table id="myTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Supplier ID</th>
                    <th>Edit</th>
                    <th>Supplier</th>
                    <th>Proprietor Name</th>
                    <th>Supplier Phone</th>
                    <th>Supplier Note</th>
                    <th>Status</th>
                    {{-- <th>Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($suppliers as  $prod)
                <tr>
                    <td style="width: 6%">{{ $prod->supplier_id }}</td>
                    <td style="width: 5%">
                        <a class="" href="{{url('/supplier/edit')}}/{{$prod->supplier_id}}"><i class="fa fa-edit"></i></a> 
                    </td>
                    <td>{{$prod->supplier_name}}</td>
                    <td>{{$prod->proprietor_name}}</td>
                    <td>{{$prod->supplier_phone}}</td>
                    <td>{{$prod->supplier_note}}</td>
                    <td>{{$prod->supplier_status}}</td>
                    {{-- <td style="width: 7%"> 
                       <a class="btn btn-sm btn-danger"onClick="confirmDelete('{{url('/supplier/delete')}}/{{$prod->supplier_id}}')"><i class="fa fa-trash"></i></a> 
                    </td> --}}
                </tr>
               @endforeach
            </tbody>
        </table>
   
    </div>
    <script type="text/javascript">
    document.getElementById('PageName').innerText = 'Supplier List';
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