<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        flash('hello bro')->success();
        return view('backend.dashboard');
    }
}
