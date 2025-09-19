<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Hiển thị trang thông tin tài khoản
     */
    public function index()
    {
        $user = Auth::user();
        return view('account.index', compact('user'));
    }
}
