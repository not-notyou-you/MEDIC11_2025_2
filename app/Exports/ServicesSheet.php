<?php

namespace App\Exports;

use App\Models\Service;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ServicesSheet implements FromQuery, WithTitle, WithHeadings, WithMapping, WithEvents, WithStyles
{
    protected $status;
    protected $headerColors = [
        'ALL' => '048C6A',          // Hijau tua
        'Pending' => 'F59E0B',      // Kuning
        'On Progress' => '3B82F6',  // Biru
        'Completed' => '10B981',    // Hijau muda
        'Canceled' => 'EF4444'      // Merah
    ];

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function query()
    {
        if ($this->status) {
            return Service::where('status', $this->status);
        }
        return Service::query();
    }

    public function title(): string
    {
        return $this->status ?: 'ALL';
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'NIM',
            'Email',
            'Type',
            'Phone',
            'LINE ID',
            'Organization',
            'Title',
            'Event Name',
            'Description',
            'Date',
            'Start Time',
            'End Time',
            'Location',
            'Person',
            'Medical Equipment',
            'Note',
            'Status',
            'Created At',
            'Updated At',
        ];
    }
    public function map($service): array
    {
        return [
            $service->id,
            $service->name,
            $service->nim,
            $service->email,
            $service->type,
            $service->phone,
            $service->line,
            $service->organization,
            $service->title,
            $service->event_name,
            $service->description,
            $service->date,
            $service->start_time,
            $service->end_time,
            $service->location,
            $service->person,
            $service->medical_equipment ? implode(', ', $service->medical_equipment) : '',
            $service->note,
            $service->status,
            $service->created_at->format('Y-m-d H:i:s'), 
            $service->updated_at->format('Y-m-d H:i:s'),
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Set border for all cells
                $sheet = $event->sheet->getDelegate();
                $lastRow = $sheet->getHighestRow();
                $lastColumn = $sheet->getHighestColumn();
                $cellRange = 'A1:' . $lastColumn . $lastRow;
                
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ];
                
                $sheet->getStyle($cellRange)->applyFromArray($styleArray);
                
                // Auto size all columns
                foreach (range('A', $lastColumn) as $columnID) {
                    $sheet->getColumnDimension($columnID)->setAutoSize(true);
                }
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:U1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => $this->headerColors[$this->status ?: 'ALL']
                ],
            ],
        ]);
    }
}