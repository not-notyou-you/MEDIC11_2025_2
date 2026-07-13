<?php

namespace App\Exports;

use App\Models\Pasien;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PasiensExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Pasien::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'NIM',
            'Jurusan',
            'Keluhan',
            'Jenis Penanganan',
            'Penanganan Obat',
            'Kecelakaan',
            'Catatan Lanjutan',
            'Persetujuan',
            'Tanggal Dibuat',
            'Tanggal Diupdate'
        ];
    }

    public function map($pasien): array
    {
        return [
            $pasien->id,
            $pasien->nama,
            $pasien->nim,
            $pasien->jurusan,
            $pasien->keluhan,
            $pasien->jenis_penanganan,
            $pasien->penanganan_obat,
            $pasien->kecelakaan,
            $pasien->catatan_lanjutan,
            $pasien->persetujuan ? 'Ya' : 'Tidak',
            $pasien->created_at->format('Y-m-d H:i:s'),
            $pasien->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}