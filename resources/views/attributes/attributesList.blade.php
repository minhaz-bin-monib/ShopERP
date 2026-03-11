@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Attributes</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Manrope:wght@300;400;500;600;700&display=swap');

        :root {
            --ink: #1f1b16;
            --ink-soft: #4e463c;
            --paper: #fffdf9;
            --line: #eadfce;
            --accent: #2f6f74;
            --warm: #f7c243;
            --shadow: 0 18px 50px rgba(28, 23, 16, 0.12);
        }

        .cat-list-wrap {
            padding: 12px 4px 40px;
        }

        .cat-list-shell {
            background: var(--paper);
            border-radius: 22px;
            box-shadow: var(--shadow);
            border: 1px solid var(--line);
            overflow: hidden;
        }

        .cat-list-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            background: linear-gradient(135deg, rgba(47, 111, 116, 0.2), rgba(124, 201, 176, 0.3));
        }

        .cat-title {
            font-family: 'DM Serif Display', Georgia, serif;
            font-size: 28px;
            color: var(--ink);
            margin: 0;
        }

        .cat-head-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .cat-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 999px;
            background: #ffffff;
            border: 1px solid var(--line);
            font-family: 'Manrope', Arial, sans-serif;
            font-size: 12px;
            color: var(--ink-soft);
        }

        .cat-chip span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--warm);
        }

        .cat-table-wrap {
            padding: 8px 16px 18px;
        }

        .dt-container .dt-layout-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 0;
            margin: 0 !important;
            font-family: 'Manrope', Arial, sans-serif;
            color: var(--ink-soft);
            flex-wrap: wrap;
        }

        .dt-container .dt-layout-row .dt-layout-start,
        .dt-container .dt-layout-row .dt-layout-end {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .dt-container .dt-layout-row label {
            font-size: 13px;
            margin-bottom: 0;
        }

        .dt-container .dt-search,
        .dt-container .dt-length {
            width: auto;
        }

        .dt-container .dt-search .dt-input {
            border-radius: 12px;
            border: 1px solid var(--line);
            padding: 6px 10px;
            font-size: 14px;
            min-width: 180px;
        }

        .dt-container .dt-length .dt-input {
            border-radius: 10px;
            border: 1px solid var(--line);
            padding: 4px 8px;
            font-size: 14px;
        }

        .dt-container .dt-paging .dt-paging-button {
            border-radius: 10px;
            padding: 6px 10px;
            border: 1px solid var(--line);
            margin: 0 3px;
            color: var(--ink-soft);
            background: #ffffff;
        }

        .dt-container .dt-paging .dt-paging-button:hover {
            background: rgba(47, 111, 116, 0.12);
            color: var(--ink);
            text-decoration: none;
        }

        .dt-container .dt-paging .current,
        .dt-container .dt-paging .current:hover {
            background: linear-gradient(135deg, rgba(47, 111, 116, 0.18), rgba(124, 201, 176, 0.2));
            border-color: transparent;
            color: var(--ink);
        }

        #myTable {
            border-collapse: separate;
            border-spacing: 0 6px;
            font-family: 'Manrope', Arial, sans-serif;
            font-size: 15px;
            color: var(--ink);
            table-layout: fixed;
            width: 100%;
        }

        #myTable thead th {
            border: 1px solid rgba(78, 70, 60, 0.12);
            background: transparent;
            font-weight: 600;
            color: var(--ink-soft);
            padding: 6px 10px;
        }

        #myTable tbody tr {
            background: #ffffff;
            border: 1px solid var(--line);
            box-shadow: 0 10px 24px rgba(28, 23, 16, 0.06);
        }

        #myTable tbody td {
            padding: 3px 12px;
            border-top: 1px solid var(--line);
            border-bottom: 1px solid var(--line);
            border-right: 1px solid rgba(78, 70, 60, 0.08);
        }

        #myTable tbody td:first-child {
            border-left: 1px solid var(--line);
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
            font-weight: 600;
            color: var(--ink-soft);
        }

        #myTable tbody td:last-child {
            border-right: 1px solid var(--line);
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        #myTable th:nth-child(1),
        #myTable th:nth-child(2),
        #myTable th:nth-child(5),
        #myTable td:nth-child(1),
        #myTable td:nth-child(2),
        #myTable td:nth-child(5) {
            white-space: nowrap;
        }

        #myTable th:nth-child(1),
        #myTable td:nth-child(1) {
            width: 56px;
        }

        #myTable th:nth-child(2),
        #myTable td:nth-child(2) {
            width: 52px;
        }

        #myTable th:nth-child(5),
        #myTable td:nth-child(5) {
            width: 84px;
        }

        .cat-edit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: rgba(47, 111, 116, 0.12);
            color: var(--accent);
            transition: transform 0.2s ease, background 0.2s ease;
        }

        .cat-edit:hover {
            transform: translateY(-1px);
            background: rgba(47, 111, 116, 0.2);
            color: var(--accent);
            text-decoration: none;
        }

        .cat-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 999px;
        }

        .cat-status::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: currentColor;
        }

        .cat-active {
            color: #2f6f74;
            background: rgba(47, 111, 116, 0.12);
        }

        .cat-inactive {
            color: #a3533b;
            background: rgba(255, 127, 106, 0.18);
        }

        @media (max-width: 768px) {
            .cat-list-head {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .dt-container .dt-layout-row {
                flex-direction: column;
                align-items: stretch;
                gap: 8px;
            }

            .dt-container .dt-layout-row .dt-layout-start,
            .dt-container .dt-layout-row .dt-layout-end {
                width: 100%;
                justify-content: space-between;
                flex-wrap: wrap;
            }

            .dt-container .dt-search .dt-input,
            .dt-container .dt-length .dt-input {
                width: 100%;
                min-width: 0;
            }

            .cat-table-wrap {
                overflow-x: auto;
            }

            #myTable {
                min-width: 760px;
            }
        }
    </style>

    <div class="container-fluid cat-list-wrap">
        <div class="cat-list-shell">
            <div class="cat-list-head">
                <div>
                    <h2 class="cat-title">Attributes List</h2>
                </div>
                <div class="cat-head-actions">
                    <div class="cat-chip"><span></span>{{ $attributes->count() }} total</div>
                </div>
            </div>

            <div class="cat-table-wrap">
                <table id="myTable" class="table table-borderless">
                    <thead>
                        <tr>
                            <th>Attributes ID</th>
                            <th style="width: 52px;">Edit</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th style="width: 84px;">Status</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attributes as  $prod)
                        <tr>
                            <td style="width: 56px;">{{ $prod->attribute_id }}</td>
                            <td style="width: 52px;">
                                <a class="cat-edit" href="{{url('/attributes/edit')}}/{{$prod->attribute_id}}"><i class="fa fa-edit"></i></a>
                            </td>
                            <td>{{$prod->attribute_name}}</td>
                            <td>{{$prod->attribute_category}}</td>
                            <td>
                                <span class="cat-status {{ $prod->attribute_status === 'Active' ? 'cat-active' : 'cat-inactive' }}">
                                    {{ $prod->attribute_status }}
                                </span>
                            </td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        const pageName = document.getElementById('PageName');
        if (pageName) {
            pageName.innerText = 'Attributes List';
        }
        document.addEventListener('DOMContentLoaded', function () {
            if (window.jQuery && $.fn.DataTable) {
                $('#myTable').DataTable({
                    pageLength: 10,
                    order: [[0, 'desc']],
                });
                return;
            }
            if (window.DataTable) {
                new DataTable('#myTable', {
                    pageLength: 10,
                    order: [[0, 'desc']],
                });
            }
        });
        function confirmDelete(url) {
            if (confirm("Want to delete this item?")) {
                window.location.href = url;
            }
        }
    </script>

    <!-- END View Content Here -->
@endsection
