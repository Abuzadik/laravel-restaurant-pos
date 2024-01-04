@extends('layouts.app')

@section('content')
<div class="m-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Manage Category') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-2">
                            <div class="list-group">
                            <a href="/exp/status" class="list-group-item list-group-item-action"><i class="fa-solid fa-list fa-lg"></i> Stats</a>
                            <a href="/expenses" class="list-group-item list-group-item-action active"><strong> <i class="fa-solid fa-coins fa-lg"></i> Expenses</strong></a>
                            <a href="/exp/daterange" class="list-group-item list-group-item-action "><strong> <i class="fa-solid fa-calendar fa-lg"></i> Expenses Date Range</strong></a>

                            </div>
                        </div>
                        <div class="col-10">
                            <div class="d-flex bd-highlight mb-3"> 
                                <h3 class="me-auto p-2 bd-highlight" > Create Expense </h3>
                                <div class="p-2 bd-highlight"><a class="btn btn-success" href="/expenses" role="button"> Expense List </a></div>
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
                            <form class="form-control" action="/expenses" method="POST">
                            @csrf
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Expense Type</label>
                                     <input type="text" class="form-control" id="exampleFormControlInput1" name="expense_type" placeholder="Expense Type......"><br>
                                     <label for="exampleFormControlInput1" class="form-label">Expense Type</label>
                                     <input type="number" class="form-control" id="exampleFormControlInput1" name="amount" placeholder="Expense Amount......"><br>
                                    <label for="exampleFormControlInput1" class="form-label">Expense Detail</label>
                                     <textarea class="form-control" id="exampleFormControlInput1" name="detail" placeholder="Expense Detail......"> </textarea> <br>
                                     <button type="submite" class="btn btn-primary"> Add Expense </button>
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
