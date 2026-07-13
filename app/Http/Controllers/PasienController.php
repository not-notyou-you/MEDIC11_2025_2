<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\ObatMinum;
use App\Models\ObatLuar;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PasiensExport; 
use App\Imports\PasiensImport; 

class PasienController extends Controller
{
    public function create()
    {
        $obatMinums = ObatMinum::where('status', true)->orderBy('nama_obat')->get();
        $obatLuars = ObatLuar::where('status', true)->orderBy('nama_obat')->get();
        
        return view('pages.medicine.pasien-create', compact('obatMinums', 'obatLuars'))
            ->with('title', 'Form Pasien');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'nullable|string|max:20',
            'jurusan' => 'nullable|string|max:255',
            'keluhan' => 'required|string',
            'jenis_penanganan' => 'required|in:medis_dasar,p3k',
            'penanganan_obat' => 'nullable|array',
            'kecelakaan' => 'nullable|array',
            'catatan_lanjutan' => 'nullable|string',
            'persetujuan' => 'required|accepted'
        ]);

        // Format jenis penanganan dengan kecelakaan
        $jenisPenangananFormatted = $this->formatJenisPenanganan(
            $request->jenis_penanganan, 
            $request->kecelakaan
        );

        // Format data penanganan obat menjadi string
        $penangananText = $this->formatPenangananObat($request->penanganan_obat);

        Pasien::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'jurusan' => $request->jurusan,
            'keluhan' => $request->keluhan,
            'jenis_penanganan' => $jenisPenangananFormatted, // Format dengan kecelakaan
            'penanganan_obat' => $penangananText,
            'kecelakaan' => $request->kecelakaan ? implode(', ', $request->kecelakaan) : null,
            'catatan_lanjutan' => $request->catatan_lanjutan,
            'persetujuan' => true
        ]);

        return redirect()->route('pasien.create')
            ->with('success', 'Data pasien berhasil disimpan.');
    }

    public function index()
    {
        $pasiens = Pasien::orderBy('created_at', 'desc')->paginate(15); // 10 items per page
        return view('pages.medicine.pasien-index', compact('pasiens'))
            ->with('title', 'Data Pasien');
    }

    public function edit(Pasien $pasien)
    {
        $obatMinums = ObatMinum::where('status', true)->orderBy('nama_obat')->get();
        $obatLuars = ObatLuar::where('status', true)->orderBy('nama_obat')->get();
        
        return view('pages.medicine.pasien-edit', compact('pasien', 'obatMinums', 'obatLuars'))
            ->with('title', 'Edit Data Pasien');
    }

    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'nullable|string|max:20',
            'jurusan' => 'nullable|string|max:255',
            'keluhan' => 'required|string',
            'jenis_penanganan' => 'required|in:medis_dasar,p3k',
            'penanganan_obat' => 'nullable|array',
            'kecelakaan' => 'nullable|array',
            'catatan_lanjutan' => 'nullable|string'
        ]);

        // Format jenis penanganan dengan kecelakaan
        $jenisPenangananFormatted = $this->formatJenisPenanganan(
            $request->jenis_penanganan, 
            $request->kecelakaan
        );

        // Format data penanganan obat menjadi string
        $penangananText = $this->formatPenangananObat($request->penanganan_obat);

        $pasien->update([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'jurusan' => $request->jurusan,
            'keluhan' => $request->keluhan,
            'jenis_penanganan' => $jenisPenangananFormatted,
            'penanganan_obat' => $penangananText,
            'kecelakaan' => $request->kecelakaan ? implode(', ', $request->kecelakaan) : null,
            'catatan_lanjutan' => $request->catatan_lanjutan
        ]);

        return redirect()->route('pasien.index')
            ->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();

        return redirect()->route('pasien.index')
            ->with('success', 'Data pasien berhasil dihapus.');
    }

    public function show(Pasien $pasien)
    {
        return view('pages.medicine.pasien-show', compact('pasien'))
            ->with('title', 'Detail Pasien');
    }

    /**
     * Export data pasien ke Excel
     */
    public function export()
    {
        try {
            return Excel::download(new PasiensExport, 'data-pasien-' . date('Y-m-d') . '.xlsx');
        } catch (\Exception $e) {
            return redirect()->route('pasien.index')
                ->with('error', 'Terjadi kesalahan saat export: ' . $e->getMessage());
        }
    }

    /**
     * Import data pasien dari Excel
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            Excel::import(new PasiensImport, $request->file('file'));
            return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diimport.');
        } catch (\Exception $e) {
            return redirect()->route('pasien.index')->with('error', 'Terjadi kesalahan saat import data: ' . $e->getMessage());
        }
    }

    /**
     * Clear semua data pasien
     */
    public function clear()
    {
        try {
            Pasien::truncate();
            return redirect()->route('pasien.index')->with('success', 'Semua data pasien berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('pasien.index')->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

    /**
     * Format jenis penanganan dengan kecelakaan
     * Format: P3K atau P3K(kecelakaan1,kecelakaan2)
     */
    private function formatJenisPenanganan($jenisPenanganan, $kecelakaan)
    {
        if ($jenisPenanganan === 'p3k' && $kecelakaan && count($kecelakaan) > 0) {
            return 'P3K(' . implode(',', $kecelakaan) . ')';
        }
        
        return $jenisPenanganan === 'medis_dasar' ? 'Medis Dasar' : 'P3K';
    }

    /**
     * Format data penanganan obat menjadi string
     * Format: obat1(jumlah1), obat2(jumlah2), ...
     */
    private function formatPenangananObat($penangananObat)
    {
        if (!$penangananObat) {
            return null;
        }

        $formatted = [];

        // Process obat minum
        if (isset($penangananObat['obat_minum'])) {
            foreach ($penangananObat['obat_minum'] as $item) {
                if (isset($item['obat_id']) && isset($item['jumlah'])) {
                    $obat = ObatMinum::find($item['obat_id']);
                    if ($obat) {
                        $formatted[] = $obat->nama_obat . '(' . $item['jumlah'] . ')';
                    }
                }
            }
        }

        // Process obat luar
        if (isset($penangananObat['obat_luar'])) {
            foreach ($penangananObat['obat_luar'] as $item) {
                if (isset($item['obat_id']) && isset($item['jumlah'])) {
                    $obat = ObatLuar::find($item['obat_id']);
                    if ($obat) {
                        $formatted[] = $obat->nama_obat . '(' . $item['jumlah'] . ')';
                    }
                }
            }
        }

        return implode(', ', $formatted);
    }
}