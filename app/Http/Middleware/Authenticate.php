<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // $url = '';
        // if($request -> user()->role === 'admin') {
        //     $url = route('/admin/dashboard');
        // }else if($request -> user()->role === 'user') {
        //     $url = route('/home');
        // }
        //     return redirect()->intended($url);
        
            return $request->expectsJson() ? null : route('login');
    }
}
