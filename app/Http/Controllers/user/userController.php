<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function UserDashboard(){
        return view("user.user_dashboard");
    }
}
