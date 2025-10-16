@extends('layouts.admin')

@section('content')  
    {{-- Thêm bảng tài khoản người dùng --}}
    <div class="card shadow-lg">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Quản lý tài khoản khách hàng</h3>
            <span class="badge bg-white text-info">{{ count($users) }} tài khoản</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3">#</th>
                            <th class="py-3">Tên</th>
                            <th class="py-3">Email</th>
                            <th class="py-3">Trạng thái</th>
                            <th class="py-3 text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                            <tr>
                                <td class="align-middle">{{ $index + 1 }}</td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-info rounded-circle text-white d-flex align-items-center justify-content-center me-3">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <span>{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="align-middle">{{ $user->email }}</td>
                                <td class="align-middle">
                                    <span class="badge rounded-pill py-2 px-3 {{ $user->is_active ? 'bg-success' : 'bg-danger' }}">
                                        <i class="fas {{ $user->is_active ? 'fa-check-circle' : 'fa-lock' }} me-1"></i>
                                        {{ $user->is_active ? 'Đang hoạt động' : 'Bị khóa' }}
                                    </span>
                                </td>
                                <td class="align-middle text-center">
                                    <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="is_active" value="{{ $user->is_active ? 0 : 1 }}">
                                        <button class="btn btn-sm {{ $user->is_active ? 'btn-outline-danger' : 'btn-outline-success' }}">
                                            <i class="fas {{ $user->is_active ? 'fa-lock' : 'fa-unlock' }} me-1"></i>
                                            {{ $user->is_active ? 'Khóa' : 'Mở khóa' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>

<style>
    .avatar-sm {
        width: 36px;
        height: 36px;
        font-weight: 600;
    }
    .card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
    }
    .card-header {
        border-radius: 0 !important;
    }
    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    .badge {
        font-weight: 500;
    }
</style>
@endsection