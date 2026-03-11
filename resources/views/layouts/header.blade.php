<!DOCTYPE html>
<html lang="en">

<head>

    @stack('title')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="icon" href="{{ url('img/tablogo.png') }}" type="image/png">
    <script src="{{ asset('bootstrap/js/jquery3.5.1.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/datatable.css') }}">
    <script src="{{ asset('bootstrap/js/datatable.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/select.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/style.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap');

        :root {
            --side-ink: #17323b;
            --side-muted: #4f626b;
            --side-bg: #f8fbfc;
            --side-line: #dbe7ea;
            --side-accent: #2f6f74;
            --side-accent-2: #7cc9b0;
        }

        #sidebar {
            background: var(--side-bg);
            border-right: 1px solid var(--side-line);
            box-shadow: 12px 0 30px rgba(31, 27, 22, 0.05);
        }

        #sidebar .logo img {
            filter: saturate(1.05);
        }

        #sidebar .components {
            padding: 10px 10px 22px;
            font-family: 'Manrope', Arial, sans-serif;
        }

        #sidebar ul li a {
            color: var(--side-ink);
            font-weight: 600;
            font-size: 15px;
            padding: 10px 14px;
            margin: 6px 0;
            border-radius: 12px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        #sidebar ul li a:hover,
        #sidebar ul li a:focus {
            background: linear-gradient(135deg, rgba(47, 111, 116, 0.12), rgba(124, 201, 176, 0.2));
            color: #123038;
            text-decoration: none;
        }

        #sidebar ul li .dropdown-toggle::after {
            border-top-color: var(--side-muted);
        }

        #sidebar ul li ul li a {
            font-weight: 500;
            font-size: 14px;
            color: var(--side-muted);
            padding-left: 22px;
        }

        #sidebar ul li ul li a:hover {
            color: var(--side-ink);
        }

        #sidebar .custom-menu .sidebar-toggle {
            background: linear-gradient(135deg, var(--side-accent), var(--side-accent-2));
            border: none;
            box-shadow: 0 10px 24px rgba(47, 111, 116, 0.25);
            color: #ffffff;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        #sidebar .custom-menu .sidebar-toggle:hover {
            transform: translateY(-1px);
            box-shadow: 0 14px 28px rgba(47, 111, 116, 0.3);
        }

        #sidebar .custom-menu .sidebar-toggle:focus {
            box-shadow: 0 0 0 3px rgba(47, 111, 116, 0.35);
        }

        #sidebar .custom-menu .sidebar-toggle .fa {
            font-size: 18px;
        }

        #topHeader {
            font-family: 'Manrope', Arial, sans-serif;
        }

        #PageName {
            color: var(--side-accent) !important;
            font-weight: 700;
            letter-spacing: 0.6px;
        }

        @media (max-width: 991.98px) {
            #sidebar {
                margin-left: -180px;
            }

            #sidebar.active {
                margin-left: 0;
            }

            #content,
            #content.active {
                margin-left: 0 !important;
            }
        }
    </style>

