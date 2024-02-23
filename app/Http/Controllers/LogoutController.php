<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
class LogoutController extends Controller
{
    public function logout(Request $request){
        Auth::logout();
        Cache::flush();
        return redirect("/");
    }
}
