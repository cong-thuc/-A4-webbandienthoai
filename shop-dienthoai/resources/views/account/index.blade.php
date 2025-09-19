{{-- resources/views/account/index.blade.php --}}
@extends('layouts.customer')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-primary text-white rounded-top-4">
                <h4 class="mb-0"><i class="fas fa-user-circle"></i> Thông tin tài khoản</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Họ và tên:</strong>
                    <p class="mb-0">{{ $user->name }}</p>
                </div>

                <div class="mb-3">
                    <strong>Email:</strong>
                    <p class="mb-0">{{ $user->email }}</p>
                </div>

                <div class="mb-3">
                    <strong>Vai trò:</strong>
                    <p class="mb-0">{{ ucfirst($user->role) }}</p>
                </div>

                <div class="mb-3">
                    <strong>Ngày tạo tài khoản:</strong>
                    <p class="mb-0">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                </div>

                <div class="mt-4">
                    <a href="{{ route('orders.index') }}" class="btn btn-outline-primary rounded-pill">
                        <i class="fas fa-box"></i> Xem đơn hàng của tôi
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
