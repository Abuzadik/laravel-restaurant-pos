<?php

namespace App\Http\Controllers\system;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\system;

class systemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $systems = System::all();
        return view("general/system.system", compact("systems"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("general/system.set_system");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=> "required|unique:systems|max:100",
            "address"=> "required|unique:systems|max:200",
            "telephone"=> "required|max:30",
            // "role"=> "required",
        ]);

        $system = new System();
        $system->name = $request->name;
        $system->address = $request->address;
        $system->telephone = $request->telephone;
        $system->save();
        $request->Session()->flash("status","Set Restaurant Information Successfully");
        return redirect("/general/system")->with("success","");
        
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
        $system = System::find($id);
        return view("general/system.edit_system", compact("system"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name"=> "required|max:100",
            "address"=> "required",
            "telephone"=> "required|numeric",
            // "role"=> "required",
        ]);
        $system = System::find($id);
        $system->name = $request->name;
        $system->address = $request->address;
        $system->telephone = $request->telephone;
        $system->save();
        $request->Session()->flash("status","Update Restaurant Information Successfully");
        return redirect("/general/system")->with("success","");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
