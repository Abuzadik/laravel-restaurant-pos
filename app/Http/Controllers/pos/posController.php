<?php

namespace App\Http\Controllers\pos;
use App\Models\Table;
use App\Models\Category;
use App\Models\foodmenu;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\system;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class posController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view("pos.pos")->with("categories", $categories);
    }

public function getTable(){
    $tables = Table::all();
    $html = '';
    foreach($tables as $table){
        $html .= '<div class="col-md-2">';
        $html .= 
            '<button type="button" class="btn btn-dark btn-table" data-id="'.$table->id.'" data-name="'.$table->name.'">
                <image class="img-fluid" src="'.url('/images/tab.png').'" width="60px" height="auto"/>
                <br>';

                // Check if the table has any confirmed orders
                $hasConfirmedOrders = SaleDetail::whereHas('sale', function ($query) use ($table) {
                    $query->where('table_id', $table->id)->where('sale_status', 'confirmed');
                })->exists();

                // Check if the table has any unpaid orders
                $hasUnpaidOrders = Sale::where('table_id', $table->id)->where('sale_status', 'unpaid')->exists();

                if (!$hasConfirmedOrders && !$hasUnpaidOrders) {
                    $html .= '<span class="badge bg-dark">'.$table->name.'</span>';
                } else {
                    $html .= '<span class="badge bg-danger">'.$table->name.'</span>';
                }

        $html .='</button>';
        $html .= '</div>';
    }
    return $html;
}

    

    //get menu using category id 
    public function getMenuByCats($category_id){
        $menus = foodmenu::where('category_id', $category_id)->get();
        $html = '';
        foreach($menus as $menu){
            $html .= '
                <div class="col-md-3 text-center text-light menu-item-container"> <br>
                    <div class="menu-item">
                        <img class="img-fluid menu-item-image" src="'.url('/menu_images/'.$menu->image).'" alt="'.$menu->name.'">
                        <br> 
                        <div class="text-white menu-item-name">'.$menu->name.'</div>
                        <div class="text-white">SLSH - '.number_format($menu->price).'</div>
                        
                        <div class="input-group menu-item-input-group">
                            <input type="number" class="form-control quantity-input" data-id="'.$menu->id.'" min="1" value="1">
                            <button class="btn btn-primary btn-menu" data-id="'.$menu->id.'">Order</button>
                        </div>
                    </div>
                </div>';
        }
        return $html;
    }

    
public function allmenus() {
    $menus = foodmenu::all();
    $html = '';
    foreach($menus as $menu){
        $html .= '
            <div class="col-md-3 text-center text-light menu-item-container"> <br>
                <div class="menu-item">
                    <img class="img-fluid menu-item-image" src="'.url('/menu_images/'.$menu->image).'" alt="'.$menu->name.'">
                    <br> 
                    <div class="text-white menu-item-name">'.$menu->name.'</div>
                    <div class="text-white">SLSH - '.number_format($menu->price).'</div>
                    
                    <div class="input-group menu-item-input-group">
                        <input type="number" class="form-control quantity-input" data-id="'.$menu->id.'" min="1" value="1">
                        <button class="btn btn-primary btn-menu" data-id="'.$menu->id.'">Order</button>
                    </div>
                </div>
            </div>';
    }
    return $html;
}
    
    
    
    
// ...

private const TAX_RATE = 0.05; // Define tax rate as a constant

// ...

// order menu selected action
public function orderMenu(Request $request)
{
    $menu = foodmenu::find($request->menu_id);
    $table_id = $request->table_id;
    $table_name = $request->table_name;

    $sale = Sale::where('table_id', $table_id)->where('sale_status', 'unpaid')->first();

    // if there is no sale for the selected table, create a new sale record
    if (!$sale) {
        $user = Auth::user();
        $sale = new Sale();
        $sale->table_id = $table_id;
        $sale->table_name = $table_name;
        $sale->user_id = $user->id;
        $sale->user_name = $user->name;
        $sale->save();
        $sale_id = $sale->id;

        // update table status
        $table = Table::find($table_id);
        $table->status = "unavailable";
        $table->save();
    } else { // if there is a sale on the selected table
        $sale_id = $sale->id;
    }

    // add ordered menu to the sale_details table
    $saleDetail = new SaleDetail();
    $saleDetail->sale_id = $sale_id;
    $saleDetail->menu_id = $menu->id;
    $saleDetail->menu_name = $menu->name;
    $saleDetail->menu_price = $menu->price;
    $saleDetail->quantity = $request->quantity; // Use the quantity parameter from the request
    $saleDetail->save();

    // update total price in the sales table including tax
    $totalWithTax = $this->calculateTotalWithTax($menu->price, $request->quantity);
    $sale->total_price += $totalWithTax;
    $sale->save();

    $html = $this->getSaleDetails($sale_id);
    return $html;
}

