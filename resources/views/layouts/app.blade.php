<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
   

    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Include Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Include DataTables Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <!-- Include DataTables Date Range Filter CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css">

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- Include DataTables Buttons JavaScript -->
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>

    <!-- Include DataTables Date Range Filter JavaScript -->
    <script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>

    <!-- Your custom styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Your custom scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Additional custom styles -->
    <style>
        /* Add your additional styles here */
    </style>




<!-- Your custom styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<!-- Your custom scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>




    <style>
        /* Change the background and text color of the pagination buttons */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background-color: #192655;
            /* Change to your preferred color */
            color: #fff;
            /* Change to your preferred text color */
            border: 1px solid #192655;
            /* Change to your preferred border color */
            cursor: pointer;
            padding: 10px;
        }

        /* Change the background and text color of the active page button */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #0766AD;
            /* Change to your preferred color */
            color: #fff;
            /* Change to your preferred text color */
            border: 1px solid #fff;
            /* Change to your preferred border color */
            cursor: pointer;

        }

        /* Change the hover styles of the pagination buttons */
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #B0A695;
            /* Change to your preferred hover color */
            color: #fff;
            /* Change to your preferred text color on hover */
            border: 1px solid #B0A695;
            /* Change to your preferred border color on hover */
            cursor: pointer;

        }

        .dataTables_wrapper thead th {
            background-color: #192655;
            /* Change to your preferred color */
            color: #fff;
            /* Change to your preferred text color */
            border: 1px solid #192655;
            /* Change to your preferred border color */
        }

        /* Change the hover styles of the header cells */
        .dataTables_wrapper thead th:hover {
            background-color: #3876BF;
            /* Change to your preferred hover color */
            color: #fff;
            /* Change to your preferred text color on hover */
            border: 1px solid #3876BF;
            /* Change to your preferred border color on hover */
        }
    </style>
<style>
    /* Change the background and text color of the entire footer */
    .dataTables_wrapper tfoot {
        background-color: #192655;
        /* Change to your preferred color */
        color: #fff;
        /* Change to your preferred text color */
        border: 1px solid #192655;
        /* Change to your preferred border color */
    }

    /* Change the hover styles of the footer cells */
    .dataTables_wrapper tfoot:hover {
        background-color: #3876BF;
        /* Change to your preferred hover color */
        color: #fff;
        /* Change to your preferred text color on hover */
        border: 1px solid #3876BF;
        /* Change to your preferred border color on hover */
    }

    /* Change the background and text color of the pagination buttons in the footer */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        background-color: #192655;
        /* Change to your preferred color */
        color: #fff;
        /* Change to your preferred text color */
        border: 1px solid #192655;
        /* Change to your preferred border color */
        cursor: pointer;
        padding: 10px;
    }

    /* Change the background and text color of the active page button in the footer */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #0766AD;
        /* Change to your preferred color */
        color: #fff;
        /* Change to your preferred text color */
        border: 1px solid #fff;
        /* Change to your preferred border color */
        cursor: pointer;
    }

    /* Change the hover styles of the pagination buttons in the footer */
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #B0A695;
        /* Change to your preferred hover color */
        color: #fff;
        /* Change to your preferred text color on hover */
        border: 1px solid #B0A695;
        /* Change to your preferred border color on hover */
        cursor: pointer;
    }
</style>
<style>
    /* Add this to your CSS file */
.chatgpt-login {
    background-color: #f8f9fa; /* Light gray background */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.chatgpt-login .card-header {
    background-color: #007bff; /* Blue header background */
    color: #fff; /* White header text color */
    border-radius: 5px 5px 0 0;
}

.chatgpt-login button {
    background-color: #007bff; /* Blue button background */
    border-color: #007bff; /* Blue button border color */
    color: #fff; /* White button text color */
}

.chatgpt-login button:hover {
    background-color: #0056b3; /* Darker blue on hover */
    border-color: #0056b3;
}

.chatgpt-login a {
    color: #007bff; /* Blue link color */
}

</style>

    <style>
        .menu-item {
            height: 90%;
            display: flex;
            flex-direction: column;
            /* justify-content: space-between; */
            align-items: center;
        }

        .menu-item-image {
            max-height: 60px;
            /* Reduced max-height for the menu item image */
            width: auto;
        }

        .menu-item-name {
            font-size: 18px;
            /* Reduced font size for the menu item name */
        }

        .quantity-input {
            width: 5px;
            /* Reduced width for the quantity input */
        }

        .btn-menu {
            font-size: 12px;
            /* Reduced font size for the order button */
        }
    </style>


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="bg-dark text-white">
@if(Auth::check())
   

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-lg">
            <div class="container">
                <a class="navbar-brand display-2 d-flex align-items-center" href="{{ url('/home') }}">
                    <img style="width: 50px; height: auto;" src="{{ asset('logos.png')}}" />
                    <h1 class="mb-0 ms-2 FW-B text-decoration-underline">Dashboard</h1>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                            <a class="dropdown-item" href="/general/profile">
                                                     <i class="fa-regular fa-user"></i>
                                    {{ __('Profile') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="fa-solid fa-right-from-bracket"></i>
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
        @endif

        <main class="py-4 bg-dark text-white">
            @yield('content')
        </main>
    </div>
</body>

</html>