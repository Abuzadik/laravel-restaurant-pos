@extends('layouts.app')

@section('content')
<!--  -->

<div class="container-xl">
<div class="row" id="table-detail"></div><hr>
<div class="row">

  <div class="col-5">
    <div class="card">
      <div class="card-body">
        <div class="card-header text-light" style="background-color: #192655;"><h5 class="text-center">  Checkout </h5></div>
        <div class="" id="selected-table"></div>
        <div class="" id="order-detail"></div>
      </div>
    </div>
  </div>
  <div class="col-6">
    <nav>
      <div class="nav nav-tabs user-select-none" id="nav-tab" role="tablist">
          <select class="form-select" id="categorySelect" aria-label="Select a category">
            <option value="all" selected>dsfdsfdsf</option>
              @foreach($categories as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
              @endforeach
          </select>
      </div>
  </nav>  
    <div id="list-menu" class="row"> </div>
  </div>
  <div class="col-1">
    <button class="btn btn-primary btn-block" id="btn-show-tables">View Tables</button>
  </div>
</div>
</div>


<!-- Modal -->
<div class="modal fade text-dark" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Checkout Payment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div id="alert-container" class="m-2"></div>
          <label for="payment">Enter Payment</label>
        <div class="input-group mb-3">
           <div class="input-group-prepend">
            <span class="input-group-text">SLSH</span>
           </div> 
           <input type="number" id="recieved-amount" class="form-control">
        </div>
        <div class="form-group">
          <label for="payment">Payment Type</label>
          <select class="form-control" id="payment-type">
            <option value="Zaad / Edahab ">Zaad / Edahab</option>
            <option value="cash">Cash</option>
          </select>
        </div>
      </div>
      <div class="d-flex bd-highlight">
        <div class="p-2 flex-shrink-1 bd-highlight">
        <h4 class="totalAmount fw-bold text-decoration-underline" ></h4> 
        <h5 class="changeAmount fw-bold text-decoration-underline text-danger"></h5>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Exit</button>
        <button type="button" class="btn btn-success btn-save-payment" disabled>Pay now</button>
      </div>
    </div>
  </div>
</div>



<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

{{-- <script>
  $(document).ready(function(){

    //tables hide action
    $("#table-detail").hide();

    //show tables action on clicked button
    $("#btn-show-tables").click(function(){
      if($("#table-detail").is(":hidden")){
          $.get("/pos/getTable", function(data){
          $("#table-detail").html(data);
          $("#table-detail").slideDown('fast');
          $("#btn-show-tables").html("Hidde Tables");
      });
      }else{
          $("#table-detail").slideUp('fast');
          $("#btn-show-tables").html("View Tables");
      }
    });

    //loading menu by category id 
  $('.nav-link').click(function(){
    $.get("/pos/getMenuByCategory/"+$(this).data("id"), function(data){
        $("#list-menu").hide();
        $("#list-menu").html(data);
        $("#list-menu").fadeIn('fast');
    });
  });

  //selected table detect
  var SELECTED_TABLE_ID = "";
  var SELECTED_TABLE_NAME = "";
  var SALE_ID = "";
  $("#table-detail").on("click", ".btn-table" , function(){
     SELECTED_TABLE_ID = $(this).data("id");
     SELECTED_TABLE_NAME = $(this).data("name");
    $("#selected-table").html('<br> <h5> <i class="fa-solid fa-square-check" style="color: #192655;"></i> <strong>  Selected Table: '+SELECTED_TABLE_NAME+' </strong> </h5>');
    $.get("/pos/getSaleDetailsByTable/"+SELECTED_TABLE_ID, function(data){
      $("#order-detail").html(data);
    });
  });

  // selected menu action in js
// selected menu action in js
$("#list-menu").on("click", ".btn-menu", function(){
    if (SELECTED_TABLE_ID == "") {
        alert("You need to select a table for the customer first");
    } else {
        var menu_id = $(this).data("id");
        var quantity = $(this).closest('.menu-item').find('.quantity-input').val();

        // Validate quantity (optional)
        if (quantity > 0) {
            $.ajax({
                type: "POST",
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "menu_id": menu_id,
                    "table_id": SELECTED_TABLE_ID,
                    "table_name": SELECTED_TABLE_NAME,
                    "quantity": quantity
                },
                url: "/pos/orderMenu",
                success: function(data){
                    $("#order-detail").html(data);
                }
            });
        } else {
            alert("Invalid quantity. Please enter a valid quantity.");
        }
    }
});

//order button confirm
$("#order-detail").on('click', ".btn-confirm-order", function(){
    var SaleID = $(this).data("id"); 
    $.ajax({
      type: "POST",
      data: {
        "_token" : $('meta[name="csrf-token"]').attr('content'),
        "sale_id" : SaleID
      },
      url: "/pos/confirmOrderStatus",
      success: function(data){
        $("#order-detail").html(data);
      }
    });
});

// delete sale detail button

$("#order-detail").on("click", ".btn-delete-saledetail",function(){
    var saleDetailID = $(this).data("id");
    $.ajax({
      type: "POST",
      data: {
        "_token" : $('meta[name="csrf-token"]').attr('content'),
        "saleDetail_id": saleDetailID
      },
      url: "/pos/deleteSaleDetail",
      success: function(data){
        $("#order-detail").html(data);
      }
    })

  });

  // when a user click on the payment button
  $("#order-detail").on("click", ".btn-payment", function(){
    var totalAmout = $(this).attr('data-totalAmount');
    $(".totalAmount").html("Sub Total " + totalAmout);
    $("#recieved-amount").val('');
    $(".changeAmount").html('');
    SALE_ID = $(this).data('id');
  });

    // calcuate change
    $("#recieved-amount").keyup(function(){
    var totalAmount = $(".btn-payment").attr('data-totalAmount');
    var recievedAmount = $(this).val();
    var changeAmount = recievedAmount - totalAmount;
    $(".changeAmount").html("Total Change: SLSH" + changeAmount);

    //check if cashier enter the right amount, then enable or disable save payment button

    if(changeAmount >= 0){
      $('.btn-save-payment').prop('disabled', false);
    }else{
      $('.btn-save-payment').prop('disabled', true);
    }

  });

// save payment
$(".btn-save-payment").click(function(){
    var recievedAmount = $("#recieved-amount").val();
    var paymentType = $("#payment-type").val();
    var saleId = SALE_ID;

    $.ajax({
        type: "POST",
        data: {
            "_token" : $('meta[name="csrf-token"]').attr('content'),
            "saleID" : saleId,
            "recievedAmount" : recievedAmount,
            "paymentType" : paymentType
        },
        url: "/pos/savePayment",
        success: function(response){
            // Check if the payment was successful
            if (response.message === 'Payment successful!') {
                // Display success alert
                showAlert('success', response.message);

                // Redirect to "/pos" after a delay (e.g., 2 seconds)
                setTimeout(function() {
                    window.location.href = response.redirect;
                }, 2000);
            } else {
                // Handle other scenarios if needed
                showAlert('error', 'Payment failed.');
            }
        },
        error: function(){
            // Handle AJAX error if needed
            showAlert('error', 'An error occurred.');
        }
    });
});

// Function to show alerts
function showAlert(type, message) {
    var alertClass = 'alert-' + type;
    var alertHtml = '<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
                        message +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                    '</div>';
    $('#alert-container').html(alertHtml);
}

  });
</script> --}}


