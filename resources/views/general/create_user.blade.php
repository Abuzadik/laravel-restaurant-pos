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
                                <a href="/general/usernames" class="list-group-item list-group-item-action active"><i
                                        class="fa-solid fa-users fa-lg"></i> Users </a>
                                <a href="/general/system" class="list-group-item list-group-item-action"><i
                                        class="fa-solid fa-gear fa-lg"></i>System</a>
                                <a href="/general/profile" class="list-group-item list-group-item-action"><i
                                        class="fa-solid fa-user fa-lg"></i> Profile </a>
                            </div>
                        </div>

                        <div class="col-9">
                            <div class="d-flex bd-highlight mb-3">
                                <h3 class="me-auto p-2 bd-highlight"> Create New Usernames </h3>
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
                                        href="/general/usernames" role="button">Users List</a></div>
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
                            <form class="form-control" action="/general/usernames" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label"> Name</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="name"
                                        placeholder="Name......"> <br>
                                    <label for="exampleFormControlInput1" class="form-label"> Email</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="email"
                                        placeholder="Email......"> <br>
                                    <label for="exampleFormControlInput1" class="form-label"> Password</label>
                                    <input type="password" class="form-control" id="exampleFormControlInput1" name="password"
                                        placeholder="password......"> <br>
                                    <label for="exampleFormControlInput1" class="form-label"> Role </label>
                                    <select class="form-select" name="role">
                                        <option selected> Choose User Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select><br>
                                    <button type="submite" class="btn btn-primary"> Add User</button>
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