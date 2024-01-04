@extends('layouts.app')

@section('content')
<style>
    body {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    }

    img {
        max-width: 70%;
        height: auto;
        margin-left: 100px;
    }

    h3 {
        margin-left: 90px;
        /* Adjust as needed */
    }
    a{
        text-decoratiojn: none;
    }
</style>
<img src="{{ asset('admin_images/404.png') }}" alt="">
<h3>This Page Not Found <a class="text-decoration-none text-warning" href="/">Back To Dashboard</a></h3>
@endsection