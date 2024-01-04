<!-- resources/views/datatable.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Datatable Example</h1>
        <table id="dataTab" class="table table-striped">
            <thead>
                <tr>
                    <th  id="data">ID</th>
                    <th  id="data">Name</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function () {
            $('#dataTab').DataTable({
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    // Add more columns as needed
                ],
            });
        });
    </script>
@endsection
