@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">
            <i class="fas fa-list me-2"></i> Danh sách Danh mục
        </h4>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-1"></i> Thêm danh mục
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%" class="py-3">#</th>
                            <th class="py-3">Tên danh mục</th>
                            <th width="20%" class="py-3 text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $index => $category)
                            <tr class="align-middle">
                                <td class="fw-semibold">{{ $index + 1 }}</td>
                                <td class="fw-semibold">{{ $category->name }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" 
                                           class="btn btn-sm btn-warning px-3 rounded-pill">
                                            <i class="fas fa-edit me-1"></i> Sửa
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" 
                                              method="POST" 
                                              class="d-inline" 
                                              onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger px-3 rounded-pill">
                                                <i class="fas fa-trash-alt me-1"></i> Xóa
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-list-alt fa-2x text-muted mb-2"></i>
                                        <span class="text-muted">Không có danh mục nào</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection