<?php

namespace App\Http\Controllers\expense;

use Carbon\Carbon;
use App\Models\Expenses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class statsController extends Controller
{
    public function index()
    {
        // Monthly expenses for the current month
        $monthlyExpenses = Expenses::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->get();

        // Yearly expenses for the current year
        $yearlyExpenses = Expenses::whereYear('created_at', Carbon::now()->year)
            ->get();

        // Expenses for the current 6 months
        $sixMonthExpenses = Expenses::where('created_at', '>=', Carbon::now()->subMonths(5))
            ->where('created_at', '<=', Carbon::now())
            ->get();

        // Expenses for today
        $todayExpenses = Expenses::whereDate('created_at', Carbon::today())
            ->get();

        return view("expenses.stats_expenses", compact("monthlyExpenses", "yearlyExpenses", "sixMonthExpenses", "todayExpenses"));
    }

    
}

