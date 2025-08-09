<?php

namespace App\Exports;

use App\Models\Service;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ServicesExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'ALL' => new ServicesSheet(null),
            'Pendings' => new ServicesSheet('Pending'),
            'On_Progress' => new ServicesSheet('On Progress'),
            'Completed' => new ServicesSheet('Completed'),
            'Canceled' => new ServicesSheet('Canceled'),
        ];
    }
}