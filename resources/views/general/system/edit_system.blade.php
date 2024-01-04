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

                                <a href="/general" class="list-group-item list-group-item-action "><i
                                        class="fa-solid fa-gears fa-lg"></i> <strong>General</strong> </a>
                                <a href="/general/usernames" class="list-group-item list-group-item-action "><i
                                        class="fa-solid fa-users fa-lg"></i> Users </a>
                                <a href="/general/system" class="list-group-item list-group-item-action active"><i
                                        class="fa-solid fa-gear fa-lg"></i>System</a>
                                <a href="/general/profile" class="list-group-item list-group-item-action"><i
                                        class="fa-solid fa-user fa-lg"></i> Profile </a>
                            </div>
                        </div>

                        <div class="col-9">
                            <div class="d-flex bd-highlight mb-3">
                                <h3 class="me-auto p-2 bd-highlight"> Update Your Restaurant Information </h3>
                                <div class="p-2 bd-highlight">
                                    @if(session()->has('status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    @endif
                                </div>
                                <div class="p-2 bd-highlight"><a class="btn btn-success"
                                        href="/general/system" role="button">Your Restauran Information</a></div>
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
                            <form class="form-control" action="/general/system/{{$system->id}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label"> Name</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="{{$system->name}}"
                                        placeholder="Name......"> <br>
                                    <label for="exampleFormControlInput1" class="form-label"> Address</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="address" value="{{$system->address}}"
                                        placeholder="Restaurant Address......"> <br>
                                    <label for="exampleFormControlInput1" class="form-label"> Telephone</label>
                                    <input type="number" class="form-control" id="exampleFormControlInput1" name="telephone" value="{{$system->telephone}}"
                                        placeholder="Enter Your Phone......"> <br>
                                    <button type="submite" class="btn btn-primary"> Set Restaurant</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</script>
@endsection 