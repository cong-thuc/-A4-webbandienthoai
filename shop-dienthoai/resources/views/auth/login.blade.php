@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm" style="width: 450px;">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Đăng nhập tài khoản</h4>
                </div>
                <div class="card-body p-4">
                    @if (session('status'))
                        <div class="alert alert-success mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input id="password" class="form-control" type="password" name="password" required>
                            @error('password')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                <label for="remember_me" class="form-check-label">Ghi nhớ đăng nhập</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none" href="{{ route('password.request') }}">
                                    Quên mật khẩu?
                                </a>
                            @endif
                        </div>

                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-primary px-5">
                                Đăng nhập
                            </button>
                        </div>
                    </form>
                    
                    <div class="text-center my-3">
                        <span class="text-muted">HOẶC</span>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('auth.google') }}" class="btn btn-danger">
                            <i class="fab fa-google me-2"></i>
                            Đăng nhập bằng Google
                        </a>
                    </div>

                    </div>
            </div>
        </div>
    </div>
</div>
@endsection