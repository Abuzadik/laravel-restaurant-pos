<?php

namespace App\Http\Controllers\sales;
use App\Models\Sale;
use App\Models\SaleDetail;
use DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon; 
use DataTable;
use Yajra\DataTables\DataTables;

class reportController extends Controller
{
    public function index()
    {
        // Get sales data from the last 24 hours with related SaleDetails
        $sales = Sale::with('saleDetils')
        ->whereDate('created_at', Carbon::today())
        ->get();
    
    return view("sales.index", compact("sales"));
    }

    public function DateRange(Request $request)
{
    if ($request->ajax()) {
        $data = Sale::with('saleDetils')
            ->select('sales.id', 'sales.table_name', 'sales.user_name', 'sales.total_price', 'sales.payment_type', 'sales.sale_status', 'sales.created_at',
                DB::raw('GROUP_CONCAT(sale_details.menu_name) as menu_names'),
                DB::raw('GROUP_CONCAT(sale_details.menu_price) as menu_prices'),
                DB::raw('GROUP_CONCAT(sale_details.quantity) as quantities')
            )
            ->leftJoin('sale_details', 'sales.id', '=', 'sale_details.sale_id')
            ->groupBy('sales.id', 'sales.table_name', 'sales.user_name', 'sales.total_price', 'sales.payment_type', 'sales.sale_status', 'sales.created_at');

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $data = $data->havingRaw('DATE(sales.created_at) BETWEEN ? AND ?', [$request->from_date, $request->to_date]);
        }

        if ($request->filled('nm')) {
            $searchTerm = '%' . strtolower($request->nm) . '%';
            $data = $data->where(function ($query) use ($searchTerm) {
                $query->whereRaw('LOWER(GROUP_CONCAT(sale_details.menu_name)) LIKE ?', [$searchTerm]);
            });
        }

        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    return view("sales.report");
}

    
    
 
    //status start here
    public function saleStatus(Request $request)
{
    $today = Carbon::now()->startOfDay();
    $last7Days = Carbon::now()->subDays(6)->startOfDay(); // Subtract 6 days to get the last 7 days
    $startOfWeek = Carbon::now()->startOfWeek();
    $startOfMonth = Carbon::now()->startOfMonth();
    $startOfYear = Carbon::now()->startOfYear();

    $salesToday = Sale::selectRaw('SUM(total_price) as total_price')
        ->where('created_at', '>=', $today)
        ->first();

    $last7DaysSales = Sale::selectRaw('SUM(total_price) as total_price')
        ->whereBetween('created_at', [$last7Days, $today])
        ->first();

    $thisMonthSales = Sale::selectRaw('SUM(total_price) as total_price')
        ->whereYear('created_at', $startOfMonth->year)
        ->whereMonth('created_at', $startOfMonth->month)
        ->first();

    $thisYearSales = Sale::selectRaw('SUM(total_price) as total_price')
        ->whereYear('created_at', $startOfYear->year)
        ->first();

    return view("sales.status", compact("salesToday", "last7DaysSales", "thisMonthSales", "thisYearSales"));
}

    
    
    
    public function allSales(Request $request){
        $sales = Sale::with('saleDetils') // Corrected method name
                     ->orderBy('created_at', 'desc') // Sort by latest
                     ->get();
    
        return view("sales.allsales", compact("sales"));
    }
    
    
}    
