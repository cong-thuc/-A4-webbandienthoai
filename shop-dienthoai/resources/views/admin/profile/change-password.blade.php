@extends('layouts.admin') 

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Cập Nhật Mật Khẩu</h1>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Đổi Mật Khẩu</h6>
                </div>
                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.profile.password.update') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                            <div class="position-relative">
                                <input type="password" class="form-control pe-5 @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                                <button type="button" class="btn border-0 position-absolute top-50 end-0 translate-middle-y toggle-password-btn" data-target="current_password">
                                    <i class="fas fa-eye text-secondary"></i>
                                </button>
                            </div>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">Mật khẩu mới</label>
                            <div class="position-relative">
                                <input type="password" class="form-control pe-5 @error('new_password') is-invalid @enderror" id="new_password" name="new_password" required>
                                <button type="button" class="btn border-0 position-absolute top-50 end-0 translate-middle-y toggle-password-btn" data-target="new_password">
                                    <i class="fas fa-eye text-secondary"></i>
                                </button>
                            </div>
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                            <div class="position-relative">
                                <input type="password" class="form-control pe-5" id="new_password_confirmation" name="new_password_confirmation" required>
                                <button type="button" class="btn border-0 position-absolute top-50 end-0 translate-middle-y toggle-password-btn" data-target="new_password_confirmation">
                                    <i class="fas fa-eye text-secondary"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
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
        // Lấy tất cả các nút có class 'toggle-password-btn'
        const toggleButtons = document.querySelectorAll('.toggle-password-btn');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Lấy ID của input mục tiêu từ thuộc tính 'data-target'
                const targetInputId = this.dataset.target;
                const passwordInput = document.getElementById(targetInputId);
                const eyeIcon = this.querySelector('i');

                // Thay đổi loại của input từ password sang text và ngược lại
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                // Đổi icon con mắt
                eyeIcon.classList.toggle('fa-eye');
                eyeIcon.classList.toggle('fa-eye-slash');
            });
        });
    });
</script>
@endsection