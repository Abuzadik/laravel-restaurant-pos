@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Manage Food Menu') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-3">
                            <div class="list-group">
                            <a href="/admin/restaurant" class="list-group-item list-group-item-action "><i class="fa-solid fa-arrow-left-long  fa-lg"></i> <strong> Restaurant Dashboard </strong></a>
                                <a href="/admin/restaurant/category" class="list-group-item list-group-item-action"><strong> <i class="fa-solid fa-bars-staggered fa-lg"></i> Category List</strong></a>
                                <a href="/admin/restaurant/foodmenu" class="list-group-item list-group-item-action active"><i class="fa-solid fa-bowl-rice fa-lg"></i> <strong> Food Menu </strong></a>
                                <a href="#" class="list-group-item list-group-item-action"><i class="fa-solid fa-couch fa-lg"></i> Table No</a>
                                <!-- <a href="#" class="list-group-item list-group-item-action disabled"><i class="fa-solid fa-users fa-lg"></i> Admin / User </a> -->
                            </div>
                        </div>
                        <div class="col-9">
                        <div class="d-flex bd-highlight mb-3"> 
                                <h3 class="me-auto p-2 bd-highlight" > Create Food Menu </h3>
                                <div class="p-2 bd-highlight"><a class="btn btn-success" href="/admin/restaurant/foodmenu" role="button"> Food Menu List </a></div>
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
                            <form class="form-control" action="/admin/restaurant/foodmenu" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Menu Name</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="Enter The Menu Name......"> <br>
                                    <label for="formFileDisabled" class="form-label">Menu Image</label>
                                    <input class="form-control" type="file" name="image" /> <br>
                                    <label for="exampleFormControlInput1" class="form-label">Detial </label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="detail" placeholder="Enter theDetail......"> <br>
                                    <label for="exampleFormControlInput1" class="form-label">Price</label>
                                    <input type="number" step="any" class="form-control" id="exampleFormControlInput1" name="price" placeholder=" Enter the Price......"> <br>
                                    <label for="exampleFormControlInput1" class="form-label">Select Category</label>
                                    <select class="form-select" name="category_id">
                                    <option selected>Select The Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select><br>
                                    <button type="submite" class="btn btn-primary"> Add Menu </button><br><br><br> <br>
                                </div><br><br><br> <br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
