@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header text-center">
                <h4> WELCOME ADMIN DASHBOARD </h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-around">
                    <!-- Restaurant Section Icon -->
                    <div class="col-md-2 col-6 mb-3">
                        <a href="/admin/restaurant" class="text-decoration-none text-dark d-block text-center">
                            <img src="{{ asset('admin_images/cooking.png') }}" class="img-fluid" alt="Setup"  width="100px " height="auto" > 
                            <h4 class="mt-2"> Setup </h4>
                        </a>
                    </div>

                    <!-- POS Section Icon -->
                    <div class="col-md-2 col-6 mb-3">
                        <a href="/pos" class="text-decoration-none text-dark d-block text-center">
                            <img src="{{ asset('admin_images/pos.png') }}" class="img-fluid" alt="Open POS"  width="100px " height="auto" >
                            <h4 class="mt-2">Open POS</h4>
                        </a>
                    </div>

                    <!-- Sales and Report Section Icon -->
                    <div class="col-md-2 col-6 mb-3">
                        <a href="/sales/status" class="text-decoration-none text-dark d-block text-center">
                            <img src="{{ asset('admin_images/report.png') }}" class="img-fluid" alt="Sale Report"  width="100px " height="auto" >
                            <h4 class="mt-2"> Sale Report</h4>
                        </a>
                    </div>

                    <!-- Tax Section Icon -->
                    <div class="col-md-2 col-6 mb-3">
                        <a href="/tax" class="text-decoration-none text-dark d-block text-center">
                            <img src="{{ asset('admin_images/bag.png') }}" class="img-fluid" alt="Tax Report"  width="100px " height="auto" >
                            <h4 class="mt-2"> Tax Report </h4>
                        </a>
                    </div>

                    <!-- Expenses Section Icon -->
                    <div class="col-md-2 col-6 mb-3">
                        <a href="/exp/status" class="text-decoration-none text-dark d-block text-center">
                            <img src="{{ asset('admin_images/exp.png') }}" class="img-fluid" alt="Expenses"  width="100px " height="auto" >
                            <h4 class="mt-2"> Expenses</h4>
                        </a>
                    </div>

                    <!-- Admin Section Icon -->
                    <div class="col-md-2 col-6 mb-3">
                        <a href="/general" class="text-decoration-none text-dark d-block text-center">
                            <img src="{{ asset('admin_images/manager.png') }}" class="img-fluid" alt="General"  width="100px " height="auto" >
                            <h4 class="mt-2"> General </h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
