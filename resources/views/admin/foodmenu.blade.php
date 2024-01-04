@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">{{ __('Manage Food Menu') }}</div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-3">
                            <div class="list-group">
                                <a href="/admin/restaurant" class="list-group-item list-group-item-action "><i
                                        class="fa-solid fa-arrow-left-long  fa-lg"></i> Restaurant Dashboard</a>
                                <a href="/admin/restaurant/category" class="list-group-item list-group-item-action "><i
                                        class="fa-solid fa-bars-staggered fa-lg"></i> Category</a>
                                <a href="/admin/restaurant/foodmenu"
                                    class="list-group-item list-group-item-action active"> <strong> <i
                                            class="fa-solid fa-bowl-rice fa-lg"></i> Food Menu </strong></a>
                                <a href="/admin/restaurant/table" class="list-group-item list-group-item-action"><i
                                        class="fa-solid fa-couch fa-lg"></i> Table No</a>
                                <!-- <a href="#" class="list-group-item list-group-item-action disabled"><i
                                        class="fa-solid fa-users fa-lg"></i> Admin / User </a> -->
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="d-flex bd-highlight mb-3">
                                <h3 class="me-auto p-2 bd-highlight"> Manage Food Menu </h3>
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
                                        href="/admin/restaurant/foodmenu/create" role="button">Add Menu</a></div>
                            </div>
                            <hr>
                            <div class="col-12">
                                <table id="dataTab" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th id="data">ID</th>
                                            <th id="data">Name</th>
                                            <th id="data">Image</th>
                                            <th id="data">Detail</th>
                                            <th id="data">Price</th>
                                            <th id="edit">Category</th>
                                            <th id="edit">Edit</th>
                                            <th id="delete">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($foodmenus as $menu)
                                        <tr>
                                            <td>{{$menu->id}}</td>
                                            <td>{{$menu->name}}</td>
                                            <td><img src="{{asset('menu_images')}}/{{$menu->image}}" width="60px"
                                                    height="auto" class="img-thumbnail" /></td>
                                            <td>{{$menu->detail}}</td>
                                            <td>SLSH - {{$menu->price}}</td>
                                            <td>{{$menu->category->name}}</td>
                                            <td>
                                                <a class="btn btn-warning"
                                                    href="/admin/restaurant/foodmenu/{{$menu->id}}/edit" role="button">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger" data-toggle="modal"
                                                    data-target="#deleteModal{{$menu->id}}">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{$menu->id}}" tabindex="-1"
                                            role="dialog" aria-labelledby="deleteModalLabel{{$menu->id}}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{$menu->id}}">
                                                            Confirm Deletion</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this menu?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancel</button>
                                                        <form action="/admin/restaurant/foodmenu/{{$menu->id}}"
                                                            method="post">
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
            pageLength: 6,
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'iamge', name: 'image' },
                { data: 'detail', name: 'detail' },
                { data: 'price', name: 'price' },
                { data: 'category', name: 'category' },
                { data: 'edit', name: 'edit' },
                { data: 'delete', name: 'delete' },
                // Add more columns as needed
            ],
        });
    });
    $(document).ready(function () {
        $("#dataTab tr").css('cursor', 'pointer');
    });
</script>
@endsection