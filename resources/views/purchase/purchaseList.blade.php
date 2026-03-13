@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Purchase List</title>
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

        .purchase-list-wrap {
            padding: 12px 4px 40px;
        }

        .purchase-list-shell {
            background: var(--paper);
            border-radius: 22px;
            box-shadow: var(--shadow);
            border: 1px solid var(--line);
            overflow: hidden;
        }

        .purchase-list-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            background: linear-gradient(135deg, rgba(47, 111, 116, 0.2), rgba(124, 201, 176, 0.3));
        }

        .purchase-title {
            font-family: 'DM Serif Display', Georgia, serif;
            font-size: 28px;
            color: var(--ink);
            margin: 0;
        }

        .purchase-head-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .purchase-chip {
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

        .purchase-chip span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--warm);
        }

        .purchase-table-wrap {
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

        #purchaseTable {
            border-collapse: separate;
            border-spacing: 0 6px;
            font-family: 'Manrope', Arial, sans-serif;
            font-size: 14px;
            color: var(--ink);
            table-layout: fixed;
            width: 100%;
        }

        #purchaseTable thead th {
            border: 1px solid rgba(78, 70, 60, 0.12);
            background: transparent;
            font-weight: 600;
            color: var(--ink-soft);
            padding: 6px 10px;
        }

        #purchaseTable tbody tr {
            background: #ffffff;
            border: 1px solid var(--line);
            box-shadow: 0 10px 24px rgba(28, 23, 16, 0.06);
        }

        #purchaseTable tbody td {
            padding: 4px 10px;
            border-top: 1px solid var(--line);
            border-bottom: 1px solid var(--line);
            border-right: 1px solid rgba(78, 70, 60, 0.08);
        }

        #purchaseTable tbody td:first-child {
            border-left: 1px solid var(--line);
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
            font-weight: 600;
            color: var(--ink-soft);
        }

        #purchaseTable tbody td:last-child {
            border-right: 1px solid var(--line);
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        .cat-edit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
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

        @media (max-width: 900px) {
            .purchase-list-head {
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

            .purchase-table-wrap {
                overflow-x: auto;
            }

            #purchaseTable {
                min-width: 820px;
            }
        }
    </style>

    <div class="container-fluid purchase-list-wrap">
        <div class="purchase-list-shell">
            <div class="purchase-list-head">
                <div>
                    <h2 class="purchase-title">Purchase List</h2>
                </div>
                <div class="purchase-head-actions">
                    <div class="purchase-chip"><span></span>{{ $purchases->count() }} total</div>
                </div>
            </div>

            <div class="purchase-table-wrap">
                <table id="purchaseTable" class="table table-borderless">
                    <thead>
                        <tr>
                            <th>SL.</th>
                            <th>Date</th>
                            <th>Chalan</th>
                            <th>Supplier</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Buying Price</th>
                            <th>Selling Price</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchases as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->purchase_date }}</td>
                                <td>{{ $row->chalan_no }}</td>
                                <td>{{ $row->supplier_name ?? '-' }}</td>
                                <td>{{ $row->product_name ?? '-' }}</td>
                                <td>{{ $row->quantity ?? 0 }}</td>
                                <td>{{ $row->unit_price ?? 0 }}</td>
                                <td>{{ $row->selling_price ?? 0 }}</td>
                                <td>{{ $row->total_price ?? 0 }}</td>
                                <td>
                                    <a class="cat-edit" href="{{ url('/purchase/edit') }}/{{ $row->purchase_id }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
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
            pageName.innerText = 'Purchase List';
        }
        document.addEventListener('DOMContentLoaded', function () {
            if (window.jQuery && $.fn.DataTable) {
                $('#purchaseTable').DataTable({
                    pageLength: 10,
                    order: [[1, 'desc']],
                });
                return;
            }
            if (window.DataTable) {
                new DataTable('#purchaseTable', {
                    pageLength: 10,
                    order: [[1, 'desc']],
                });
            }
        });
    </script>

    <!-- END View Content Here -->
@endsection
