<!DOCTYPE html>
<html>

<head>
    <title>Expenses Date Range</title>
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
    <div class="m-5 ">
        <div class="card p-4">
            <div class="row">
                <div class="col-2">
                    <div class="list-group">
                        <a href="/exp/status" class="list-group-item list-group-item-action"><i
                                class="fa-solid fa-list fa-lg"></i> Stats</a>
                        <a href="/expenses" class="list-group-item list-group-item-action "><strong> <i
                                    class="fa-solid fa-coins fa-lg"></i> Expenses</strong></a>
                        <a href="/exp/daterange" class="list-group-item list-group-item-action active"><strong> <i
                                    class="fa-solid fa-calendar fa-lg"></i> Expenses Date Range</strong></a>
                    </div>
                </div>
                <div class="col-10">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col col-9">
                                    <h3>Date Range Table</h3>
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
                                        <th>expense</th>
                                        <th>amount</th>
                                        <th>detail</th>
                                        <th>date</th>
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

            table.draw();
        });

        var table = $('#daterange_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('expense.daterange') }}",
                data: function (data) {
                    data.from_date = $('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    data.to_date = $('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD');
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'expense_type', name: 'expense_type' },
                { data: 'amount', name: 'amount' },
                { data: 'detail', name: 'detail' },
                { data: 'created_at', name: 'created_at' }
            ],
            dom: 'lBfrtip', // Add 'B' to enable buttons
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', // predefined buttons
           
        ]
        });

    });
</script>

</html>