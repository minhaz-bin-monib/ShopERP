@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Invoice Lists</title>
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

        .sales-list-wrap {
            padding: 12px 4px 40px;
        }

        .sales-list-shell {
            background: var(--paper);
            border-radius: 22px;
            box-shadow: var(--shadow);
            border: 1px solid var(--line);
            overflow: hidden;
        }

        .sales-list-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            background: linear-gradient(135deg, rgba(47, 111, 116, 0.2), rgba(124, 201, 176, 0.3));
        }

        .sales-title {
            font-family: 'DM Serif Display', Georgia, serif;
            font-size: 28px;
            color: var(--ink);
            margin: 0;
        }

        .sales-head-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .sales-chip {
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

        .sales-chip span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--warm);
        }

        .sales-table-wrap {
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

        #salesTable {
            border-collapse: separate;
            border-spacing: 0 6px;
            font-family: 'Manrope', Arial, sans-serif;
            font-size: 14px;
            color: var(--ink);
            table-layout: fixed;
            width: 100%;
        }

        #salesTable thead th {
            border: 1px solid rgba(78, 70, 60, 0.12);
            background: transparent;
            font-weight: 600;
            color: var(--ink-soft);
            padding: 6px 10px;
        }


        #salesTable tbody tr {
            background: #ffffff;
            border: 1px solid var(--line);
            box-shadow: 0 10px 24px rgba(28, 23, 16, 0.06);
        }

        #salesTable tbody td {
            padding: 4px 10px;
            border-top: 1px solid var(--line);
            border-bottom: 1px solid var(--line);
            border-right: 1px solid rgba(78, 70, 60, 0.08);
        }

        #salesTable tbody td:first-child {
            border-left: 1px solid var(--line);
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
            font-weight: 600;
            color: var(--ink-soft);
        }

        #salesTable tbody td:last-child {
            border-right: 1px solid var(--line);
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        @media (max-width: 900px) {
            .sales-list-head {
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

            .sales-table-wrap {
                overflow-x: auto;
            }

            #salesTable {
                min-width: 980px;
            }
        }
    </style>

    <div class="container-fluid sales-list-wrap">
        <div class="sales-list-shell">
            <div class="sales-list-head">
                <div>
                    <h2 class="sales-title">Invoice Lists</h2>
                </div>
                <div class="sales-head-actions">
                    <div class="sales-chip"><span></span>{{ $sales->count() }} total</div>
                </div>
            </div>

            <div class="sales-table-wrap">
                <table id="salesTable" class="table table-borderless">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Customer Name</th>
                            <th>Customer ID</th>
                            <th>Bill No</th>
                            <th>Total Cost</th>
                            <th>Paid</th>
                            <th>Unpaid</th>
                            <th>Methods</th>
                            <th>Payment Details</th>
                            <th>Status</th>
                            <th>Sold By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $row)
                            <tr>
                                <td>{{ $row->sales_id }}</td>
                                <td>{{ $row->sales_date }}</td>
                                <td>{{ $row->customer_name ?? '-' }}</td>
                                <td>{{ $row->customer_id ?? '-' }}</td>
                                <td>{{ $row->bill_no ?? '-' }}</td>
                                <td>{{ $row->net_amount ?? 0 }}</td>
                                <td>{{ $row->paid_amount ?? 0 }}</td>
                                <td>{{ ($row->net_amount ?? 0) - ($row->paid_amount ?? 0) }}</td>
                                <td>{{ $row->payment_method ?? '-' }}</td>
                                <td>{{ $row->payment_details ?? '-' }}</td>
                                <td>{{ $row->status ?? '-' }}</td>
                                <td>{{ $row->sold_by ?? '-' }}</td>
                                <td>
                                    <a class="btn btn-sm btn-outline-primary" target="_blank" href="{{ url('/sales/print/' . $row->sales_id) }}">Print</a>
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
            pageName.innerText = 'Invoice Lists';
        }
        document.addEventListener('DOMContentLoaded', function () {
            if (window.jQuery && $.fn.DataTable) {
                $('#salesTable').DataTable({
                    pageLength: 10,
                    order: [[0, 'desc']],
                    columnDefs: [{ targets: 0, visible: false, searchable: false }],
                });
                return;
            }
            if (window.DataTable) {
                new DataTable('#salesTable', {
                    pageLength: 10,
                    order: [[0, 'desc']],
                    columnDefs: [{ targets: 0, visible: false, searchable: false }],
                });
            }
        });
    </script>

    <!-- END View Content Here -->
@endsection
