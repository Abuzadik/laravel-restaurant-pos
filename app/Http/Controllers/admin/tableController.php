<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;

class tableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $table = Table::all();
        return view("admin.tables")->with("tables", $table);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.createTables");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(["name"=> "required|unique:tables|max:255",]);
        $table = new Table();
        $table->name = $request->name;
        $table->save();
        $request->session()->flash("status","Table" . $request->name ."is Created successfully");
        return redirect("/admin/restaurant/table");

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
        $table = Table::find($id);
        return view("admin.edit_table")->with("tables", $table);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(["name"=> "required|max:255"]);
        $table = Table::find($id);
        $table->name = $request->name;
        $table->save();
        $request->session()->flash("status", " Table is Updated To  ".$table->name . " successfully ") ;
        return redirect("/admin/restaurant/table");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $table = Table::find($id);
        $table->delete();
        Session()->flash("status","The Table Deleted Successfully") ;
        return redirect("/admin/restaurant/table")->with("success","");
    }
}
