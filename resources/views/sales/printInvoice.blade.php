@extends('layouts.mainFullPage')

@push('title')
    <title>Sales Invoice</title>
@endpush

@section('main-section')
    @php
        $fmt = static fn($value) => number_format((float) ($value ?? 0), 2, '.', '');
        $fmtQty = static function ($value): string {
            $num = (float) ($value ?? 0);
            if ((int) $num == $num) {
                return (string) (int) $num;
            }
            return rtrim(rtrim(number_format($num, 2, '.', ''), '0'), '.');
        };
        $toWordsBelowThousand = static function (int $number): string {
            $ones = [
                0 => '',
                1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five',
                6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine', 10 => 'Ten',
                11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen', 14 => 'Fourteen',
                15 => 'Fifteen', 16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
                19 => 'Nineteen'
            ];
            $tens = [
                2 => 'Twenty', 3 => 'Thirty', 4 => 'Forty', 5 => 'Fifty',
                6 => 'Sixty', 7 => 'Seventy', 8 => 'Eighty', 9 => 'Ninety'
            ];

            $words = [];
            if ($number >= 100) {
                $words[] = $ones[intdiv($number, 100)] . ' Hundred';
                $number %= 100;
                if ($number > 0) {
                    $words[] = 'And';
                }
            }
            if ($number >= 20) {
                $words[] = $tens[intdiv($number, 10)];
                $number %= 10;
            }
            if ($number > 0 && $number < 20) {
                $words[] = $ones[$number];
            } elseif ($number > 0) {
                $words[] = $ones[$number];
            }

            return trim(implode(' ', array_filter($words)));
        };

        $toBdWords = null;
        $toBdWords = static function (int $number) use (&$toBdWords, $toWordsBelowThousand): string {
            if ($number === 0) {
                return 'Zero';
            }

            $parts = [];
            $crore = intdiv($number, 10000000);
            $number %= 10000000;
            $lakh = intdiv($number, 100000);
            $number %= 100000;
            $thousand = intdiv($number, 1000);
            $number %= 1000;
            $hundred = intdiv($number, 100);
            $rest = $number % 100;

            if ($crore > 0) {
                $parts[] = $toBdWords($crore) . ' Crore';
            }
            if ($lakh > 0) {
                $parts[] = $toWordsBelowThousand($lakh) . ' Lakh';
            }
            if ($thousand > 0) {
                $parts[] = $toWordsBelowThousand($thousand) . ' Thousand';
            }
            if ($hundred > 0) {
                $parts[] = $toWordsBelowThousand($hundred) . ' Hundred';
            }
            if ($rest > 0) {
                $parts[] = $toWordsBelowThousand($rest);
            }

            return trim(implode(' ', array_filter($parts)));
        };

        $amount = round((float) ($sales->net_amount ?? 0), 2);
        $whole = (int) floor($amount);
        $fraction = (int) round(($amount - $whole) * 100);
        $inWords = $toBdWords($whole);
        if ($fraction > 0) {
            $inWords .= ' Point ' . implode(' ', array_map(
                fn($d) => ['Zero','One','Two','Three','Four','Five','Six','Seven','Eight','Nine'][(int) $d],
                str_split(str_pad((string) $fraction, 2, '0', STR_PAD_LEFT))
            ));
        }
        $inWords .= ' Only';
    @endphp
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

        .brand img {
            max-width: 300px;
            width: 100%;
            height: auto;
        }

        .invoice-label {
            text-align: center;
            letter-spacing: 0.35em;
            font-weight: 700;
            font-size: 18px;
            margin: 6px 0;
        }

        .barcode {
            margin: 6px auto 4px;
            width: 96%;
            text-align: center;
        }

        .barcode svg {
            width: 100%;
            height: 30px;
        }

        .bill-meta {
            text-align: center;
            font-size: 11px;
            margin-bottom: 6px;
        }

        .bill-meta strong {
            font-weight: 700;
        }

        .bill-meta-date {
            font-style: italic;
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

        .contact-line {
            font-style: italic;
        }

        .contact-line strong {
            font-weight: 700;
        }

        .in-word-line {
            font-style: italic;
            margin-bottom: 12px;
        }

        .in-word-line strong {
            font-weight: 700;
        }

        .policy-block {
            margin-bottom: 10px;
        }

        @media print {
            @page {
                size: auto;
                margin: 8mm;
            }

            body {
                margin: 0;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .invoice-wrap {
                margin: 0;
                padding: 0;
                width: 420px;
                font-size: 14px;
                font-weight: 400;
                font-synthesis: none;
            }

            .invoice-label {
                font-size: 20px;
                font-weight: 700;
            }

            .bill-meta,
            .invoice-table,
            .totals-table,
            .invoice-footer {
                font-size: 13px;
                font-weight: 400;
            }

            .invoice-table th,
            .invoice-table td,
            .totals-table td {
                padding: 6px 7px;
            }

            .invoice-table td,
            .totals-table td,
            .invoice-footer div,
            .bill-meta div {
                font-weight: 400;
            }

            .invoice-table th,
            .bill-meta strong,
            .in-word-line strong,
            .contact-line strong {
                font-weight: 700;
            }
        }
    </style>

    <div class="invoice-wrap">
        <div class="invoice-top">
            {{-- <div>{{ optional($sales->created_at)->format('d/m/Y, H:i') ?? ($sales->sales_date ?? '-') }}</div>
            <div>Customer Invoice</div> --}}
        </div>

        <div class="brand">
            <img src="{{ asset('img/invoice_logo.png') }}" alt="Invoice Logo">
        </div>

        <div class="invoice-label">INVOICE</div>
        <div class="barcode">
            <svg id="invoiceBarcode"></svg>
        </div>
        <div class="bill-meta">
            <div><strong>Bill No:</strong> {{ $sales->bill_no ?? '-' }}</div>
            <div><strong>Customer Contact:</strong> {{ $sales->customer_phone ?? '-' }}</div>
            <div class="bill-meta-date">
                {{ !empty($sales->sales_date) ? \Carbon\Carbon::parse($sales->sales_date)->format('d/m/Y') : '-' }}
                {{ optional($sales->created_at)->format('h:i A') ?? '' }}, [ Mushak - 6.3 ]
            </div>
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
                            @if (!empty($item->product_code))
                                <div style="font-size: 10px; color: var(--ink-soft);">[{{ $item->product_code }}]</div>
                            @endif
                            @if (!empty($item->remarks))
                                <div style="font-size: 10px; color: var(--ink-soft);">{{ $item->remarks }}</div>
                            @endif
                        </td>
                        <td>{{ $fmtQty($item->qty) }}{{ $item->unit_type ?? '' }}</td>
                        <td>{{ $item->total ?? 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="totals-table">
            <tbody>
                <tr><td>Gross Amount :</td><td>{{ $fmt($sales->gross_amount) }}</td></tr>
                <tr><td>Discount :</td><td>{{ $fmt(($sales->gross_amount ?? 0) - ($sales->net_amount ?? 0)) }}</td></tr>
                <tr><td>Net Amount :</td><td>{{ $fmt($sales->net_amount) }}</td></tr>
                <tr><td>Received :</td><td>{{ $fmt($sales->given_amount) }}</td></tr>
                <tr><td>Returned :</td><td>{{ $fmt(($sales->given_amount ?? 0) - ($sales->paid_amount ?? 0)) }}</td></tr>
                <tr><td>Paid Amount :</td><td>{{ $fmt($sales->paid_amount) }}</td></tr>
                <tr><td>Payable :</td><td>{{ $fmt($sales->payable_amount) }}</td></tr>
                <tr><td>Paid Status :</td><td>{{ $sales->status ?? '-' }}</td></tr>
            </tbody>
        </table>

        <div class="invoice-footer">
            <div class="in-word-line"><strong>In Word:</strong> {{ $inWords }}.</div>
            <div class="policy-block">
                <div>All Product Price Were Including VAT. Exchange or Return</div>
                <div>Would be Valid in 7 Days and Unregistered Customer Must</div>
                <div>Bring Invoice Copy.</div>
            </div>
            <div class="contact-line"><strong>Contacts:</strong> House: 1/C & 1/D, First Floor, Road: 16, Nikunja-2,</div>
            <div class="contact-line">Khilkhet, Dhaka-1229, Bangladesh., Cell: 01708523220</div>
            <div style="margin-top: 12px;">Thank You For Shopping With Us.</div>
        </div>
    </div>

    <script src="{{ asset('bootstrap/js/JsBarcode.all.min.js') }}"></script>
    <script>
        window.addEventListener('load', () => {
            const billNo = @json($sales->bill_no ?? '');
            if (billNo && window.JsBarcode) {
                JsBarcode('#invoiceBarcode', billNo, {
                    format: 'CODE128',
                    displayValue: false,
                    lineColor: '#111111',
                    width: 1.6,
                    height: 28,
                    margin: 0
                });
            }
            window.print();
        });
    </script>
@endsection
