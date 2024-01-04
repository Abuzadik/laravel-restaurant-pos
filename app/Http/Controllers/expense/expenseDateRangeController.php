<?php

namespace App\Http\Controllers\expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expenses;
use Yajra\DataTables\DataTables;

class expenseDateRangeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Expenses::select('*');

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $data = $data->whereBetween('created_at', [$request->from_date, $request->to_date]);
            }

            return DataTables::of($data)->addIndexColumn()->make(true);
        }

        return view("expenses.daterange_exp");
    }
}
