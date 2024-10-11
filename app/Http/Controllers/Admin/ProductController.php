<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('admin.product.index');
    }

    public function create(){
        return view('admin.product.create');
    }

    public function update(){
        return view('admin.product.update');
    }

    public function size(){
        return view('admin.product.size');
    }

    public function border(){
        return view('admin.product.border');
    }

    public function topping(){
        return view('admin.product.topping');
    }
}
