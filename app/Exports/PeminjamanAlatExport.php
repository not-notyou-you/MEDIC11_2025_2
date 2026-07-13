<?php

namespace App\Exports;

use App\Models\PeminjamanAlat;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PeminjamanAlatExport implements FromQuery, WithHeadings, WithMapping, WithStyles
{
    public function query()
    {
        return PeminjamanAlat::orderBy('created_at', 'desc');
    }

    public function headings(): array
    {
        return [
            'ID',
            'Email/Nomor HP',
            'Nama Peminjam',
            'NIM Peminjam',
            'Barang Dipinjam',
            'Lama Peminjaman (hari)',
            'Status',
            'Catatan Tambahan',
            'Tanggal Dibuat',
            'Tanggal Diupdate'
        ];
    }

    public function map($peminjaman): array
    {
        return [
            $peminjaman->id,
            $peminjaman->email_nomor_hp,
            $peminjaman->nama_peminjam,
            $peminjaman->nim_peminjam,
            $peminjaman->barang_dipinjam,
            $peminjaman->lama_peminjaman,
            $peminjaman->status ? 'Sudah Dikembalikan' : 'Masih Dipinjam',
            $peminjaman->catatan_tambahan ?? '-',
            $peminjaman->created_at->format('Y-m-d H:i:s'),
            $peminjaman->updated_at->format('Y-m-d H:i:s'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style untuk header
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '048C6A'],
                ],
            ],
        ];
    }
}