@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">{{ __('Manage Category') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-3">
                            <div class="list-group">
                                <a href="/admin/restaurant/category" class="list-group-item list-group-item-action "> <i class="fa-solid fa-arrow-left-long fa-lg"></i> Restaurant Dashboard</a>
                                <a href="/admin/restaurant/category" class="list-group-item list-group-item-action active"> <i class="fa-solid fa-bars-staggered fa-lg"></i> <strong> Category </strong></a>
                                <a href="/admin/restaurant/foodmenu" class="list-group-item list-group-item-action"><i class="fa-solid fa-bowl-rice fa-lg"></i> Food Menu</a>
                                <a href="#" class="list-group-item list-group-item-action"><i class="fa-solid fa-couch fa-lg"></i> Table No</a>
                                <!-- <a href="#" class="list-group-item list-group-item-action disabled"><i class="fa-solid fa-users fa-lg"></i> Admin / User </a> -->
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="d-flex bd-highlight mb-3"> 
                                <h3 class="me-auto p-2 bd-highlight" > Edit Category </h3>
                                <div class="p-2 bd-highlight"><a class="btn btn-success" href="/admin/restaurant/category" role="button"> Category List </a></div>
                            </div>
                           <hr>

                            @if($errors->any())
                            <div class="alert alert-danger">
                                    <ul>
                                            @foreach($errors->all() as $error)
                                                <li> {{$error}}</li>
                                           @endforeach
                                           
                                    </ul>
                                </div>
                                     
                            @endif
                            <form class="form-control" action="/admin/restaurant/category/{{$category->id}}" method="POST">
                            @csrf
                            @method('PUT')
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                                     <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="{{$category->name}}" placeholder="Category......"> <br>
                                     <button type="submite" class="btn btn-primary"> Edit Catgeory </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
