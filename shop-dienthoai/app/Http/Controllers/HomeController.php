<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy danh mục để show sidebar
        $categories = Category::all();

        // Lấy 8 sản phẩm mới nhất
        $products = Product::latest()->take(8)->get();

        return view('home', compact('categories', 'products'));
    }
}
