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

</head>

<body>

    <div id="topHeader"
        style="
        background: #ffffff;
        width: 100%;
        height: 41px;
        z-index: 1;
        border-bottom: 1px solid #e1e1e1;
        position: fixed;
        top: 0;
        box-sizing: border-box;
        box-shadow: 1px 1px 10px #e4e4e4;
        text-align: right;
        padding: 5px 42px;">
        <b>
            <span id="PageName"
                style="margin: 30%;
                       font-size: 15px;
                       color: #6a0cd8;
                       letter-spacing: 1px;">
            </span>
        </b>
        <b><span id="dateShow"></span> &nbsp;
            <span id="timeShow"></span>&nbsp;
            <span id="dayShow"></span>&nbsp;
        </b>
    </div>
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
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
                @if (Session::get('loginRole') == 'Admin' || Session::get('loginRole') == 'Operator')
                <ul class="list-unstyled components mb-5">
                    <li>
                        <a href="#CustomerSubmenu" data-bs-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">Customer </a>
                        <ul class="collapse list-unstyled" id="CustomerSubmenu">
                            <li>
                                <a href="{{ url('/customer/create') }}">Add Customer</a>
                            </li>
                            <li>
                                <a href="{{ url('/customer/list') }}">Customers</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#SupplierControllerSubmenu" data-bs-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">Supplier </a>
                        <ul class="collapse list-unstyled" id="SupplierControllerSubmenu">
                            <li>
                                <a href="{{ url('/supplier/create') }}">Add Supplier</a>
                            </li>
                            <li>
                                <a href="{{ url('/supplier/list') }}">Suppliers</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#companySubmenu" data-bs-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">Company </a>
                        <ul class="collapse list-unstyled" id="companySubmenu">
                            <li>
                                <a href="{{ url('/company/create') }}">Add Company</a>
                            </li>
                            <li>
                                <a href="{{ url('/company/list') }}">Companies</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#attributesSubmenu" data-bs-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">Attributes </a>
                        <ul class="collapse list-unstyled" id="attributesSubmenu">
                            <li>
                                <a href="{{ url('/attributes/create') }}">Add Attribute</a>
                            </li>
                            <li>
                                <a href="{{ url('/attributes/list') }}">Attributes</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ url('/logout') }}">Logout</a>
                    </li>
                </ul>
                @endif
                @if (Session::get('loginRole') == 'Assistant')
                <ul class="list-unstyled components mb-5">
                    <li>
                        <a href="#categorySubmenu" data-bs-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">Category </a>
                        <ul class="collapse list-unstyled" id="categorySubmenu">
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

        <script>
            function updateTime() {
                const now = new Date();

                // Get date components
                const year = now.getFullYear();
                const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-indexed
                const day = String(now.getDate()).padStart(2, '0');

                // Get time components and convert to 12-hour format
                let hours = now.getHours();
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');
                const ampm = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12 || 12; // Convert 0 to 12 for 12 AM/PM hour format
                const timeString = `${hours}:${minutes}:${seconds} ${ampm}`;

                // Get the day of the week
                const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                const dayOfWeek = daysOfWeek[now.getDay()];

                // Format the date and day
                const dateString = `${day}-${month}-${year}`;
                const dayString = `${dayOfWeek}`;

                // Display the formatted date, time, and day
                document.getElementById('dateShow').textContent = dateString;
                document.getElementById('timeShow').textContent = timeString;
                document.getElementById('dayShow').textContent = dayString;
            }

            // Update the time immediately and set an interval to update every second
            updateTime();
            setInterval(updateTime, 1000);
        </script>