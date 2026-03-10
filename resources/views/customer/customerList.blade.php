@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Customer</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
    <div class="container mt-4">

        {{-- <h5>Customer</h5> --}}


        <table id="myTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Edit</th>
                    <th>Zone</th>
                    <th>Customer</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Reminder</th>
                    <th>Due</th>
                    <th>Status</th>
                    {{-- <th>Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $prod)
                    <tr>
                        <td style="width: 6%">{{ $prod->customer_id }}</td>
                        <td style="width: 5%">
                            <a class="" href="{{url('/customer/edit')}}/{{$prod->customer_id}}"><i class="fa fa-edit"></i></a>
                        </td>
                        <td>{{$prod->customer_zone}}</td>
                        <td>{{$prod->customer_name}} -> {{$prod->customer_code}}</td>
                        <td>{{$prod->customer_phone}}</td>
                        <td>{{$prod->customer_address}}</td>
                        <td>{{$prod->customer_reminder}}</td>
                        <td>0</td>
                        <td>{{$prod->customer_status}}</td>
                        {{-- <td style="width: 7%">
                            <a class="btn btn-sm btn-danger"
                                onClick="confirmDelete('{{url('/customer/delete')}}/{{$prod->customer_id}}')"><i
                                    class="fa fa-trash"></i></a>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <script type="text/javascript">
        document.getElementById('PageName').innerText = 'Customer List';
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