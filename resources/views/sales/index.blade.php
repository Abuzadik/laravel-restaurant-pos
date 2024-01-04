<!-- resources/views/admin/restaurant/category/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="m-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Report') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                        <div class="list-group">
                                <a href="/sales/status" class="list-group-item list-group-item-action  "><strong> <i
                                            class="fa-solid fa-chart-pie fa-lg"></i> Stats</strong></a>
                                <a href="/sales" class="list-group-item list-group-item-action active" ><strong> <i
                                            class="fa-solid fa-bars-staggered fa-lg"></i> Today</strong></a>
                                <a href="/sales/allSales" class="list-group-item list-group-item-action "><strong> <i
                                            class="fa-solid fa-list fa-lg"></i> All Sales</strong></a>
                                
                                <a href="/sales/DateRange" class="list-group-item list-group-item-action"><i
                                        class="fa-solid fa-calendar fa-lg"></i> Date Range </a>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="d-flex bd-highlight mb-3">
                                <h3 class="me-auto p-2 bd-highlight"> TODAY SALES REPORT </h3>
                                <div class="p-2 bd-highlight">
                                    @if(session()->has('status'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('status') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                          
                            <div class=" col-12">
                                <table id="dataTab" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th id="data">ID</th>
                                            <th id="data">Table Name</th>
                                            <th id="user">User Name</th>
                                            <th id="menuname">Menu Name</th>
                                            <th id="menuname">Item Price </th>
                                            <th id="menuname">Quantity</th>
                                            <th id="menuP">price</th>
                                            <th id="TP">Total Price + Tax</th>
                                            <th id="TT">Total Tax</th>
                                            <th id="status">Status</th>
                                            <!-- Add more columns as needed -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sales as $sale)
                                            <tr>
                                                <td>{{$sale->id}}</td>
                                                <td>{{$sale->table_name}}</td>
                                                <td>{{$sale->user_name}}</td>
                                                <td>
                                                    @if ($sale->saleDetils)
                                                        @foreach($sale->saleDetils as $saleDetail)
                                                            {{$saleDetail->menu_name}}<br>
                                                        @endforeach
                                                    @else
                                                        No Sale Details
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($sale->saleDetils)
                                                        @foreach($sale->saleDetils as $saleDetail)
                                                            {{$saleDetail->menu_price}}<br>
                                                        @endforeach
                                                    @else
                                                        No Sale Details
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($sale->saleDetils)
                                                        @foreach($sale->saleDetils as $saleDetail)
                                                            {{$saleDetail->quantity}}<br>
                                                        @endforeach
                                                    @else
                                                        No Sale Details
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($sale->saleDetils)
                                                        @foreach($sale->saleDetils as $saleDetail)
                                                            {{$saleDetail->menu_price * $saleDetail->quantity}}<br>
                                                        @endforeach
                                                    @else
                                                        No Sale Details
                                                    @endif
                                                </td>
                                                <td>{{$sale->total_price }}</td>
                                                <td>{{ number_format($sale->total_price * 0.05, 2) }}</td>
                                                <td>{{$sale->sale_status}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot><hr>
                                        <tr class="table-success">
                                            <td  colspan="6"><strong>All Today Sales Total</strong></td>
                                            <td>
                                                <strong> Total Menu Price <br>
                                              @php
                                                $totalMenuPrice = 0;
                                                foreach ($sales as $sale) {
                                                    if ($sale->saleDetils) {
                                                        foreach ($sale->saleDetils as $saleDetail) {
                                                            // Multiply menu price by quantity
                                                            $totalMenuPrice += $saleDetail->menu_price * $saleDetail->quantity;
                                                        }
                                                    }
                                                }
                                                echo number_format($totalMenuPrice, 2);
                                            @endphp

                                                </strong>
                                            </td>
                                            <td>
                                                <strong>
                                                 Total inc Tax <br>
                                                @php
                                                    $totalPrice = 0;
                                                    foreach($sales as $sale) {
                                                        $totalPrice += $sale->total_price;
                                                    }
                                                    echo number_format($totalPrice, 2);
                                                @endphp
                                                </strong>
                                            </td>
                                            <td> 
                                                <strong>
                                                Total Tax<br>
                                                @php
                                                    $totalTax = 0;
                                                    foreach($sales as $sale) {
                                                        $totalTax += $sale->total_price * 0.05;
                                                    }
                                                    echo number_format($totalTax, 2);
                                                @endphp
                                                </strong>
                                                
                                            </td>
                                            <td></td>
                                            <!-- You can add a total for "Sale Status" if needed -->
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

<script>
    $(document).ready(function () {
        $('#dataTab').DataTable({
            pageLength: 6,
            columns: [
                { data: 'id', name: 'id' },
                { data: 'table_name', name: 'table_name' },
                { data: 'user_name', name: 'user_name' },
                { data: 'menu_name', name: 'menu_name' },
                { data: 'quantity', name: 'quantity' },
                { data: 'price', name: 'price' },
                { data: 'menu_price', name: 'menu_price' },
                { data: 'total_price', name: 'total_price' },
                { data: 'total_tax', name: 'total_tax' },
                { data: 'sale_status', name: 'sale_status' },
                // Add more columns as needed
            ],
        });
    });
</script>
@endsection
