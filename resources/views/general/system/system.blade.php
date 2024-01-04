@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">{{ __('General Setting Dashboard') }}</div>

                <div class="card-body">
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
                                <h3 class="me-auto p-2 bd-highlight"> Set Your Restaurant Information </h3>
                                <div class="p-2 bd-highlight">
                                    @if(session()->has('status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    @endif
                                </div>
                                <div class="p-2 bd-highlight">
                                    <!-- <a class="btn btn-success" href="/general/system/create" role="button">Set</a> -->
                                </div>
                            </div>
                            <hr>
                            <table id="dataTab" class="table table-striped">
                            <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Edit</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($systems as $system)
                                    <tr>
                                        <td>{{$system->id}}</td>
                                        <td>{{$system->name}}</td>
                                        <td>{{$system->address}}</td>
                                        <td>{{$system->telephone}}</td>
                                        <td><a class="btn btn-warning"
                                                href="/general/system/{{$system->id}}/edit" role="button">
                                                <i class="fa-regular fa-pen-to-square"></i></a>
                                        </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $('#dataTab').DataTable({
            pageLength: 7,
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'address', name: 'address' },
                { data: 'tell', name: 'tell' },
                { data: 'edit', name: 'edit' },
                // { data: 'delete', name: 'delete' },
                // Add more columns as needed
            ],
        });
    });
</script>
@endsection