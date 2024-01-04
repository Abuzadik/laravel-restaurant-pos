<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GST POS - Receipt - SaleID: {{$sale->id}}</title>
  <link type="text/css" rel="stylesheet" href="{{asset('/css/receipt.css')}}" media="all">
  <link type="text/css" rel="stylesheet" href="{{asset('/css/no-print.css')}}" media="print">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    #wrapper {
      max-width: 400px;
      margin: 0 auto;
      background-color: #fff;
      padding: 15px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    #receipt-header {
      text-align: center;
      /* margin-bottom: 15px; */
    }

    #resturant-name {
      color: #e44d26;
    }

    #receipt-body {
      margin-bottom: 15px;
    }

    .tb-sale-detail {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 10px;
    }

    .tb-sale-detail th,
    .tb-sale-detail td {
      border: 1px solid #ddd;
      padding: 5px;
      text-align: left;
    }

    .tb-sale-detail th {
      background-color: #f2f2f2;
    }

    .tb-sale-total {
      width: 100%;
      border-collapse: collapse;
    }

    .tb-sale-total td {
      border: none;
      padding: 5px;
      text-align: left;
    }

    #receipt-footer {
      text-align: center;
      margin-top: 15px;
    }

    #buttons {
      text-align: center;
      margin-top: 15px;
    }

    .btn {
      display: inline-block;
      padding: 8px 12px;
      font-size: 14px;
      cursor: pointer;
      border: none;
      color: #fff;
    }

    .btn-back {
      background-color: #4caf50;
    }

    .btn-print {
      background-color: #008CBA;
    }

    .btn:hover {
      opacity: 0.8;
    }

    @media print {
      #wrapper {
        width: 80mm; /* Set the desired width for the print size */
        height: 120mm; /* Set the desired height for the print size */
      }

      #buttons {
        display: none;
      }
    }
  </style>
</head>
<body>

<div id="wrapper">
<div id="receipt-header">
    <h3 id="restaurant-name" class="text-danger">{{ $system->name }}</h3>
    <p>Address: {{ $system->address }}</p>
    <p>Tel: {{ $system->telephone }}</p>
    <p>Reference Receipt: <strong>{{ $sale->id }}</strong></p>
    <!-- <p>Date: {{ $system->created_at->format('Y-m-d') }}</p> -->
    <p id="currentDateTime" class="lead"></p>
</div>

  <div id="receipt-body">
    <table class="tb-sale-detail">
      <thead>
        <tr>
          <th>#</th>
          <th>Menu</th>
          <th>Qty</th>
          <th>Price</th>
          <th>Total</th>
          <!-- <th>Total + Tax</th>  -->
        </tr>
      </thead>
      <tbody>
        @php
          $count = 1; // Initialize the count variable
        @endphp
        @foreach($saleDetails as $saleDetail)
          <tr>
            <td>{{ $count++ }}</td>
            <td width="180">{{ $saleDetail->menu_name }}</td>
            <td width="50">{{ $saleDetail->quantity }}</td>
            <td width="55">{{ $saleDetail->menu_price }}</td>
            <td width="65">{{ $saleDetail->menu_price * $saleDetail->quantity }}</td>
            <!-- <td width="65">{{ number_format($totalAmount, 2) }}</td> -->
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div>
    <h5>Total Change: SLSH: {{number_format($sale->change, 2)}}</h5>
    <h4>Total Tax: SlSH : {{ number_format($totalTax, 2) }}</h4>
    <h4>Total Amount + Tax: SlSH : {{ number_format($totalAmount, 2) }}</h4>
  </div>

  <div id="receipt-footer">
    <p>Thank You!!!</p>
  </div>

  <div id="buttons">
    <a href="/pos">
      <button class="btn btn-back">
        Back to POS
      </button>
    </a>
    <button class="btn btn-print" type="button" onclick="printAndRedirect();">
      Print
    </button>
  </div>
</div>

<script>
  function printAndRedirect() {
    // Trigger printing
    window.print();

    // Redirect back to "/pos" after a short delay (adjust the delay as needed)
    setTimeout(function () {
      window.location.href = "/pos";
    }, 1000); // 1000 milliseconds = 1 second
  }
</script>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        // Function to update the current date and time
        function updateCurrentDateTime() {
            var currentDateTime = new Date();
            var formattedDateTime = currentDateTime.toLocaleString('en-US', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            });

            $("#currentDateTime").text(" Date-Time: " + formattedDateTime);
            // $("#currentDateTime").text(" Date and Time: " + formattedDateTime);
        }

        // Initial update
        updateCurrentDateTime();

        // Update every second
        setInterval(updateCurrentDateTime, 1000);
    });
</script>
</html>
