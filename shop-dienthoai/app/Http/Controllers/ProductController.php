<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 👉 Trang danh sách tất cả sản phẩm (products)
    public function index(Request $request)
    {
        $query = Product::query();

        // Tìm kiếm theo tên sản phẩm
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // Lấy danh sách sản phẩm và phân trang
        $products = $query->paginate(12);

        // Lấy danh mục (nếu có)
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    // 👉 Trang danh mục sản phẩm (lọc theo category)
    public function category($category_id)
    {
        $categories = Category::all();
        $currentCategory = Category::findOrFail($category_id);
        $products = Product::where('category_id', $category_id)->latest()->paginate(12);

        return view('products.index', compact('categories', 'products', 'currentCategory'));
    }

    // 👉 Trang chi tiết sản phẩm
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Tìm kiếm sản phẩm theo tên
        $products = Product::where('name', 'LIKE', "%{$query}%")->get();

        return view('products.search', compact('products', 'query'));
    }
}
