<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class viewController extends Controller
{
    public function registrationApprovalShow(){
        $query = DB::select("SELECT * FROM accounts WHERE email");
        return view("manageAccount",["query"=>$query]);

    }
}
