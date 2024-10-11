<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(){
        return view('admin.coupon.index');
    }

    public function create(){
        return view('admin.coupon.create');
    }

    public function update(){
        return view('admin.coupon.update');
    }
}
