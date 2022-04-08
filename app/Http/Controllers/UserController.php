<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // show user dashboard
    public function index(){
        $user = Auth::user()->name;
        return view('user/index', [
            'user' => $user,
        ]);
    }
}
