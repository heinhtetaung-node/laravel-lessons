<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function index() {
        // $cats = Category::with('products')->get();
        $cats = Category::all();
        return view('category/index', ["cats" => $cats]);
    }
}
