<?php

namespace App\Exports\Admin;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Illuminate\Contracts\View\View;

class EmployeeExport implements FromView, WithColumnWidths
{
    use Exportable;

    public function __construct(object $request) {
        $this->order = $request->order;
    }

    public function columnWidths(): array {
        return [
            'A' => 10
        ];
    }

    public function view(): View {
        $rows = User::latest()->get();
        return view('admin.excel.employee', compact('rows'));
    }
}
