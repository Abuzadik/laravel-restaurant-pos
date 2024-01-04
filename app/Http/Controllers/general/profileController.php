<?php
namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class profileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view("general/profile.profile", compact("user"));
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|min:8|different:current_password',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user->update(['password' => Hash::make($request->new_password)]);

        $request->session()->flash("status", "Password changed successfully");
        return redirect("/general/profile")->with("success", "");
    }
}
