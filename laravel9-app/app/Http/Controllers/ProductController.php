<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductController extends Controller
{
    //
    public function index() {
        $prods = Products::with('category')->get();
        return view('product/index', ['prods' => $prods]);
    }
}