<script>
  $(document).ready(function () {
    // tables hide action
    $("#table-detail").hide();

    // show tables action on clicked button
    $("#btn-show-tables").click(function () {
        if ($("#table-detail").is(":hidden")) {
            $.get("/pos/getTable", function (data) {
                $("#table-detail").html(data);
                $("#table-detail").slideDown('fast');
                $("#btn-show-tables").html("Hidde Tables");
            });
        } else {
            $("#table-detail").slideUp('fast');
            $("#btn-show-tables").html("View Tables");
        }
    });

    // loading menu by category id 
    function loadMenus(categoryId) {
        if (categoryId === 'all') {
            // Handle the case when "All menu" is selected
            $.get("/pos/allMenus", function (data) {
                $("#list-menu").hide();
                $("#list-menu").html(data);
                $("#list-menu").fadeIn('fast');
            });
        } else {
            // Handle the case when a specific category is selected
            $.get("/pos/getMenuByCategory/" + categoryId, function (data) {
                $("#list-menu").hide();
                $("#list-menu").html(data);
                $("#list-menu").fadeIn('fast');
            });
        }
    }

    
    // loading menu by category id 
    $('#categorySelect').change(function () {
        var categoryId = $(this).val();
        loadMenus(categoryId);
    });


    // loading menu by category id (default: All menu)
    loadMenus('all');

    // selected table detect
    var SELECTED_TABLE_ID = "";
    var SELECTED_TABLE_NAME = "";
    var SALE_ID = "";
    $("#table-detail").on("click", ".btn-table", function () {
        SELECTED_TABLE_ID = $(this).data("id");
        SELECTED_TABLE_NAME = $(this).data("name");
        $("#selected-table").html('<br> <h5> <i class="fa-solid fa-square-check" style="color: #192655;"></i> <strong>  Selected Table: ' + SELECTED_TABLE_NAME + ' </strong> </h5>');
        $.get("/pos/getSaleDetailsByTable/" + SELECTED_TABLE_ID, function (data) {
            $("#order-detail").html(data);
        });
    });

    // selected menu action in js
    $("#list-menu").on("click", ".btn-menu", function () {
        if (SELECTED_TABLE_ID == "") {
            alert("You need to select a table for the customer first");
        } else {
            var menu_id = $(this).data("id");
            var quantity = $(this).closest('.menu-item').find('.quantity-input').val();

            // Validate quantity (optional)
            if (quantity > 0) {
                $.ajax({
                    type: "POST",
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        "menu_id": menu_id,
                        "table_id": SELECTED_TABLE_ID,
                        "table_name": SELECTED_TABLE_NAME,
                        "quantity": quantity
                    },
                    url: "/pos/orderMenu",
                    success: function (data) {
                        $("#order-detail").html(data);
                    }
                });
            } else {
                alert("Invalid quantity. Please enter a valid quantity.");
            }
        }
    });

    // order button confirm
    $("#order-detail").on('click', ".btn-confirm-order", function () {
        var SaleID = $(this).data("id");
        $.ajax({
            type: "POST",
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "sale_id": SaleID
            },
            url: "/pos/confirmOrderStatus",
            success: function (data) {
                $("#order-detail").html(data);
            }
        });
    });

    // delete sale detail button
    $("#order-detail").on("click", ".btn-delete-saledetail", function () {
        var saleDetailID = $(this).data("id");
        $.ajax({
            type: "POST",
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "saleDetail_id": saleDetailID
            },
            url: "/pos/deleteSaleDetail",
            success: function (data) {
                $("#order-detail").html(data);
            }
        })
    });

    // when a user clicks on the payment button
    $("#order-detail").on("click", ".btn-payment", function () {
        var totalAmout = $(this).attr('data-totalAmount');
        $(".totalAmount").html("Sub Total " + totalAmout);
        $("#recieved-amount").val('');
        $(".changeAmount").html('');
        SALE_ID = $(this).data('id');
    });

    // calculate change
    $("#recieved-amount").keyup(function () {
        var totalAmount = $(".btn-payment").attr('data-totalAmount');
        var recievedAmount = $(this).val();
        var changeAmount = recievedAmount - totalAmount;
        $(".changeAmount").html("Total Change: SLSH" + changeAmount);

        // check if cashier entered the right amount, then enable or disable save payment button
        if (changeAmount >= 0) {
            $('.btn-save-payment').prop('disabled', false);
        } else {
            $('.btn-save-payment').prop('disabled', true);
        }
    });

    // save payment
    $(".btn-save-payment").click(function () {
        var recievedAmount = $("#recieved-amount").val();
        var paymentType = $("#payment-type").val();
        var saleId = SALE_ID;

        $.ajax({
            type: "POST",
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                "saleID": saleId,
                "recievedAmount": recievedAmount,
                "paymentType": paymentType
            },
            url: "/pos/savePayment",
            success: function (response) {
                // Check if the payment was successful
                if (response.message === 'Payment successful!') {
                    // Display success alert
                    showAlert('success', response.message);

                    // Redirect to "/pos" after a delay (e.g., 2 seconds)
                    setTimeout(function () {
                        window.location.href = response.redirect;
                    }, 2000);
                } else {
                    // Handle other scenarios if needed
                    showAlert('error', 'Payment failed.');
                }
            },
            error: function () {
                // Handle AJAX error if needed
                showAlert('error', 'An error occurred.');
            }
        });
    });

    // Function to show alerts
    function showAlert(type, message) {
        var alertClass = 'alert-' + type;
        var alertHtml = '<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
            message +
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
            '</div>';
        $('#alert-container').html(alertHtml);
    }
});

</script>

@endsection