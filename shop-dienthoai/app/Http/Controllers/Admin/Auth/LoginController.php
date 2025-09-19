<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Hiển thị form login Admin
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Xử lý login Admin
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // 🔒 Kiểm tra nếu tài khoản bị khóa
        if (!$user->is_active) {
            Auth::logout(); // bắt buộc logout lại ngay lập tức
            return back()->withErrors([
                'email' => 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ Admin.',
            ]);
        }

        // ✅ Nếu là Admin thì cho đăng nhập
        if ($user->role === 'admin') {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        } else {
            Auth::logout(); // Không phải admin thì không cho đăng nhập
            return redirect()->route('admin.login')->withErrors([
                'email' => 'Bạn không có quyền truy cập trang quản trị.',
            ]);
        }
    }

    return back()->withErrors([
        'email' => 'Thông tin đăng nhập không chính xác.',
    ]);
}
}
