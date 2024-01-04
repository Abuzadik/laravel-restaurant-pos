@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Manage Tables') }}</div>

                <div class="card-body">
                    <!-- sidebar links start here  -->
                    <div class="row">
                        <div class="col-3">
                            <div class="list-group">
                            <a href="/admin/restaurant" class="list-group-item list-group-item-action "><i class="fa-solid fa-arrow-left-long  fa-lg"></i> Restaurant Dashboard</a>
                                <a href="/admin/restaurant/category" class="list-group-item list-group-item-action "> <i class="fa-solid fa-bars-staggered fa-lg"></i> Category</a>
                                <a href="/admin/restaurant/foodmenu" class="list-group-item list-group-item-action"><i class="fa-solid fa-bowl-rice fa-lg"></i> Food Menu</a>
                                <a href="/admin/restaurant/table" class="list-group-item list-group-item-action active"><strong> <i class="fa-solid fa-couch fa-lg"></i> Table No </strong></a>
                                <!-- <a href="#" class="list-group-item list-group-item-action disabled"><i class="fa-solid fa-users fa-lg"></i> Admin / User </a> -->
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="d-flex bd-highlight mb-3">
                                <h3 class="me-auto p-2 bd-highlight"> Manage Seat Table </h3> 
                                <div class="p-2 bd-highlight">
                                    @if(session()->has('status'))                                    
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('status') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif                                            
                                </div>
                                <div class="p-2 bd-highlight"><a class="btn btn-success" href="/admin/restaurant/table/create" role="button">Add new Table</a></div>
                            </div>
                            <hr>
                            <div class="col-12"> 
                                <table id="dataTab" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th id="data">ID</th>
                                            <th id="data">Name</th>
                                            <th id="data">Status</th>
                                            <th id="edit">Edit</th>
                                            <th id="delete">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tables as $table)
                                            <tr>
                                                <td>{{$table->id}}</td>
                                                <td>{{$table->name}}</td>
                                                <td>{{$table->status}}</td>
                                                <td>
                                                    <a class="btn btn-warning" href="/admin/restaurant/table/{{$table->id}}/edit" role="button">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$table->id}}">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{$table->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{$table->id}}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel{{$table->id}}">Confirm Deletion</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this table?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <form action="/admin/restaurant/table/{{$table->id}}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
</div>

<!-- Include jQuery, Bootstrap, and DataTables library scripts -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script>
        $(document).ready(function () {
            $('#dataTab').DataTable({
                pageLength : 7,
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'status', name: 'status' },
                    { data: 'edit', name: 'edit' },
                    { data: 'delete', name: 'delete' },
                    // Add more columns as needed
                ],
            });
        });
</script>
@endsection
