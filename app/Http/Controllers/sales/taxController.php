<?php

namespace App\Http\Controllers\sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use Yajra\DataTables\DataTables;

class taxController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Sale::select('*');
            if ($request->filled('from_date') && $request->filled('to_date')) {
                $data = $data->whereBetween('created_at', [$request->from_date, $request->to_date]);
            }
            return DataTables::of($data)->addIndexColumn()->make(true);
        }
        return view("sales/tax.tax");
    }


}
