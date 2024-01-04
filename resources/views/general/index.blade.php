@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">{{ __('General Setting Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-3">
                            <div class="list-group list-group-light">
                               
                                <a href="/general" class="list-group-item list-group-item-action active"><i class="fa-solid fa-gears fa-lg"></i> <strong>General</strong> </a>
                                <a href="/general/usernames" class="list-group-item list-group-item-action"><i class="fa-solid fa-users fa-lg"></i> Users </a>
                                <a href="/general/system" class="list-group-item list-group-item-action"><i class="fa-solid fa-gear fa-lg"></i>System</a>
                                <a href="/general/profile" class="list-group-item list-group-item-action"><i class="fa-solid fa-user fa-lg"></i> Profile </a>
                            </div>
                        </div>
                        
                            <div class="col-9">
                            <div class="d-flex justify-content-center"><br>
                                <a href="#" > 
                                    <img src="{{asset('/admin_images/generals.png')}}" width="150px" height="auto" >
                                </a>
                            </div>
                            <a href="#" class="link-dark" > 
                                <h2 class="text-center">WELCOME TO GENERAL SETTINGS</h2> 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
