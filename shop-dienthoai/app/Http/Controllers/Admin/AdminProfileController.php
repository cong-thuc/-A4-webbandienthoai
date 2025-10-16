<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    /**
     * Hiển thị form thay đổi mật khẩu.
     */
    public function editPassword()
    {
        return view('admin.profile.change-password');
    }

    /**
     * Cập nhật mật khẩu mới.
     */
    public function updatePassword(Request $request)
    {
        # 1. Validation (Kiểm tra dữ liệu)
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed', // 'confirmed' sẽ tự động kiểm tra với new_password_confirmation
        ], [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
            'new_password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
        ]);

        # 2. Kiểm tra mật khẩu hiện tại có đúng không
        $admin = Auth::user();
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác.']);
        }

        # 3. Cập nhật mật khẩu mới (đã được mã hóa)
        $admin->password = Hash::make($request->new_password);
        $admin->save();

        # 4. Trả về thông báo thành công
        return back()->with('success', 'Đổi mật khẩu thành công!');
    }
}