@extends('layouts.mainFullPage')

@push('title')
    <title>Sales Invoice</title>
@endpush

@section('main-section')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&family=Great+Vibes&display=swap');

        :root {
            --ink: #121212;
            --ink-soft: #4a4a4a;
            --line: #1a1a1a;
        }

        body {
            background: #ffffff !important;
        }

        .invoice-wrap {
            width: 360px;
            margin: 12px auto;
            padding: 8px 10px 16px;
            font-family: 'Manrope', Arial, sans-serif;
            color: var(--ink);
        }

        .invoice-top {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            margin-bottom: 4px;
        }

        .brand {
            text-align: center;
            margin-bottom: 6px;
        }

        .brand-name {
            font-family: 'Great Vibes', cursive;
            font-size: 34px;
            line-height: 1;
        }

        .brand-site {
            font-size: 11px;
            color: var(--ink-soft);
        }

        .invoice-label {
            text-align: center;
            letter-spacing: 0.35em;
            font-weight: 700;
            font-size: 12px;
            margin: 6px 0;
        }

        .barcode {
            height: 38px;
            margin: 6px auto 4px;
            width: 90%;
            background: repeating-linear-gradient(
                90deg,
                #111,
                #111 2px,
                transparent 2px,
                transparent 4px,
                #111 4px,
                #111 5px,
                transparent 5px,
                transparent 7px
            );
        }

        .bill-meta {
            text-align: center;
            font-size: 11px;
            margin-bottom: 6px;
        }

        .bill-meta strong {
            font-weight: 700;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            margin: 6px 0 8px;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid var(--line);
            padding: 4px 6px;
        }

        .invoice-table th {
            text-align: left;
            font-weight: 700;
        }

        .totals-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .totals-table td {
            border: 1px solid var(--line);
            padding: 4px 6px;
        }

        .totals-table td:first-child {
            width: 65%;
        }

        .invoice-footer {
            text-align: center;
            font-size: 11px;
            color: var(--ink-soft);
            margin-top: 6px;
            line-height: 1.4;
        }

        @media print {
            .invoice-wrap {
                margin: 0;
                padding: 0;
            }
        }
    </style>

    <div class="invoice-wrap">
        <div class="invoice-top">
            <div>{{ optional($sales->created_at)->format('d/m/Y, H:i') ?? ($sales->sales_date ?? '-') }}</div>
            <div>Customer Invoice</div>
        </div>

        <div class="brand">
            <div class="brand-name">Attitude</div>
            <div class="brand-site">www.attitudebd.net</div>
        </div>

        <div class="invoice-label">INVOICE</div>
        <div class="barcode"></div>
        <div class="bill-meta">
            <div>Bill No: <strong>{{ $sales->bill_no ?? '-' }}</strong></div>
            <div>Customer Contact: {{ $sales->customer_phone ?? '-' }}</div>
            <div>{{ $sales->sales_date ?? '-' }} {{ optional($sales->created_at)->format('h:i A') ?? '' }}</div>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th style="width: 32px;">SL.</th>
                    <th>Description</th>
                    <th style="width: 52px;">Qty</th>
                    <th style="width: 70px;">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $index => $item)
                    <tr>
                        <td>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            {{ $item->product_name ?? '-' }}
                            @if (!empty($item->remarks))
                                <div style="font-size: 10px; color: var(--ink-soft);">{{ $item->remarks }}</div>
                            @endif
                        </td>
                        <td>{{ $item->qty ?? 0 }}</td>
                        <td>{{ $item->total ?? 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="totals-table">
            <tbody>
                <tr><td>Gross Amount :</td><td>{{ $sales->gross_amount ?? 0 }}</td></tr>
                <tr><td>Discount :</td><td>{{ ($sales->gross_amount ?? 0) - ($sales->net_amount ?? 0) }}</td></tr>
                <tr><td>Net Amount :</td><td>{{ $sales->net_amount ?? 0 }}</td></tr>
                <tr><td>Received :</td><td>{{ $sales->given_amount ?? 0 }}</td></tr>
                <tr><td>Returned :</td><td>{{ ($sales->given_amount ?? 0) - ($sales->paid_amount ?? 0) }}</td></tr>
                <tr><td>Paid Amount :</td><td>{{ $sales->paid_amount ?? 0 }}</td></tr>
                <tr><td>Payable :</td><td>{{ $sales->payable_amount ?? 0 }}</td></tr>
                <tr><td>Paid Status :</td><td>{{ $sales->status ?? '-' }}</td></tr>
            </tbody>
        </table>

        <div class="invoice-footer">
            <div>All Product Price Were Including VAT. Exchange or Return</div>
            <div>Would be Valid in 7 Days and Unregistered Customer Must</div>
            <div>Bring Invoice Copy.</div>
            <div style="margin-top: 6px;">Thank You For Shopping With Us.</div>
        </div>
    </div>

    <script>
        window.addEventListener('load', () => {
            window.print();
        });
    </script>
@endsection
