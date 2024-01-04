<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class restaurantController extends Controller
{
    public function AdminRestaurant(){
        return view("admin.restaurant");
    }
}
