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
                <a href="/tax" class="list-group-item list-group-item-action active"><i
                    class="fa-solid fa-receipt fa-lg"></i> Tax Status</a>
                <a href="/tax/daterange" class="list-group-item list-group-item-action "><strong> <i
                      class="fa-solid fa-calendar fa-lg"></i> Tax Date Range</strong></a>
                <a href="/exp/daterange" class="list-group-item list-group-item-action "><strong> <i
                      class="fa-solid fa-coins fa-lg"></i> ###</strong></a>
              </div>
            </div>
            <div class="col-10">
              <div class="d-flex bd-highlight mb-3">
                <h1>Tax Calculation for {{ now()->year }}</h1>

              </div>
              <hr>
              <div class="col-12">
                <div class="row">

                  <table id="dataTab" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th id="data">Month</th>
                        <th id="data">Total Tax 5%</th>
                      </tr>

                    </thead>
                    <tbody>
                      @foreach ($monthlyTotals as $month => $totalTax)
                      <tr>
                        <td>{{ \Carbon\Carbon::create(null, $month, 1)->format('F') }}</td>
                        <td>SLSH {{ number_format($totalTax, 2) }}</td>
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
  </div>
</div>
<script>
    $(document).ready(function () {
        $('#dataTab').DataTable({
          dom: 'Bfrtip',
            buttons: [
                'pdfHtml5',
            ],
            pageLength: 7,
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                // { data: 'edit', name: 'edit' },
                // { data: 'delete', name: 'delete' },
                // Add more columns as needed
            ],
        });
    });
</script>
@endsection