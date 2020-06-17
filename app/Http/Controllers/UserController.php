<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function SeConnecter(Request $request)
    {
        $user = DB::table('users')->where('name', $request->name);
    }
}
