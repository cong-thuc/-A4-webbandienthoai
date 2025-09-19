<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Order::select('id', 'name', 'phone', 'address', 'status', 'created_at')->get();
    }

    public function headings(): array
    {
        return [
            'Mã đơn',
            'Tên khách hàng',
            'Số điện thoại',
            'Địa chỉ',
            'Trạng thái',
            'Ngày đặt hàng',
        ];
    }
}
