<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class DatatableController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        if ($request->ajax()) {
            // Check if date range is provided in the request
            if ($request->has('start_date') && $request->has('end_date')) {
                $startDate = $request->input('start_date');
                $endDate = $request->input('end_date');

                // Filter categories based on date range
                $categories = Category::whereBetween('your_date_column', [$startDate, $endDate])->get();
            }

            return response()->json([
                "data" => $categories,
            ]);
        }

        return view("admin.datatable", compact("categories"));
    }
}
