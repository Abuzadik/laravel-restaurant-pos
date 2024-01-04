@extends('layouts.app')

@section('content')
<div class="m-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Manage Expenses') }}</div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-2">
                            <div class="list-group">
                                <!-- <a href="/admin/restaurant" class="list-group-item list-group-item-action "><i class="fa-solid fa-arrow-left-long  fa-lg"></i> Restaurant Dashboard</a> -->
                                <a href="/exp/status" class="list-group-item list-group-item-action"><i
                                        class="fa-solid fa-list fa-lg"></i> Stats</a>
                                <a href="/expenses" class="list-group-item list-group-item-action active"><strong> <i
                                            class="fa-solid fa-coins fa-lg"></i> Expenses</strong></a>
                                <a href="/exp/daterange" class="list-group-item list-group-item-action "><strong> <i
                                            class="fa-solid fa-calendar fa-lg"></i> Expenses Date Range</strong></a>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="d-flex bd-highlight mb-3">
                                <h3 class="me-auto p-2 bd-highlight"> Manage Expenses </h3>
                                <div class="p-2 bd-highlight">
                                    @if(session()->has('status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    @endif
                                </div>
                                <div class="p-2 bd-highlight"><a class="btn btn-success" href="/expenses/create"
                                        role="button">Add Expenses</a></div>
                            </div>
                            <hr>
                            <div class=" col-12">
                                <!-- // new table -->
                                <table id="dataTab" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th id="data">ID</th>
                                            <th id="data">Expenses Type</th>
                                            <th id="data">Amount</th>
                                            <th id="data">More Detail</th>
                                            <th id="data">Date</th>
                                            <th id="edit">edit</th>
                                            <th id="delete">delete</th>
                                            <!-- Add more columns as needed -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($expenses as $expense)
                                        <tr>
                                            <td>{{$expense->id}}</td>
                                            <td>{{$expense->expense_type}}</td>
                                            <td>{{$expense->amount}}</td>
                                            <td>{{$expense->detail}}</td>
                                            <td>{{$expense->created_at}}</td>

                                            <td> <a class="btn btn-warning" href="/expenses/{{$expense->id}}/edit"
                                                    role="button">
                                                    <i class="fa-regular fa-pen-to-square"></i></a>
                                            </td>
                                            <td>
                                            <form action="/expenses/{{ $expense->id }}" method="post" id="deleteForm{{ $expense->id }}">
                                            @csrf
                                            @method('DELETE')
                                                <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#deleteModal{{ $expense->id }}">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                                </form>
                                            </td>                                            
                                        </tr>
                                        <div class="modal fade" id="deleteModal{{ $expense->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $expense->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $expense->id }}">Confirm Deletion</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this expense?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-danger" onclick="document.getElementById('deleteForm{{ $expense->id }}').submit()">Delete</button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="table-success">
                                        <tr>
                                            <td colspan="2"><strong>TOTAL</strong>:</td>
                                            <!-- <td>:</td> -->
                                            <td><STrong>{{ number_format($expenses->sum('amount'), 2) }}</STrong></td>
                                            <td colspan="4"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $('#dataTab').DataTable({
            pageLength: 7,
            columns: [
                { data: 'id', name: 'id' },
                { data: 'type', name: 'type' },
                { data: 'detail', name: 'detail' },
                { data: 'amount', name: 'amount' },
                { data: 'date', name: 'date' },
                { data: 'edit', name: 'edit' },
                { data: 'delete', name: 'delete' },
                // Add more columns as needed
            ],
        });
        
    });
</script>
@endsection