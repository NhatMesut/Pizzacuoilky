<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ToppingController extends Controller
{
    public function index(){
        return view('admin.toppings.index');
    }

    public function create(){
        return view('admin.toppings.create');
    }

    public function update(){
        return view('admin.toppings.update');
    }
}
