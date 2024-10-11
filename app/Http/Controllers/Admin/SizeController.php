<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index(){
        return view('admin.size.index');
    }

    public function create(){
        return view('admin.size.create');
    }

    public function update(){
        return view('admin.size.update');
    }
}
