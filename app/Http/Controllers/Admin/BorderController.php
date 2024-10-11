<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BorderController extends Controller
{
    public function index(){
        return view('admin.border.index');
    }

    public function create(){
        return view('admin.border.create');
    }

    public function update(){
        return view('admin.border.update');
    }
}
