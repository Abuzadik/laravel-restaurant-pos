<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        if ($request->ajax()) {
            return response()->json([
                "data"=> $categories,
            ]);
        }

       
        return view("admin.category", compact("categories"));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.create_category");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=> "required|unique:categories|max:255",
        ]);
        $category = new Category;
        $category->name = $request->name;
        $category->save();
        $request->Session()->flash("status","Added Successfully");
        return redirect("/admin/restaurant/category")->with("success","");
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
        $category = Category::find($id);
        return view("admin.edit_category", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name"=> "required|unique:categories|max:25",
        ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
        $request->Session()->flash("status",$category->name. ' > ' ."Editing Successfully");
        return redirect("/admin/restaurant/category")->with("success","");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
        $category = Category::find($id);
        $category->delete();
        session()->flash("status","Catgeory Deleted successfully");
        return redirect("/admin/restaurant/category")->with("success","");
    }
}
