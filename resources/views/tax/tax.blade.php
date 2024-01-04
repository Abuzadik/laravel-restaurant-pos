<!DOCTYPE html>
<html>

<head>
    <title>Tax Date Range</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

    <!-- JSZip library (required for Excel export) -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <!-- DataTables Buttons JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
</head>

<style>
    h2,
    h5,
    .h2,
    .h5 {
        font-family: inherit;
        font-weight: 600;
        line-height: 1.5;
        margin-bottom: .5rem;
        color: #32325d;
    }

    h5,
    .h5 {
        font-size: .8125rem;
    }

    @media (min-width: 992px) {

        .col-lg-6 {
            max-width: 50%;
            flex: 0 0 50%;
        }
    }

    @media (min-width: 1200px) {

        .col-xl-3 {
            max-width: 25%;
            flex: 0 0 25%;
        }

        .col-xl-6 {
            max-width: 50%;
            flex: 0 0 50%;
        }
    }


    .bg-danger {
        background-color: #f5365c !important;
    }



    @media (min-width: 1200px) {

        .justify-content-xl-between {
            justify-content: space-between !important;
        }
    }


    .pt-5 {
        padding-top: 3rem !important;
    }

    .pb-8 {
        padding-bottom: 8rem !important;
    }

    @media (min-width: 768px) {

        .pt-md-8 {
            padding-top: 8rem !important;
        }
    }

    @media (min-width: 1200px) {

        .mb-xl-0 {
            margin-bottom: 0 !important;
        }
    }




    .font-weight-bold {
        font-weight: 600 !important;
    }


    a.text-success:hover,
    a.text-success:focus {
        color: #24a46d !important;
    }

    .text-warning {
        color: #fb6340 !important;
    }

    a.text-warning:hover,
    a.text-warning:focus {
        color: #fa3a0e !important;
    }

    .text-danger {
        color: #f5365c !important;
    }

    a.text-danger:hover,
    a.text-danger:focus {
        color: #ec0c38 !important;
    }

    .text-white {
        color: #fff !important;
    }

    a.text-white:hover,
    a.text-white:focus {
        color: #e6e6e6 !important;
    }

    .text-muted {
        color: #8898aa !important;
    }

    @media print {

        *,
        *::before,
        *::after {
            box-shadow: none !important;
            text-shadow: none !important;
        }

        a:not(.btn) {
            text-decoration: underline;
        }

        p,
        h2 {
            orphans: 3;
            widows: 3;
        }

        h2 {
            page-break-after: avoid;
        }

        @ page {
            size: a3;
        }

        body {
            min-width: 992px !important;
        }
    }

    figcaption,
    main {
        display: block;
    }

    main {
        overflow: hidden;
    }

    .bg-yellow {
        background-color: #ffd600 !important;
    }

    .icon {
        width: 3rem;
        height: 3rem;
    }

    .icon i {
        font-size: 2.25rem;
    }

    .icon-shape {
        display: inline-flex;
        padding: 12px;
        text-align: center;
        border-radius: 50%;
        align-items: center;
        justify-content: center;
    }
</style>
<body class="bg-dark">
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-lg">
        <div class="container">
            <a class="navbar-brand display-2 d-flex align-items-center" href="{{ url('/home') }}">
                <img style="width: 50px; height: auto;" src="{{ asset('logos.png')}}" />
                <h1 class="mb-0 ms-2 FW-B text-decoration-underline">Dashboard</h1>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>    

<div class="m-5 p-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Report') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                        <div class="list-group">
                            <!-- <a href="/admin/restaurant" class="list-group-item list-group-item-action "><i class="fa-solid fa-arrow-left-long  fa-lg"></i> Restaurant Dashboard</a> -->
                            <a href="/tax" class="list-group-item list-group-item-action "><i class="fa-solid fa-receipt fa-lg"></i> Tax Status</a>
                                <a href="/tax/daterange" class="list-group-item list-group-item-action active "><strong> <i class="fa-solid fa-calendar fa-lg"></i> Tax Date Range</strong></a>
                                <a href="/exp/daterange" class="list-group-item list-group-item-action "><strong> <i class="fa-solid fa-coins fa-lg"></i> ###</strong></a>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="d-flex bd-highlight mb-3">
                                <h3 class="me-auto p-2 bd-highlight "> Sales Tax Date Range</h3>
                            </div>
                            <hr>
                            <div class=" col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col col-9">
                                                <h4>Tax Date Range Table</h>
                                            </div>
                                            <div class="col col-3">
                                                <div id="daterange" class="float-end"
                                                    style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%; text-align:center">
                                                    <i class="fa fa-calendar"></i>&nbsp;
                                                    <span></span>
                                                    <i class="fa fa-caret-down"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered" id="daterange_table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Total Price</th>
                                                    <th> Tax Rate</th>
                                                    <th> Sale Tax</th>
                                                    <th>Created On</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</body>
<script type="text/javascript">

    $(function () {

        var start_date = moment();
        var end_date = moment();

        $('#daterange span').html(start_date.format('MMMM D, YYYY') + ' - ' + end_date.format('MMMM D, YYYY'));

        $('#daterange').daterangepicker({
            startDate: start_date,
            endDate: end_date
        }, function (start_date, end_date) {
            $('#daterange span').html(start_date.format('MMMM D, YYYY') + ' - ' + end_date.format('MMMM D, YYYY'));

            // Call DataTables draw() method after changing the date range
            table.draw();
        });

        // Initialize DataTables and store the instance in a variable
        var table = $('#daterange_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('tax.daterange') }}",
                data: function (data) {
                    data.from_date = $('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    data.to_date = $('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD');
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                {
                    data: 'total_price',
                    name: 'total_price',
                    render: function (data, type, full) {
                        // Format total_price as a number with commas
                        return parseFloat(data).toLocaleString(undefined, { maximumFractionDigits: 2 });
                    }
                },
                {
                    data: 'tax_rate',
                    name: 'tax_rate',
                    render: function (data, type, full) {
                        // Convert tax rate from decimal to percentage
                        var percentage = (parseFloat(data) * 100).toFixed();
                        return percentage + '%';
                    }
                }, {
                    data: null,
                    render: function (data, type, full) {
                        // Calculate tax amount for each row and display in a new column
                        var taxRate = parseFloat(full.tax_rate);
                        var totalPrice = parseFloat(full.total_price);
                        var taxAmount = (totalPrice * taxRate).toFixed(2);
                        return 'SLSH' + taxAmount; // You can adjust the format as needed
                    }
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    render: function (data, type, full) {
                        // Format the 'created_at' column to show only YYYY-MM-DD
                        return moment(data).format('YYYY-MM-DD');
                    }
                },

            ]
        });

    });

</script>

</html>