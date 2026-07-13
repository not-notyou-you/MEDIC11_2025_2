<?php

namespace App\Imports;

use App\Models\Pasien;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class PasiensImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Pasien([
            'nama' => $row['nama'] ?? $row['Nama'] ?? null,
            'nim' => $row['nim'] ?? $row['NIM'] ?? null,
            'jurusan' => $row['jurusan'] ?? $row['Jurusan'] ?? null,
            'keluhan' => $row['keluhan'] ?? $row['Keluhan'] ?? null,
            'jenis_penanganan' => $row['jenis_penanganan'] ?? $row['Jenis Penanganan'] ?? null,
            'penanganan_obat' => $row['penanganan_obat'] ?? $row['Penanganan Obat'] ?? null,
            'kecelakaan' => $row['kecelakaan'] ?? $row['Kecelakaan'] ?? null,
            'catatan_lanjutan' => $row['catatan_lanjutan'] ?? $row['Catatan Lanjutan'] ?? null,
            'persetujuan' => isset($row['persetujuan']) ? (strtolower($row['persetujuan']) === 'ya' ? true : false) : false,
            'created_at' => isset($row['tanggal_dibuat']) ? Carbon::parse($row['tanggal_dibuat']) : now(),
            'updated_at' => now(),
        ]);
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'keluhan' => 'required|string',
        ];
    }
}