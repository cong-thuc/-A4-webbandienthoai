<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class OrderExportController extends Controller
{
    public function export()
    {
        return Excel::download(new OrdersExport, 'don_hang.xlsx');
    }
}
