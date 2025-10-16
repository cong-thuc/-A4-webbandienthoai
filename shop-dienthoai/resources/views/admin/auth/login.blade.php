@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card shadow-sm" style="width: 400px;">
                <div class="card-header bg-dark text-white text-center">
                    <h4>Đăng nhập Trang Quản trị</h4>
                </div>
                <div class="card-body p-4">

                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Nhập email của bạn">
                            @error('email')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">Mật khẩu</label>
                            {{-- Bọc input và button trong một div riêng --}}
                            <div class="position-relative">
                                <input id="password" class="form-control pe-5" type="password" name="password" required placeholder="Nhập mật khẩu">
                                
                                <button type="button" id="togglePassword" class="btn border-0 position-absolute top-50 end-0 translate-middle-y">
                                    <i class="fas fa-eye text-secondary"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark">
                                Đăng nhập
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = togglePassword.querySelector('i');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            eyeIcon.classList.toggle('fa-eye');
            eyeIcon.classList.toggle('fa-eye-slash');
        });
    });
</script>
@endsection