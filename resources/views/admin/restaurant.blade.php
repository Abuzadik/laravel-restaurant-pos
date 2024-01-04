@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Restaurant Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-12 col-md-3 mb-3">
                            <div class="list-group list-group-light">
                                <a href="/admin/restaurant" class="list-group-item list-group-item-action active"><i class="fa-solid fa-utensils fa-lg"></i> <strong>Restaurant Dashboard</strong></a>
                                <a href="/admin/restaurant/category" class="list-group-item list-group-item-action"><i class="fa-solid fa-bars-staggered fa-lg"></i> Category</a>
                                <a href="/admin/restaurant/foodmenu" class="list-group-item list-group-item-action"><i class="fa-solid fa-bowl-rice fa-lg"></i> Food Menu</a>
                                <a href="/admin/restaurant/table" class="list-group-item list-group-item-action"><i class="fa-solid fa-couch fa-lg"></i> Table No</a>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-9">
                            <div class="d-flex justify-content-center">
                                <a href="/admin/dashboard" > 
                                    <img src="{{asset('/admin_images/restaurant.png')}}" class="img-fluid" alt="Restaurant Image" width="150px">
                                </a>
                            </div>
                            <a href="#" class="link-dark" > 
                                <h2 class="text-center">WELCOME TO ADMIN DASHBOARD</h2> 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
