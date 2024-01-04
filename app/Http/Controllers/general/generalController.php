<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class generalController extends Controller
{
    public function index(){
        return view("general.index");
    }
}
