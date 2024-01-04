<?php

namespace App\Http\Controllers\expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expenses;

class expenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $expenses = Expenses::all();
        if ($request->ajax()) {
            return response()->json([
                "data"=> $expenses,
            ]);
        }
        return view("expenses.exp", compact("expenses"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("expenses.create_exp");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "expense_type"=> "required|unique:expenses|max:255",
            "amount"=> "required|unique:expenses|max:255",
            "detail"=> "required|unique:expenses|max:255",
        ]);
        $expense = new Expenses();
        $expense->expense_type = $request->expense_type;
        $expense->amount = $request->amount;
        $expense->detail = $request->detail;
        $expense->save();
        $request->Session()->flash("status","Expense Added Successfully");
        return redirect("/expenses")->with("success","");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expenses = Expenses::find($id);
        return view("expenses.edit_exp", compact("expenses"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "expense_type"=> "required|max:255",
            "amount"=> "required|max:255",
            "detail"=> "required|max:255",
        ]);
        $expenses = Expenses::find($id);
        $expenses->expense_type = $request->expense_type;
        $expenses->amount = $request->amount;
        $expenses->detail = $request->detail;
        $expenses->save();
        $request->Session()->flash("status","Expense Editing  Successfully");
        return redirect("/expenses")->with("success","");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $expenses = Expenses::find($id);
        $expenses->delete();
        session()->flash("status","Expenses Deleted successfully");
        return redirect("/expenses")->with("success","");
    }
}
