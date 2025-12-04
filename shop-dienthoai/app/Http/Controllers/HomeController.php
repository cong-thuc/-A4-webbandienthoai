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
    public function checkNotifications()
    {
        $user = auth()->user();
        // Lấy các thông báo chưa đọc
        $notifications = $user->unreadNotifications;

        // Đánh dấu là đã đọc ngay để không hiện lại lần sau
        $user->unreadNotifications->markAsRead();

        return response()->json($notifications);
    }
}
