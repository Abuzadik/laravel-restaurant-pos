<!-- resources/views/admin/restaurant/category/index.blade.php -->

@extends('layouts.app')

@section('content')
<style>
    
h2,
h5,
.h2,
.h5 {
  font-family: inherit;
  font-weight: 600;
  line-height: 1.5;
  margin-bottom: .5rem;
  color: #32325d;
}

h5,
.h5 {
  font-size: .8125rem;
}

@media (min-width: 992px) {
  
  .col-lg-6 {
    max-width: 50%;
    flex: 0 0 50%;
  }
}

@media (min-width: 1200px) {
  
  .col-xl-3 {
    max-width: 25%;
    flex: 0 0 25%;
  }
  
  .col-xl-6 {
    max-width: 50%;
    flex: 0 0 50%;
  }
}


.bg-danger {
  background-color: #f5365c !important;
}



@media (min-width: 1200px) {
  
  .justify-content-xl-between {
    justify-content: space-between !important;
  }
}


.pt-5 {
  padding-top: 3rem !important;
}

.pb-8 {
  padding-bottom: 8rem !important;
}

@media (min-width: 768px) {
  
  .pt-md-8 {
    padding-top: 8rem !important;
  }
}

@media (min-width: 1200px) {
  
  .mb-xl-0 {
    margin-bottom: 0 !important;
  }
}




.font-weight-bold {
  font-weight: 600 !important;
}


a.text-success:hover,
a.text-success:focus {
  color: #24a46d !important;
}

.text-warning {
  color: #fb6340 !important;
}

a.text-warning:hover,
a.text-warning:focus {
  color: #fa3a0e !important;
}

.text-danger {
  color: #f5365c !important;
}

a.text-danger:hover,
a.text-danger:focus {
  color: #ec0c38 !important;
}

.text-white {
  color: #fff !important;
}

a.text-white:hover,
a.text-white:focus {
  color: #e6e6e6 !important;
}

.text-muted {
  color: #8898aa !important;
}

@media print {
  *,
  *::before,
  *::after {
    box-shadow: none !important;
    text-shadow: none !important;
  }
  
  a:not(.btn) {
    text-decoration: underline;
  }
  
  p,
  h2 {
    orphans: 3;
    widows: 3;
  }
  
  h2 {
    page-break-after: avoid;
  }
  
  @ page {
    size: a3;
  }
  
  body {
    min-width: 992px !important;
  }
}

figcaption,
main {
  display: block;
}

main {
  overflow: hidden;
}

.bg-yellow {
  background-color: #ffd600 !important;
}

.icon {
  width: 3rem;
  height: 3rem;
}

.icon i {
  font-size: 2.25rem;
}

.icon-shape {
  display: inline-flex;
  padding: 12px;
  text-align: center;
  border-radius: 50%;
  align-items: center;
  justify-content: center;
}



</style>
<div class="m-2">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Report') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <div class="list-group">
                                <a href="/sales" class="list-group-item list-group-item-action active "><strong> <i
                                            class="fa-solid fa-chart-pie fa-lg"></i> Stats</strong></a>
                                <a href="/sales" class="list-group-item list-group-item-action "><strong> <i
                                            class="fa-solid fa-bars-staggered fa-lg"></i> Today</strong></a>
                                <a href="/sales/allSales" class="list-group-item list-group-item-action "><strong> <i
                                            class="fa-solid fa-bars-staggered fa-lg"></i> All Sales</strong></a>
                             
                                <a href="/sales/DateRange" class="list-group-item list-group-item-action"><i
                                        class="fa-solid fa-calendar fa-lg"></i> Date Range </a>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="d-flex bd-highlight mb-3">
                                <h3 class="me-auto p-2 bd-highlight "> SALES DASHBOARD</h3>
                                <div class="p-2 bd-highlight">
                                    @if(session()->has('status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class=" col-12">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-6">
                                        <div class="card card-stats mb-4 mb-xl-0">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="card-title text-uppercase text-muted mb-0">Today Sales include Tax 5% (SLSH)
                                                        </h5>
                                                        <span class="h2 font-weight-bold mb-0">
                                                        {{ number_format($salesToday->total_price ?? 0, 2) }}
                                                        </span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div
                                                            class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                            <i class="fa-solid fa-clipboard-list fa-xl" style="color: #004bcc;"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="row"> -->
                                    <div class="col-xl-3 col-lg-6">
                                        <div class="card card-stats mb-4 mb-xl-0">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="card-title text-uppercase text-muted mb-0">Last 7Days Sales
                                                        </h5>
                                                        <span class="h2 font-weight-bold mb-0">{{ isset($last7DaysSales) ? number_format($last7DaysSales->total_price, 2) : 0 }}</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div
                                                            class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                            <i class="fa-solid fa-clipboard-list fa-xl" style="color: #004bcc;"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6">
                                        <div class="card card-stats mb-4 mb-xl-0">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="card-title text-uppercase text-muted mb-0">this Month Sale</h5>
                                                        <span class="h2 font-weight-bold mb-0">{{ isset($thisMonthSales) ? number_format($thisMonthSales->total_price, 2) : 0 }}</span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div
                                                            class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                                            <i class="fa-solid fa-clipboard-list fa-xl" style="color: #004bcc;"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6">
                                        <div class="card card-stats mb-4 mb-xl-0">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="card-title text-uppercase text-muted mb-0">
                                                            This Year Sales</h5>
                                                        <span class="h2 font-weight-bold mb-0">{{ isset($thisYearSales) ? number_format($thisYearSales->total_price, 2) : 0 }}<span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div
                                                            class="icon icon-shape bg-info text-white rounded-circle shadow">
                                                            <i class="fa-solid fa-clipboard-list fa-xl" style="color: #004bcc;"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <br>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

@endsection