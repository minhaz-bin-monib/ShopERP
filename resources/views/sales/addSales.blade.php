@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Sales Order</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Manrope:wght@300;400;500;600;700&display=swap');

        :root {
            --ink: #1f1b16;
            --ink-soft: #3a332c;
            --sea: #2f6f74;
            --sun: #f7c243;
            --paper: #fffdf9;
            --line: #eadfce;
            --shadow: 0 18px 50px rgba(28, 23, 16, 0.12);
        }

        .sales-page {
            min-height: 72vh;
            padding: 16px 10px 40px;
        }

        .sales-shell {
            background: var(--paper);
            border-radius: 22px;
            box-shadow: var(--shadow);
            border: 1px solid var(--line);
            overflow: hidden;
        }

        .sales-hero {
            background: linear-gradient(160deg, #2f6f74, #3c8f8a);
            color: #ffffff;
            padding: 16px 22px;
        }

        .sales-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.18);
            border-radius: 999px;
            padding: 6px 14px;
            font-family: 'Manrope', Arial, sans-serif;
            font-size: 18px;
        }

        .sales-badge span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--sun);
        }

        .sales-body {
            padding: 12px 14px 22px;
        }

        .sales-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.6fr) minmax(0, 1fr);
            gap: 14px;
            align-items: start;
        }

        .sales-card {
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 10px 12px 12px;
        }

        .sales-card-title {
            font-family: 'DM Serif Display', Georgia, serif;
            font-size: 22px;
            color: var(--ink);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sales-card-title span {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--sun);
            box-shadow: 0 0 0 6px rgba(247, 194, 67, 0.2);
            flex: none;
        }

        .sales-form label {
            font-family: 'Manrope', Arial, sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: var(--ink);
        }

        .sales-form .form-control,
        .sales-form select {
            border-radius: 12px;
            border: 1px solid #e8dcca;
            background: #fffdf9;
            height: 38px;
            padding: 6px 10px;
            font-family: 'Manrope', Arial, sans-serif;
            font-size: 14px;
        }

        .sales-form textarea.form-control {
            height: auto;
            min-height: 86px;
        }

        .sales-form .form-control:focus,
        .sales-form select:focus {
            border-color: var(--sea);
            box-shadow: 0 0 0 3px rgba(47, 111, 116, 0.15);
        }

        .sales-items-table {
            width: 100%;
            font-family: 'Manrope', Arial, sans-serif;
            font-size: 13px;
        }

        .sales-items-table thead th {
            border: 1px solid rgba(78, 70, 60, 0.12);
            background: transparent;
            font-weight: 600;
            color: var(--ink-soft);
            padding: 4px 6px;
        }

        .sales-items-table tbody td {
            border: 1px solid rgba(78, 70, 60, 0.1);
            padding: 4px 6px;
        }

        .sales-items-table th:nth-child(5),
        .sales-items-table td:nth-child(5) {
            width: 160px;
        }

        .sales-items-table .form-control,
        .sales-items-table select {
            height: 30px;
            padding: 3px 6px;
            font-size: 12px;
        }

        .sales-items-table .btn {
            padding: 2px 6px;
            font-size: 11px;
            line-height: 1.2;
        }

        .sales-add-item {
            background: rgba(47, 111, 116, 0.12);
            border: 1px solid rgba(47, 111, 116, 0.2);
            color: var(--sea);
            font-weight: 600;
            border-radius: 999px;
            padding: 6px 12px;
            font-size: 12px;
        }

        .sales-actions {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-top: 10px;
        }

        .sales-actions .sales-muted {
            margin-right: auto;
        }

        .sales-btn {
            background: linear-gradient(135deg, #2f6f74, #7cc9b0);
            border: none;
            color: #ffffff;
            font-family: 'Manrope', Arial, sans-serif;
            font-weight: 700;
            padding: 8px 18px;
            border-radius: 999px;
            box-shadow: 0 14px 30px rgba(47, 111, 116, 0.3);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            font-size: 14px;
        }

        .sales-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 38px rgba(47, 111, 116, 0.35);
        }

        .sales-muted {
            font-family: 'Manrope', Arial, sans-serif;
            color: rgba(31, 27, 22, 0.7);
            font-size: 13px;
        }

        .sales-summary {
            display: grid;
            gap: 12px;
        }

        .payment-summary {
            display: grid;
            gap: 10px;
        }

        .summary-grid {
            display: grid;
            gap: 8px;
        }

        .summary-block {
            border: 1px dashed rgba(78, 70, 60, 0.2);
            border-radius: 16px;
            padding: 8px 10px;
            background: #fffdf9;
        }

        .summary-block h5 {
            font-family: 'Manrope', Arial, sans-serif;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: rgba(31, 27, 22, 0.65);
            margin-bottom: 6px;
        }

        .summary-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .summary-row.three {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .summary-row .form-group {
            margin-bottom: 0;
        }

        .summary-inline {
            display: grid;
            gap: 8px;
        }

        .summary-inline .form-group {
            margin-bottom: 0;
        }

        .summary-space-sm {
            margin-top: 6px;
        }

        .summary-space-md {
            margin-top: 8px;
        }

        .summary-totals {
            display: grid;
            grid-template-columns: 1fr;
            gap: 8px;
        }

        .summary-totals .form-group {
            margin-bottom: 0;
            display: grid;
            grid-template-columns: 0.35fr 1fr;
            gap: 8px;
            align-items: center;
        }

        .summary-totals .form-group label {
            margin-bottom: 0;
        }

        .summary-totals .form-control[readonly] {
            background: rgba(47, 111, 116, 0.08);
            font-weight: 600;
        }

        .payment-summary .form-control[readonly] {
            background: rgba(78, 70, 60, 0.06);
        }

        .summary-totals .form-control[readonly] {
            background: rgba(47, 111, 116, 0.08);
        }

        .payment-summary .form-control.is-negative {
            color: #b3261e;
            border-color: rgba(179, 38, 30, 0.45);
            background: rgba(179, 38, 30, 0.06);
        }

        .summary-toggle {
            margin-left: auto;
            border: 1px solid rgba(47, 111, 116, 0.3);
            background: rgba(47, 111, 116, 0.08);
            color: var(--sea);
            font-family: 'Manrope', Arial, sans-serif;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 999px;
        }

        .summary-toggle:hover {
            background: rgba(47, 111, 116, 0.15);
        }

        .summary-hidden {
            display: none;
        }

        @media (max-width: 991px) {
            .sales-grid {
                grid-template-columns: 1fr;
            }

            .summary-row {
                grid-template-columns: 1fr;
            }

            .summary-row.three {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="container-fluid sales-page">
        <div class="sales-shell">
            <div class="sales-hero">
                <div class="sales-badge">
                    <span></span>
                    {{ $toptitle }}
                </div>
            </div>

            <div class="sales-body">
                <form action="{{ $url }}" method="post" class="sales-form">
                    @csrf
                    <input type="hidden" name="action_print" id="actionPrintFlag" value="0">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="salesErrorAlert">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="sales-grid">
                        <div class="sales-card">
                            <div class="sales-card-title"><span></span>Sales Items</div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Assistant</label>
                                    <select name="assistant_name" class="form-control">
                                        <option value="">Select Employee</option>
                                        @foreach ($employees as $emp)
                                            <option value="{{ $emp->name }}">{{ $emp->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Bill No</label>
                                    <input type="text" name="bill_no" value="{{ $billNo }}" class="form-control">
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="sales-items-table" id="salesItemsTable">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th style="width: 90px;">Qty</th>
                                            <th style="width: 130px;">Price</th>
                                            <th style="width: 130px;">Total</th>
                                            <th>Remarks</th>
                                            <th style="width: 60px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="sales-item-row">
                                            <td>
                                                <select name="product_id[]" class="form-control product-select">
                                                    <option value="">Select Product</option>
                                                    @foreach ($products as $prod)
                                                        <option value="{{ $prod->product_id }}" data-price="{{ $prod->selling_price ?? 0 }}">
                                                            {{ $prod->product_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" step="0.01" name="qty[]" class="form-control qty-input" value="1">
                                            </td>
                                            <td>
                                                <input type="number" step="0.01" name="price[]" class="form-control price-input">
                                            </td>
                                            <td>
                                                <input type="number" step="0.01" name="total[]" class="form-control total-input" readonly>
                                            </td>
                                            <td>
                                                <input type="text" name="remarks[]" class="form-control" placeholder="Remarks">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger remove-row">X</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <button type="button" class="sales-add-item" id="addItemBtn">Add Item</button>

                            <div class="sales-card-title" style="margin-top: 16px;"><span></span>Customer Information</div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Customer List</label>
                                    <select name="customer_id" class="form-control" id="customerSelect">
                                        <option value="">Select Customer</option>
                                        @foreach ($customers as $cust)
                                            <option value="{{ $cust->customer_id }}"
                                                data-name="{{ $cust->customer_name }}"
                                                data-address="{{ $cust->customer_address }}"
                                                data-phone="{{ $cust->customer_phone }}">
                                                {{ $cust->customer_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Sales Date</label>
                                    <input type="date" name="sales_date" value="{{ $sales->sales_date }}" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Customer Name</label>
                                    <input type="text" name="customer_name" id="customerName" class="form-control" placeholder="Enter Customer Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Customer Phone</label>
                                    <input type="text" name="customer_phone" id="customerPhone" class="form-control" placeholder="Enter Customer Phone">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Customer Address</label>
                                    <input type="text" name="customer_address" id="customerAddress" class="form-control" placeholder="Enter Customer Address">
                                </div>
                            </div>
                        </div>

                        <div class="sales-card">
                            <div class="sales-card-title">
                                <span></span>Payment Summary
                                <button type="button" class="summary-toggle" id="toggleDiscountsBtn">Show Discounts</button>
                            </div>
                            <div class="payment-summary">
                                <div class="summary-grid">
                                    <div class="summary-block summary-hidden" id="discountsBlock">
                                        <h5>Discounts & Offers</h5>
                                        <div class="summary-row">
                                            <div class="form-group">
                                                <label>Special Discount %</label>
                                                <input type="number" step="0.01" name="special_discount_percent" class="form-control" value="0">
                                            </div>
                                            <div class="form-group">
                                                <label>Manual Discount %</label>
                                                <input type="number" step="0.01" name="manual_discount_percent" class="form-control" value="0">
                                            </div>
                                        </div>
                                        <div class="summary-row three summary-space-sm">
                                            <div class="form-group">
                                                <label>Offer</label>
                                                <input type="text" name="offer" class="form-control" placeholder="Apply Offer">
                                            </div>
                                            <div class="form-group">
                                                <label>Loyalty</label>
                                                <input type="number" step="0.01" name="loyalty" class="form-control" value="0">
                                            </div>
                                            <div class="form-group">
                                                <label>Bonus</label>
                                                <input type="text" name="bonus_card" class="form-control" placeholder="Scan Card">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="summary-block">
                                        <h5>Totals</h5>
                                        <div class="summary-totals">
                                            <div class="form-group">
                                                <label>Gross</label>
                                                <input type="number" step="0.01" name="gross_amount" class="form-control" value="0" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Net Amount</label>
                                                <input type="number" step="0.01" name="net_amount" class="form-control" value="0" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="summary-block">
                                        <h5>Payment</h5>
                                        <div class="summary-row summary-space-md">
                                            <div class="form-group">
                                                <label>Given</label>
                                                <input type="number" step="0.01" name="given_amount" class="form-control" value="0">
                                            </div>
                                            <div class="form-group">
                                                <label>Paid Amount</label>
                                                <input type="number" step="0.01" name="paid_amount" class="form-control" value="0">
                                            </div>
                                        </div>
                                        <div class="summary-row summary-space-md">
                                            <div class="form-group">
                                                <label>New Paid Amount</label>
                                                <input type="number" step="0.01" name="new_paid_amount" class="form-control" value="0">
                                            </div>
                                            <div class="form-group">
                                                <label>Return Amount</label>
                                                <input type="text" name="return_amount" class="form-control" value="0.00" readonly>
                                            </div>
                                        </div>
                                        <div class="summary-row summary-space-md">
                                            <div class="form-group">
                                                <label>Amount Due</label>
                                                <input type="number" step="0.01" name="payable_amount" class="form-control" value="0" readonly>
                                            </div>
                                        </div>
                                        <div class="summary-row summary-space-md">
                                            <div class="form-group">
                                                <label>Method</label>
                                                <select name="payment_method" class="form-control">
                                                    @forelse($paymentMethods as $method)
                                                        <option value="{{ $method->attribute_name }}">{{ $method->attribute_name }}</option>
                                                    @empty
                                                        <option value="Cash">Cash</option>
                                                        <option value="Bank">Bank</option>
                                                        <option value="Bkash">Bkash</option>
                                                        <option value="Rocket">Rocket</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Details</label>
                                                <input type="text" name="payment_details" class="form-control" placeholder="Cheque No, Bank Name, Bkash No, Rocket No, Pure No, Etc..">
                                            </div>
                                        </div>
                                        <div class="summary-row summary-space-md">
                                            <div class="form-group">
                                                <label>Reference</label>
                                                <input type="text" name="reference" class="form-control" value="0">
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="Paid">Paid</option>
                                                    <option value="Unpaid">Unpaid</option>
                                                    <option value="Partial">Partial</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="sold_by" value="{{ session('loginId') }}">
                        </div>
                    </div>
                    <div class="sales-actions">
                        <div class="sales-muted">Sales order will be saved and added to invoice list.</div>
                        <button type="button" class="sales-btn" data-bs-toggle="modal" data-bs-target="#saveSalesModal">Save & Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="saveSalesModal" tabindex="-1" aria-labelledby="saveSalesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="saveSalesModalLabel">Confirm Save</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Save this sales order now?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="confirmSaveBtn">Save & Print</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        const pageName = document.getElementById('PageName');
        if (pageName) {
            pageName.innerText = '{{ $toptitle }}';
        }

        const discountsBlock = document.getElementById('discountsBlock');
        const toggleDiscountsBtn = document.getElementById('toggleDiscountsBtn');

        if (toggleDiscountsBtn && discountsBlock) {
            toggleDiscountsBtn.addEventListener('click', () => {
                discountsBlock.classList.toggle('summary-hidden');
                toggleDiscountsBtn.innerText = discountsBlock.classList.contains('summary-hidden')
                    ? 'Show Discounts'
                    : 'Hide Discounts';
            });
        }

        const salesItemsTable = document.getElementById('salesItemsTable');
        const addItemBtn = document.getElementById('addItemBtn');
        const salesForm = document.querySelector('form.sales-form');
        const customerSelect = document.getElementById('customerSelect');
        const customerName = document.getElementById('customerName');
        const customerPhone = document.getElementById('customerPhone');
        const customerAddress = document.getElementById('customerAddress');

        const grossInput = document.querySelector('input[name="gross_amount"]');
        const netInput = document.querySelector('input[name="net_amount"]');
        const payableInput = document.querySelector('input[name="payable_amount"]');
        const specialInput = document.querySelector('input[name="special_discount_percent"]');
        const manualInput = document.querySelector('input[name="manual_discount_percent"]');
        const loyaltyInput = document.querySelector('input[name="loyalty"]');
        const givenInput = document.querySelector('input[name="given_amount"]');
        const paidInput = document.querySelector('input[name="paid_amount"]');
        const returnInput = document.querySelector('input[name="return_amount"]');

        const recalcRow = (row) => {
            const qty = parseFloat(row.querySelector('.qty-input').value || '0');
            const price = parseFloat(row.querySelector('.price-input').value || '0');
            const total = qty * price;
            row.querySelector('.total-input').value = total.toFixed(2);
        };

        const recalcSummary = () => {
            let gross = 0;
            document.querySelectorAll('.sales-item-row').forEach((row) => {
                const total = parseFloat(row.querySelector('.total-input').value || '0');
                gross += total;
            });
            const special = parseFloat(specialInput.value || '0');
            const manual = parseFloat(manualInput.value || '0');
            const loyalty = parseFloat(loyaltyInput.value || '0');
            const net = gross - (gross * special / 100) - (gross * manual / 100) - loyalty;
            const paid = parseFloat(paidInput.value || '0');
            const given = parseFloat(givenInput.value || '0');
            grossInput.value = gross.toFixed(2);
            netInput.value = net.toFixed(2);
            payableInput.value = (net - paid).toFixed(2);
            if (returnInput) {
                const returned = given - paid;
                returnInput.value = returned.toFixed(2);
                returnInput.classList.toggle('is-negative', returned < 0);
            }
        };

        const bindRowEvents = (row) => {
            const productSelect = row.querySelector('.product-select');
            const qtyInput = row.querySelector('.qty-input');
            const priceInput = row.querySelector('.price-input');
            const removeBtn = row.querySelector('.remove-row');

            productSelect.addEventListener('change', () => {
                const option = productSelect.options[productSelect.selectedIndex];
                const price = option ? option.getAttribute('data-price') : '';
                if (price !== null && price !== '') {
                    priceInput.value = parseFloat(price).toFixed(2);
                }
                recalcRow(row);
                recalcSummary();
            });

            qtyInput.addEventListener('input', () => {
                recalcRow(row);
                recalcSummary();
            });
            priceInput.addEventListener('input', () => {
                recalcRow(row);
                recalcSummary();
            });

            removeBtn.addEventListener('click', () => {
                if (document.querySelectorAll('.sales-item-row').length > 1) {
                    row.remove();
                    recalcSummary();
                }
            });
        };

        document.querySelectorAll('.sales-item-row').forEach(bindRowEvents);

        addItemBtn.addEventListener('click', () => {
            const row = document.querySelector('.sales-item-row').cloneNode(true);
            row.querySelectorAll('input').forEach(input => input.value = '');
            row.querySelector('.qty-input').value = 1;
            row.querySelector('.total-input').value = '';
            row.querySelector('.product-select').selectedIndex = 0;
            salesItemsTable.querySelector('tbody').appendChild(row);
            bindRowEvents(row);
        });

        [specialInput, manualInput, loyaltyInput, givenInput, paidInput].forEach((input) => {
            input.addEventListener('input', recalcSummary);
        });

        customerSelect.addEventListener('change', () => {
            const option = customerSelect.options[customerSelect.selectedIndex];
            customerName.value = option ? option.getAttribute('data-name') || '' : '';
            customerAddress.value = option ? option.getAttribute('data-address') || '' : '';
            customerPhone.value = option ? option.getAttribute('data-phone') || '' : '';
        });

        const confirmSaveBtn = document.getElementById('confirmSaveBtn');
        const actionPrintFlag = document.getElementById('actionPrintFlag');

        if (salesForm) {
            salesForm.addEventListener('keydown', (event) => {
                if (event.key === 'Enter') {
                    const target = event.target;
                    const isTextArea = target && target.tagName === 'TEXTAREA';
                    if (!isTextArea) {
                        event.preventDefault();
                    }
                }
            });
        }

        if (confirmSaveBtn && salesForm) {
            confirmSaveBtn.addEventListener('click', () => {
                if (actionPrintFlag) {
                    actionPrintFlag.value = '1';
                }
                salesForm.submit();
            });
        }

        const salesErrorAlert = document.getElementById('salesErrorAlert');
        if (salesErrorAlert) {
            salesErrorAlert.addEventListener('closed.bs.alert', () => {
                salesErrorAlert.remove();
            });
            setTimeout(() => {
                if (salesErrorAlert.parentElement) {
                    salesErrorAlert.remove();
                }
            }, 5000);
        }

        recalcRow(document.querySelector('.sales-item-row'));
        recalcSummary();

        const printUrl = @json(session('print_url'));
        if (printUrl) {
            window.open(printUrl, '_blank');
        }
    </script>

    <!-- END View Content Here -->
@endsection