</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn sidebar-toggle">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <div class="mx-2 p-1 pt-1">
                <h5><a href="/" class="logo">
                        <img style="width: 140px;height: 45px;display: inline-block;margin-top: -9px;margin-left: 1px;"
                            src="{{ url('/img/logo.png') }}">
                        <span class="text-white"><span>
                    </a></h5>
                @php
                    $isProduct = Request::is('product*');
                    $isCustomer = Request::is('customer*');
                    $isSupplier = Request::is('supplier*');
                    $isCompany = Request::is('company*');
                    $isAttributes = Request::is('attributes*');
                    $isCategory = Request::is('category*');
                @endphp
                @if (Session::get('loginRole') == 'Admin' || Session::get('loginRole') == 'Operator')
                    <ul class="list-unstyled components mb-5" id="sidebar-accordion">
                        <li>
                            <a href="#ProductSubmenu" data-bs-toggle="collapse" aria-expanded="{{ $isProduct ? 'true' : 'false' }}"
                                class="dropdown-toggle {{ $isProduct ? 'active' : '' }}">Product </a>
                            <ul class="collapse list-unstyled {{ $isProduct ? 'show' : '' }}" id="ProductSubmenu" data-bs-parent="#sidebar-accordion">
                                <li>
                                    <a href="{{ url('/product/create') }}">Add Product</a>
                                </li>
                                <li>
                                    <a href="{{ url('/product/list') }}">Products</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#CustomerSubmenu" data-bs-toggle="collapse" aria-expanded="{{ $isCustomer ? 'true' : 'false' }}"
                                class="dropdown-toggle {{ $isCustomer ? 'active' : '' }}">Customer </a>
                            <ul class="collapse list-unstyled {{ $isCustomer ? 'show' : '' }}" id="CustomerSubmenu" data-bs-parent="#sidebar-accordion">
                                <li>
                                    <a href="{{ url('/customer/create') }}">Add Customer</a>
                                </li>
                                <li>
                                    <a href="{{ url('/customer/list') }}">Customers</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#SupplierControllerSubmenu" data-bs-toggle="collapse" aria-expanded="{{ $isSupplier ? 'true' : 'false' }}"
                                class="dropdown-toggle {{ $isSupplier ? 'active' : '' }}">Supplier </a>
                            <ul class="collapse list-unstyled {{ $isSupplier ? 'show' : '' }}" id="SupplierControllerSubmenu" data-bs-parent="#sidebar-accordion">
                                <li>
                                    <a href="{{ url('/supplier/create') }}">Add Supplier</a>
                                </li>
                                <li>
                                    <a href="{{ url('/supplier/list') }}">Suppliers</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#companySubmenu" data-bs-toggle="collapse" aria-expanded="{{ $isCompany ? 'true' : 'false' }}"
                                class="dropdown-toggle {{ $isCompany ? 'active' : '' }}">Company </a>
                            <ul class="collapse list-unstyled {{ $isCompany ? 'show' : '' }}" id="companySubmenu" data-bs-parent="#sidebar-accordion">
                                <li>
                                    <a href="{{ url('/company/create') }}">Add Company</a>
                                </li>
                                <li>
                                    <a href="{{ url('/company/list') }}">Companies</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#attributesSubmenu" data-bs-toggle="collapse" aria-expanded="{{ $isAttributes ? 'true' : 'false' }}"
                                class="dropdown-toggle {{ $isAttributes ? 'active' : '' }}">Attributes </a>
                            <ul class="collapse list-unstyled {{ $isAttributes ? 'show' : '' }}" id="attributesSubmenu" data-bs-parent="#sidebar-accordion">
                                <li>
                                    <a href="{{ url('/attributes/create') }}">Add Attribute</a>
                                </li>
                                <li>
                                    <a href="{{ url('/attributes/list') }}">Attributes</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#categorySubmenu" data-bs-toggle="collapse" aria-expanded="{{ $isCategory ? 'true' : 'false' }}"
                                class="dropdown-toggle {{ $isCategory ? 'active' : '' }}">Category </a>
                            <ul class="collapse list-unstyled {{ $isCategory ? 'show' : '' }}" id="categorySubmenu" data-bs-parent="#sidebar-accordion">
                                <li>
                                    <a href="{{ url('/category/create') }}">Add Category</a>
                                </li>
                                <li>
                                    <a href="{{ url('/category/list') }}">Categories</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="{{ url('/logout') }}">Logout</a>
                        </li>
                    </ul>
                @endif
                @if (Session::get('loginRole') == 'Assistant')
                    <ul class="list-unstyled components mb-5" id="sidebar-accordion-assistant">
                        <li>
                            <a href="#categorySubmenu" data-bs-toggle="collapse" aria-expanded="{{ $isCategory ? 'true' : 'false' }}"
                                class="dropdown-toggle {{ $isCategory ? 'active' : '' }}">Category </a>
                            <ul class="collapse list-unstyled {{ $isCategory ? 'show' : '' }}" id="categorySubmenu" data-bs-parent="#sidebar-accordion-assistant">
                                <li>
                                    <a href="{{ url('/category/create') }}">Add Category</a>
                                </li>
                                <li>
                                    <a href="{{ url('/category/list') }}">Categories</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('/logout') }}">Logout</a>
                        </li>
                    </ul>
                @endif

            </div>
        </nav>

