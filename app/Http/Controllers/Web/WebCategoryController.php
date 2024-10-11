<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebCategoryController extends Controller
{
    public function index($slug){
        return view('web.list', compact('slug'));
    }
}
