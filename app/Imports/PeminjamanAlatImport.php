<?php

namespace App\Imports;

use App\Models\PeminjamanAlat;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;

class PeminjamanAlatImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Handle berbagai format nama kolom
        $emailNomorHp = $row['email_nomor_hp'] ?? $row['emailnomor_hp'] ?? $row['Email/Nomor HP'] ?? null;
        $namaPeminjam = $row['nama_peminjam'] ?? $row['nama_peminjam'] ?? $row['Nama Peminjam'] ?? null;
        $nimPeminjam = $row['nim_peminjam'] ?? $row['nim_peminjam'] ?? $row['NIM Peminjam'] ?? null;
        $barangDipinjam = $row['barang_dipinjam'] ?? $row['barang_dipinjam'] ?? $row['Barang Dipinjam'] ?? null;
        $lamaPeminjaman = $row['lama_peminjaman'] ?? $row['lama_peminjaman_hari'] ?? $row['Lama Peminjaman (hari)'] ?? null;
        $status = $row['status'] ?? $row['Status'] ?? null;
        $catatanTambahan = $row['catatan_tambahan'] ?? $row['catatan_tambahan'] ?? $row['Catatan Tambahan'] ?? null;

        // Convert status dari teks ke boolean
        $statusBoolean = $this->convertStatus($status);

        return new PeminjamanAlat([
            'email_nomor_hp' => $emailNomorHp,
            'nama_peminjam' => $namaPeminjam,
            'nim_peminjam' => $nimPeminjam,
            'barang_dipinjam' => $barangDipinjam,
            'lama_peminjaman' => (int) $lamaPeminjaman,
            'status' => $statusBoolean,
            'catatan_tambahan' => $catatanTambahan,
            'created_at' => isset($row['tanggal_dibuat']) ? Carbon::parse($row['tanggal_dibuat']) : now(),
            'updated_at' => now(),
        ]);
    }

    private function convertStatus($status)
    {
        if (is_bool($status)) {
            return $status;
        }

        if (is_numeric($status)) {
            return (bool) $status;
        }

        $status = strtolower(trim($status));
        
        $trueValues = ['sudah', 'sudah dikembalikan', 'true', '1', 'yes', 'y', 'completed', 'done'];
        $falseValues = ['belum', 'masih dipinjam', 'false', '0', 'no', 'n', 'pending', 'not done'];

        if (in_array($status, $trueValues)) {
            return true;
        }

        if (in_array($status, $falseValues)) {
            return false;
        }

        return false; // Default value
    }

    public function rules(): array
    {
        return [
            '*.email_nomor_hp' => 'required|string|max:255',
            '*.nama_peminjam' => 'required|string|max:255',
            '*.nim_peminjam' => 'required|string|max:20',
            '*.barang_dipinjam' => 'required|string|max:255',
            '*.lama_peminjaman' => 'required|integer|min:1',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.email_nomor_hp.required' => 'Email/Nomor HP harus diisi',
            '*.nama_peminjam.required' => 'Nama Peminjam harus diisi',
            '*.nim_peminjam.required' => 'NIM Peminjam harus diisi',
            '*.barang_dipinjam.required' => 'Barang Dipinjam harus diisi',
            '*.lama_peminjaman.required' => 'Lama Peminjaman harus diisi',
            '*.lama_peminjaman.integer' => 'Lama Peminjaman harus berupa angka',
            '*.lama_peminjaman.min' => 'Lama Peminjaman minimal 1 hari',
        ];
    }
}