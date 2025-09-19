<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Hiển thị danh sách tài khoản (trừ admin)
    public function index()
    {
        $users = User::where('role', 'customer')->get();
        $admins = User::where('role', 'admin')->get();

        return view('admin.users.index', compact('users', 'admins'));
    }

    // Cập nhật trạng thái hoạt động (active hoặc khóa)
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->is_active = $request->input('is_active');
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Cập nhật trạng thái tài khoản thành công!');
    }


}