// ...

private function calculateTotalWithTax($price, $quantity)
{
    $totalWithoutTax = $price * $quantity;
    $totalWithTax = $totalWithoutTax * (1 + self::TAX_RATE);
    return $totalWithTax;
}


 
public function getSaleDetailsByTable($table_id){
    $sale = Sale::where('table_id', $table_id)->where('sale_status','unpaid')->first();
    $html = '';

    if($sale){
        $html .= $this->getSaleDetails($sale->id);
    } else {
        $html .= "Not Found Any Sale Details for the Selected Table";

        // Check if the total amount for the table is 0
        $table = Table::find($table_id);

        if ($table && $table->status === "unavailable" && $table->total_price === 0) {
            $table->status = "available";
            $table->save();
        }
    }

    return $html;
}



private function getSaleDetails($sale_id)
{
    $html = '<p> Sale ID: ' . $sale_id . ' </p>';
    $saleDetails = SaleDetail::where('sale_id', $sale_id)->get();
    $totalTax = 0; // Initialize total tax
    $showBtnPayment = true; // Initialize the flag
    $totalAmount = 0; // Initialize total amount

    $html .= '<div class="table-responsive-md" style="overflow-y:scroll; height: 300px; border: 1px solid #343A40"> 
                 <table class="table table-stripped ">
                     <thead>
                         <tr>
                             
                             <th scope="col">Menu</th>
                             <th scope="col">QTY</th>
                             <th scope="col">Price</th>
                             <th scope="col">Total</th>
                             <th scope="col">Total + Tax5%</th>
                             <th scope="col">Status</th>
                         </tr>
                     </thead>
                     <tbody>';

    foreach ($saleDetails as $saleDetail) {
        if ($saleDetail->status == "noConfirm") {
            $showBtnPayment = false;
        }
        $totalWithoutTax = $saleDetail->menu_price * $saleDetail->quantity;
        $totalWithTax = $this->calculateTotalWithTax($saleDetail->menu_price, $saleDetail->quantity);

        $html .= '
            <tr>
               
                <td>' . $saleDetail->menu_name . '</td>
                <td>' . $saleDetail->quantity . '</td>
                <td>' . $saleDetail->menu_price . '</td>
                <td>' . $totalWithoutTax . '</td>
                <td>' . $totalWithTax . '</td>';

        if ($saleDetail->status === "noConfirm") {
            $showBtnPayment = false;
            $html .= '<td> <a data-id="' . $saleDetail->id . '" data-totalTax="' . $totalTax . '" class="btn btn-light btn-delete-saledetail">
                           <i class="fa-solid fa-x fa-shake fa-lg" style="color: #e6000b;"></i> </a> 
                    </td>';
        } else {
            $html .= '<td> <i class="fa-solid fa-circle-check"></i> </td>';
        }
        $html .= '</tr>';

        // Accumulate total tax for each item
        $totalTax += ($totalWithTax - $totalWithoutTax);
        // Accumulate total amount
        $totalAmount += $totalWithTax;
    }

    $html .= '</tbody></table></div>';

    $sale = Sale::find($sale_id);
    $html .= '<hr>';
    $html .= '<div class="card-footer  text-light text-center" style="background-color: #192655;"><h5 >
                <h4><strong>Total Amount: SlSH' . number_format($totalAmount) . '</strong></h4>
                <h5>Total Tax: SlSH' . number_format($totalTax) . '</h5>';

    if ($totalAmount < 1) {
        $html .= ' <div class="d-grid gap-2 col-6 mx-auto">
                        <button class="btn btn-warning" type="button" disabled>Order First</button>
                    </div>';
    } elseif ($showBtnPayment) {
        $html .= ' <div class="d-grid gap-2 col-6 mx-auto">
                        <button data-id="' . $sale_id . '" class="btn btn-success btn-payment" data-totalAmount="' . $totalAmount . '" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal">Payment </button>
                    </div>';
    } else {
        $html .= ' <div class="d-grid gap-2 col-6 mx-auto">
                        <button data-id="' . $sale_id . '" class="btn btn-primary btn-confirm-order" type="button">Confirm Order </button>
                    </div>';
    }

    $html .= '</div>';
    $html .= '';
    return $html;
}

 


                //confirm order button 
         public function confirmOrderStatus(Request $request){
            $sale_id = $request->sale_id;
            $saleDetails = SaleDetail::where('sale_id', $sale_id)->update(['status'=>'confirm']);
            $html = $this->getSaleDetails($sale_id);
            return $html;
        }

        public function deleteSaleDetail(Request $request)
        {
            $saleDetail_id = $request->saleDetail_id;
            $saleDetail = SaleDetail::find($saleDetail_id);
        
            // Check if the sale detail has been confirmed
            if ($saleDetail->status === 'confirm') {
                // You may want to handle this differently depending on your requirements
                return response()->json(['error' => 'Cannot delete a confirmed order.'], 422);
            }
        
            $sale_id = $saleDetail->sale_id;
            $menu_price = ($saleDetail->menu_price * $saleDetail->quantity);
            $saleDetail->delete();
        
            // Recalculate total price and tax
            $sale = Sale::find($sale_id);
            $totalWithoutTax = $saleDetail->menu_price * $saleDetail->quantity;
            $totalWithTax = $this->calculateTotalWithTax($saleDetail->menu_price, $saleDetail->quantity);
            $sale->total_price -= $totalWithTax;
            $sale->save();
        
            // Check if there are any sale details for the selected table
            $saleDetails = SaleDetail::where('sale_id', $sale_id)->first();
            if ($saleDetails) {
                $html = $this->getSaleDetails($sale_id);
            } else {
                // No sale details for the selected table, set total amount to 0
                $html = '<p>No Sale Details for the Selected Table</p>';
                
                // Also, update the table status if needed
                $table = Table::find($sale->table_id);
                $table->status = "available";
                $table->save();
            }
        
            return $html;
        }
        
        public function savePayment(Request $request){
            
            $saleID = $request->saleID;
            $recievedAmount = $request->recievedAmount;
            $paymentType = $request->paymentType;
            // update sale information in the sales table by using sale model
            $sale = Sale::find($saleID);
            $sale->total_recieved = $recievedAmount;
            $sale->change = $recievedAmount - $sale->total_price;
            $sale->payment_type = $paymentType;
            $sale->sale_status = "paid";
            $sale->save();
            //update table to be available
            $table = Table::find($sale->table_id);
            $table->status = "available";
            $table->save();
            return response()->json([
                'message' => 'Payment successful!',
                'redirect' => '/pos/printReceipt/' . $saleID,
            ]);
            
            
            
        }

        
        public function showReceipt($saleID)
        {
            $sale = Sale::find($saleID);
            
            $saleDetails = SaleDetail::where('sale_id', $saleID)->get();
        
            $totalTax = 0;
            $totalAmount = 0;
        
            foreach ($saleDetails as $saleDetail) {
                $totalWithoutTax = $saleDetail->menu_price * $saleDetail->quantity;
                $totalWithTax = $this->calculateTotalWithTax($saleDetail->menu_price, $saleDetail->quantity);
                $totalTax += ($totalWithTax - $totalWithoutTax);
                $totalAmount += $totalWithTax;
            }
        
            // Fetch system information from the database
            $system = System::first(); // Adjust this based on your actual database structure
        
            return view('pos.printReceipt')->with([
                'sale' => $sale,
                'saleDetails' => $saleDetails,
                'totalTax' => $totalTax,
                'totalAmount' => $totalAmount,
                'system' => $system, // Add system information to the view
            ]);
        }
        

        

}