<?php

namespace App\Http\Controllers\tax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;


class taxController extends Controller
{


    public function index()
{
    // Get sales data for the current year
    $currentYear = now()->year;
    $sales = Sale::whereYear('created_at', $currentYear)->get();

    // Calculate total_price * tax_rate for each month
    $monthlyTotals = $sales->groupBy(function ($sale) {
        return $sale->created_at->format('m'); // Group by month
    })->map(function ($groupedSales) {
        return $groupedSales->sum(function ($sale) {
            return $sale->total_price * $sale->tax_rate;
        });
    });

    return view("tax.index", compact("monthlyTotals"));
}


    public function taxDateRange(Request $request)
    {
        if ($request->ajax()) {
            $data = Sale::select('*');
            if ($request->filled('from_date') && $request->filled('to_date')) {
                $data = $data->whereBetween('created_at', [$request->from_date, $request->to_date]);
            }
            return DataTables::of($data)->addIndexColumn()->make(true);
        }
        return view("tax.tax");
    }
}
