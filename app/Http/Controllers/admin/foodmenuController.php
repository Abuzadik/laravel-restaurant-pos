<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\foodmenu;
use App\Models\Category;


class foodmenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foodmenu =foodmenu::all();
        return view("admin.foodmenu")->with("foodmenus", $foodmenu);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("admin.createmenu")->with("categories", $categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=> "required|unique:foodmenus|max:255",
            "price"=> "required|numeric:foodmenus",
            "category_id"=> "required|numeric:foodmenus",
        ]);

        //if user does not update the image
        $imageName = "noImage.png";

        //if user does update the image
        if($request->image){
            $request->validate([
                "image"=> "nullable|file|image|mimes:jpeg,jpg,png|max:5000",
            ]);
            $imageName = date("mdYHis") .".". $request->image->extension();
            $request->image->move(public_path("menu_images") ."", $imageName);
        }

        //save info menu table 

        $foodmenu = new foodmenu;
        $foodmenu->name = $request->name;
        $foodmenu->image = $imageName;
        $foodmenu->detail = $request->detail;
        $foodmenu->price = $request->price;
        $foodmenu->category_id = $request->category_id;
        $foodmenu->save();
        $request->Session()->flash("status","Menu Added Successfully");
        return redirect("/admin/restaurant/foodmenu")->with("success","");

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
        $menu = foodmenu::find($id);
        $category = Category::all();
        return view("admin.edit_menu")->with('foodmenus',$menu)->with("categories", $category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name"=> "required|max:255",
            "price"=> "required|numeric",
            "category_id" => "required|numeric",
        ]);

        $menu = foodmenu::find($id);

        //validate images

        if($request->image){
            $request->validate([
                "image"=> "nullable|file|image|mimes:jpeg,jpg,png|max:5000",
            ]);
            if($menu->image != 'noImage.png'){
                $imageName = $menu->image;
                unlink(public_path('menu_images'.$imageName));
            }
            $imageName = date("mdYHis") .".". $request->image->extension();
            $request->image->move(public_path("menu_images") ."", $imageName);
        }else{
            $imageName = $menu->image;
        }

        $menu->name = $request->name;
        $menu->price = $request->price;
        $menu->image = $imageName;
        $menu->detail = $request->detail;
        $menu->category_id = $request->category_id;
        $menu->save();
        $request->Session()->flash("status","Menu Added Successfully");
        return redirect("/admin/restaurant/foodmenu")->with("success","");
        
       

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = foodmenu::find($id);
        $menu->delete();
        Session()->flash("status","Deleted Successfully") ;
        return redirect("/admin/restaurant/foodmenu")->with("success","");
        
    }
}
