@extends('layouts.main')

<!-- Set Title -->
@push('title')
<title>Dashboard</title>
@endpush

@section('main-section')
<!-- START View Content Here -->
<link rel="stylesheet" href="{{ asset('bootstrap/css/dashboard.css') }}">

<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Manrope:wght@300;400;500;600;700&display=swap');

    :root {
        --ink: #1f1b16;
        --ink-soft: #4e463c;
        --paper: #fffdf9;
        --line: #eadfce;
        --accent: #2f6f74;
        --accent-2: #7cc9b0;
        --warm: #f7c243;
        --shadow: 0 18px 50px rgba(28, 23, 16, 0.12);
    }

    .dash-wrap {
        padding: 16px 6px 40px;
    }

    .dash-shell {
        background: var(--paper);
        border-radius: 22px;
        box-shadow: var(--shadow);
        border: 1px solid var(--line);
        overflow: hidden;
    }

    .dash-head {
        padding: 16px 20px;
        background: linear-gradient(135deg, rgba(47, 111, 116, 0.2), rgba(124, 201, 176, 0.3));
    }

    .dash-title {
        font-family: 'DM Serif Display', Georgia, serif;
        font-size: 28px;
        color: var(--ink);
        margin: 0;
    }

    .dash-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
        padding: 18px 18px 24px;
    }

    .dash-grid--three {
        grid-template-columns: repeat(3, minmax(0, 1fr));
        padding-top: 0;
    }

    .metric-card {
        background: #ffffff;
        border: 1px solid var(--line);
        border-radius: 18px;
        padding: 18px 18px 16px;
        display: grid;
        gap: 14px;
    }

    .metric-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .metric-title {
        font-family: 'Manrope', Arial, sans-serif;
        font-weight: 700;
        font-size: 16px;
        color: var(--ink);
    }

    .metric-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 12px;
        border-radius: 999px;
        background: rgba(47, 111, 116, 0.12);
        color: var(--accent);
        font-family: 'Manrope', Arial, sans-serif;
        font-size: 12px;
        font-weight: 600;
    }

    .metric-value {
        font-family: 'DM Serif Display', Georgia, serif;
        font-size: 32px;
        color: var(--ink);
        letter-spacing: 0.4px;
    }

    .metric-sub {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 10px;
    }

    .metric-chip {
        border: 1px solid var(--line);
        border-radius: 12px;
        padding: 8px 10px;
        background: #fffdf9;
        font-family: 'Manrope', Arial, sans-serif;
        font-size: 12px;
        color: var(--ink-soft);
    }

    .metric-chip strong {
        display: block;
        font-size: 14px;
        color: var(--ink);
    }

    .metric-bar {
        height: 10px;
        border-radius: 999px;
        background: rgba(47, 111, 116, 0.1);
        overflow: hidden;
    }

    .metric-bar span {
        display: block;
        height: 100%;
        background: linear-gradient(135deg, var(--accent), var(--accent-2));
        width: 65%;
    }

    .metric-note {
        font-family: 'Manrope', Arial, sans-serif;
        font-size: 12px;
        color: var(--ink-soft);
    }

    .metric-chart {
        width: 100%;
        height: 120px;
        border-radius: 14px;
        background: linear-gradient(135deg, rgba(47, 111, 116, 0.08), rgba(124, 201, 176, 0.12));
        border: 1px solid rgba(47, 111, 116, 0.12);
        padding: 8px 10px;
    }

    .metric-chart svg {
        width: 100%;
        height: 100%;
        display: block;
    }

    @media (max-width: 992px) {
        .dash-grid {
            grid-template-columns: 1fr;
        }
        .dash-grid--three {
            grid-template-columns: 1fr;
        }
        .metric-sub {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 576px) {
        .metric-sub {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container-fluid dash-wrap">
    <div class="dash-shell">
        <div class="dash-head">
            <h2 class="dash-title">Dashboard Overview</h2>
        </div>

        <div class="dash-grid">
            <div class="metric-card">
                <div class="metric-head">
                    <div class="metric-title">Total Purchase</div>
                    <div class="metric-badge">Updated today</div>
                </div>
                <div class="metric-value">{{ $purchaseTotal ?? '0.00' }}</div>
                <div class="metric-chart" aria-hidden="true">
                    <svg viewBox="0 0 600 160" preserveAspectRatio="none" role="img">
                        <defs>
                            <linearGradient id="purchaseLine" x1="0" x2="1">
                                <stop offset="0%" stop-color="#2f6f74"/>
                                <stop offset="100%" stop-color="#7cc9b0"/>
                            </linearGradient>
                            <linearGradient id="purchaseFill" x1="0" x2="0" y1="0" y2="1">
                                <stop offset="0%" stop-color="rgba(47,111,116,0.35)"/>
                                <stop offset="100%" stop-color="rgba(47,111,116,0)"/>
                            </linearGradient>
                        </defs>
                        <path d="M0 120 C60 90, 120 140, 180 110 C240 80, 300 120, 360 95 C420 70, 480 110, 540 85 C570 75, 585 70, 600 68 L600 160 L0 160 Z" fill="url(#purchaseFill)"/>
                        <path d="M0 120 C60 90, 120 140, 180 110 C240 80, 300 120, 360 95 C420 70, 480 110, 540 85 C570 75, 585 70, 600 68" fill="none" stroke="url(#purchaseLine)" stroke-width="4" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="metric-sub">
                    <div class="metric-chip">
                        Today
                        <strong>{{ $purchaseToday ?? '0.00' }}</strong>
                    </div>
                    <div class="metric-chip">
                        This Month
                        <strong>{{ $purchaseMonth ?? '0.00' }}</strong>
                    </div>
                    <div class="metric-chip">
                        This Year
                        <strong>{{ $purchaseYear ?? '0.00' }}</strong>
                    </div>
                </div>
                <div class="metric-bar"><span style="width: {{ $purchaseProgress ?? 65 }}%;"></span></div>
                <div class="metric-note">Purchase volume based on recent activity.</div>
            </div>

            <div class="metric-card">
                <div class="metric-head">
                    <div class="metric-title">Total Sales</div>
                    <div class="metric-badge">Updated today</div>
                </div>
                <div class="metric-value">{{ $salesTotal ?? '0.00' }}</div>
                <div class="metric-chart" aria-hidden="true">
                    <svg viewBox="0 0 600 160" preserveAspectRatio="none" role="img">
                        <defs>
                            <linearGradient id="salesLine" x1="0" x2="1">
                                <stop offset="0%" stop-color="#f7c243"/>
                                <stop offset="100%" stop-color="#ff7f6a"/>
                            </linearGradient>
                            <linearGradient id="salesFill" x1="0" x2="0" y1="0" y2="1">
                                <stop offset="0%" stop-color="rgba(247,194,67,0.35)"/>
                                <stop offset="100%" stop-color="rgba(247,194,67,0)"/>
                            </linearGradient>
                        </defs>
                        <path d="M0 130 C60 110, 120 125, 180 95 C240 70, 300 115, 360 90 C420 60, 480 95, 540 70 C570 60, 585 58, 600 56 L600 160 L0 160 Z" fill="url(#salesFill)"/>
                        <path d="M0 130 C60 110, 120 125, 180 95 C240 70, 300 115, 360 90 C420 60, 480 95, 540 70 C570 60, 585 58, 600 56" fill="none" stroke="url(#salesLine)" stroke-width="4" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="metric-sub">
                    <div class="metric-chip">
                        Today
                        <strong>{{ $salesToday ?? '0.00' }}</strong>
                    </div>
                    <div class="metric-chip">
                        This Month
                        <strong>{{ $salesMonth ?? '0.00' }}</strong>
                    </div>
                    <div class="metric-chip">
                        This Year
                        <strong>{{ $salesYear ?? '0.00' }}</strong>
                    </div>
                </div>
                <div class="metric-bar"><span style="width: {{ $salesProgress ?? 72 }}%;"></span></div>
                <div class="metric-note">Sales trend based on recent invoices.</div>
            </div>
        </div>

        <div class="dash-grid dash-grid--three">
            <div class="metric-card">
                <div class="metric-head">
                    <div class="metric-title">Products</div>
                    <div class="metric-badge">Inventory</div>
                </div>
                <div class="metric-value">{{ $productCount ?? '0' }}</div>
                <div class="metric-chart" aria-hidden="true">
                    <svg viewBox="0 0 600 160" preserveAspectRatio="none" role="img">
                        <defs>
                            <linearGradient id="productLine" x1="0" x2="1">
                                <stop offset="0%" stop-color="#2f6f74"/>
                                <stop offset="100%" stop-color="#7cc9b0"/>
                            </linearGradient>
                            <linearGradient id="productFill" x1="0" x2="0" y1="0" y2="1">
                                <stop offset="0%" stop-color="rgba(47,111,116,0.28)"/>
                                <stop offset="100%" stop-color="rgba(47,111,116,0)"/>
                            </linearGradient>
                        </defs>
                        <path d="M0 120 C70 90, 140 130, 210 100 C280 70, 350 115, 420 88 C490 60, 540 82, 600 70 L600 160 L0 160 Z" fill="url(#productFill)"/>
                        <path d="M0 120 C70 90, 140 130, 210 100 C280 70, 350 115, 420 88 C490 60, 540 82, 600 70" fill="none" stroke="url(#productLine)" stroke-width="4" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="metric-sub">
                    <div class="metric-chip">
                        Active
                        <strong>{{ $activeProducts ?? '0' }}</strong>
                    </div>
                    <div class="metric-chip">
                        Categories
                        <strong>{{ $categoryCount ?? '0' }}</strong>
                    </div>
                    <div class="metric-chip">
                        Brands
                        <strong>{{ $brandCount ?? '0' }}</strong>
                    </div>
                </div>
                <div class="metric-note">Live product catalog overview.</div>
            </div>

            <div class="metric-card">
                <div class="metric-head">
                    <div class="metric-title">Stock Health</div>
                    <div class="metric-badge">Alerts</div>
                </div>
                <div class="metric-value">{{ $stockValue ?? '0.00' }}</div>
                <div class="metric-chart" aria-hidden="true">
                    <svg viewBox="0 0 600 160" preserveAspectRatio="none" role="img">
                        <defs>
                            <linearGradient id="stockLine" x1="0" x2="1">
                                <stop offset="0%" stop-color="#f7c243"/>
                                <stop offset="100%" stop-color="#ff7f6a"/>
                            </linearGradient>
                            <linearGradient id="stockFill" x1="0" x2="0" y1="0" y2="1">
                                <stop offset="0%" stop-color="rgba(247,194,67,0.32)"/>
                                <stop offset="100%" stop-color="rgba(247,194,67,0)"/>
                            </linearGradient>
                        </defs>
                        <path d="M0 110 C80 80, 160 125, 240 92 C320 60, 400 112, 480 84 C540 65, 570 60, 600 58 L600 160 L0 160 Z" fill="url(#stockFill)"/>
                        <path d="M0 110 C80 80, 160 125, 240 92 C320 60, 400 112, 480 84 C540 65, 570 60, 600 58" fill="none" stroke="url(#stockLine)" stroke-width="4" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="metric-sub">
                    <div class="metric-chip">
                        Low Stock
                        <strong>{{ $lowStockCount ?? '0' }}</strong>
                    </div>
                    <div class="metric-chip">
                        Out of Stock
                        <strong>{{ $outOfStockCount ?? '0' }}</strong>
                    </div>
                    <div class="metric-chip">
                        Reorder
                        <strong>{{ $reorderCount ?? '0' }}</strong>
                    </div>
                </div>
                <div class="metric-note">Stock status across all items.</div>
            </div>

            <div class="metric-card">
                <div class="metric-head">
                    <div class="metric-title">POS Sales</div>
                    <div class="metric-badge">Counters</div>
                </div>
                <div class="metric-value">{{ $posTotal ?? '0.00' }}</div>
                <div class="metric-chart" aria-hidden="true">
                    <svg viewBox="0 0 600 160" preserveAspectRatio="none" role="img">
                        <defs>
                            <linearGradient id="posLine" x1="0" x2="1">
                                <stop offset="0%" stop-color="#2f6f74"/>
                                <stop offset="100%" stop-color="#f7c243"/>
                            </linearGradient>
                            <linearGradient id="posFill" x1="0" x2="0" y1="0" y2="1">
                                <stop offset="0%" stop-color="rgba(47,111,116,0.25)"/>
                                <stop offset="100%" stop-color="rgba(47,111,116,0)"/>
                            </linearGradient>
                        </defs>
                        <path d="M0 125 C70 100, 140 130, 210 98 C280 66, 350 120, 420 92 C490 66, 540 80, 600 68 L600 160 L0 160 Z" fill="url(#posFill)"/>
                        <path d="M0 125 C70 100, 140 130, 210 98 C280 66, 350 120, 420 92 C490 66, 540 80, 600 68" fill="none" stroke="url(#posLine)" stroke-width="4" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="metric-sub">
                    <div class="metric-chip">
                        Today
                        <strong>{{ $posToday ?? '0.00' }}</strong>
                    </div>
                    <div class="metric-chip">
                        This Month
                        <strong>{{ $posMonth ?? '0.00' }}</strong>
                    </div>
                    <div class="metric-chip">
                        Transactions
                        <strong>{{ $posTransactions ?? '0' }}</strong>
                    </div>
                </div>
                <div class="metric-note">Point‑of‑sale performance snapshot.</div>
            </div>
        </div>
    </div>
</div>


<!--
<div class="container">
    <h5>Dashboard</h5>
    <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Products</h6>
                    <h2 class="text-right"><i class="fa fa-cart-plus f-left"></i><span>112</span></h2>
                    <p class="m-b-0">Active<span class="f-right">108</span></p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Employees</h6>
                    <h2 class="text-right"><i class="fa fa-rocket f-left"></i><span>80</span></h2>
                    <p class="m-b-0">Active<span class="f-right">80</span></p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Invoice</h6>
                    <h2 class="text-right"><i class="fa fa-refresh f-left"></i><span>486</span></h2>
                    <p class="m-b-0">Completed<span class="f-right">351</span></p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-pink order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Sold Figure</h6>
                    <h2 class="text-right"><span>863,968,360.60</span></h2>
                  
                </div>
            </div>
        </div>
    </div>
</div>
-->
<!-- END View Content Here -->
@endsection
