@extends('layouts.mainFullPage')

@push('title')
    <title>Sales Invoice</title>
@endpush

@section('main-section')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&display=swap');

        :root {
            --ink: #1f1b16;
            --ink-soft: #3a332c;
            --line: #e5e0d6;
        }

        body {
            background: #ffffff !important;
        }

        .invoice-wrap {
            max-width: 860px;
            margin: 20px auto;
            padding: 12px 16px;
            font-family: 'Manrope', Arial, sans-serif;
            color: var(--ink);
        }

        .invoice-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            border-bottom: 2px solid var(--line);
            padding-bottom: 10px;
            margin-bottom: 12px;
        }

        .invoice-title {
            font-size: 22px;
            font-weight: 700;
            margin: 0 0 4px;
        }

        .invoice-meta {
            font-size: 12px;
            color: var(--ink-soft);
        }

        .invoice-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 14px;
        }

        .invoice-block h4 {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--ink-soft);
            margin-bottom: 6px;
        }

        .invoice-block p {
            margin: 2px 0;
            font-size: 13px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid var(--line);
            padding: 6px 8px;
        }

        .invoice-table th {
            text-align: left;
            background: #f8f6f2;
            font-weight: 600;
        }

        .invoice-totals {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .totals-box {
            border: 1px solid var(--line);
            padding: 8px 10px;
            font-size: 13px;
        }

        .totals-row {
            display: flex;
            justify-content: space-between;
            margin: 2px 0;
        }

        .totals-row strong {
            font-weight: 700;
        }

        @media print {
            .invoice-wrap {
                margin: 0;
                padding: 0;
            }
        }
    </style>

    <div class="invoice-wrap">
        <div class="invoice-head">
            <div>
                <h1 class="invoice-title">Sales Invoice</h1>
                <div class="invoice-meta">Bill No: {{ $sales->bill_no ?? '-' }}</div>
            </div>
            <div class="invoice-meta">
                <div>Date: {{ $sales->sales_date ?? '-' }}</div>
                <div>Assistant: {{ $sales->assistant_name ?? '-' }}</div>
                <div>Sold By: {{ $sales->sold_by ?? '-' }}</div>
            </div>
        </div>

        <div class="invoice-grid">
            <div class="invoice-block">
                <h4>Customer</h4>
                <p><strong>{{ $sales->customer_name ?? '-' }}</strong></p>
                <p>{{ $sales->customer_phone ?? '-' }}</p>
                <p>{{ $sales->customer_address ?? '-' }}</p>
            </div>
            <div class="invoice-block">
                <h4>Payment</h4>
                <p>Method: {{ $sales->payment_method ?? '-' }}</p>
                <p>Status: {{ $sales->status ?? '-' }}</p>
                <p>Details: {{ $sales->payment_details ?? '-' }}</p>
            </div>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th style="width: 40px;">#</th>
                    <th>Product</th>
                    <th style="width: 80px;">Qty</th>
                    <th style="width: 100px;">Price</th>
                    <th style="width: 110px;">Total</th>
                    <th style="width: 160px;">Remarks</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->product_name ?? '-' }}</td>
                        <td>{{ $item->qty ?? 0 }}</td>
                        <td>{{ $item->price ?? 0 }}</td>
                        <td>{{ $item->total ?? 0 }}</td>
                        <td>{{ $item->remarks ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="invoice-totals">
            <div class="totals-box">
                <div class="totals-row"><span>Gross</span><span>{{ $sales->gross_amount ?? 0 }}</span></div>
                <div class="totals-row"><span>Special Discount %</span><span>{{ $sales->special_discount_percent ?? 0 }}</span></div>
                <div class="totals-row"><span>Manual Discount %</span><span>{{ $sales->manual_discount_percent ?? 0 }}</span></div>
                <div class="totals-row"><span>Loyalty</span><span>{{ $sales->loyalty ?? 0 }}</span></div>
                <div class="totals-row"><span>Net Amount</span><strong>{{ $sales->net_amount ?? 0 }}</strong></div>
            </div>
            <div class="totals-box">
                <div class="totals-row"><span>Given</span><span>{{ $sales->given_amount ?? 0 }}</span></div>
                <div class="totals-row"><span>Paid</span><span>{{ $sales->paid_amount ?? 0 }}</span></div>
                <div class="totals-row"><span>New Paid</span><span>{{ $sales->new_paid_amount ?? 0 }}</span></div>
                <div class="totals-row"><span>Payable</span><strong>{{ $sales->payable_amount ?? 0 }}</strong></div>
                <div class="totals-row"><span>Reference</span><span>{{ $sales->reference ?? '-' }}</span></div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('load', () => {
            window.print();
        });
    </script>
@endsection
