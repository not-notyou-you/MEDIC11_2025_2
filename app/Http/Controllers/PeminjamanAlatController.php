<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanAlat;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PeminjamanAlatExport;
use App\Imports\PeminjamanAlatImport;

class PeminjamanAlatController extends Controller
{
    public function index()
    {
        $peminjamanAlats = PeminjamanAlat::orderBy('created_at', 'desc')->paginate(10);
        return view('pages.medicine.peminjaman-alat-index', compact('peminjamanAlats'))
            ->with('title', 'Peminjaman Alat');
    }

    public function create()
    {
        return view('peminjaman-alat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email_nomor_hp' => 'required|string|max:255',
            'nama_peminjam' => 'required|string|max:255',
            'nim_peminjam' => 'required|string|max:20',
            'barang_dipinjam' => 'required|string|max:255',
            'lama_peminjaman' => 'required|integer|min:1',
            'status' => 'required|boolean',
            'catatan_tambahan' => 'nullable|string'
        ]);

        // Handle other barang input
        $barangDipinjam = $request->barang_dipinjam;
        if ($barangDipinjam === 'OTHER' && $request->has('other_barang')) {
            $barangDipinjam = $request->other_barang;
        }

        PeminjamanAlat::create([
            'email_nomor_hp' => $request->email_nomor_hp,
            'nama_peminjam' => $request->nama_peminjam,
            'nim_peminjam' => $request->nim_peminjam,
            'barang_dipinjam' => $barangDipinjam,
            'lama_peminjaman' => $request->lama_peminjaman,
            'status' => $request->status,
            'catatan_tambahan' => $request->catatan_tambahan,
        ]);

        return redirect()->route('peminjaman-alat.index')
            ->with('success', 'Data peminjaman berhasil ditambahkan.');
    }

    public function show(PeminjamanAlat $peminjamanAlat)
    {
        return view('peminjaman-alat.show', compact('peminjamanAlat'));
    }

    public function edit(PeminjamanAlat $peminjamanAlat)
    {
        return view('peminjaman-alat.edit', compact('peminjamanAlat'));
    }

    public function update(Request $request, PeminjamanAlat $peminjamanAlat)
    {
        $request->validate([
            'email_nomor_hp' => 'required|string|max:255',
            'nama_peminjam' => 'required|string|max:255',
            'nim_peminjam' => 'required|string|max:20',
            'barang_dipinjam' => 'required|string|max:255',
            'lama_peminjaman' => 'required|integer|min:1',
            'status' => 'required|boolean',
            'catatan_tambahan' => 'nullable|string'
        ]);

        // Handle other barang input
        $barangDipinjam = $request->barang_dipinjam;
        if ($barangDipinjam === 'OTHER' && $request->has('other_barang')) {
            $barangDipinjam = $request->other_barang;
        }

        $peminjamanAlat->update([
            'email_nomor_hp' => $request->email_nomor_hp,
            'nama_peminjam' => $request->nama_peminjam,
            'nim_peminjam' => $request->nim_peminjam,
            'barang_dipinjam' => $barangDipinjam,
            'lama_peminjaman' => $request->lama_peminjaman,
            'status' => $request->status,
            'catatan_tambahan' => $request->catatan_tambahan,
        ]);

        return redirect()->route('peminjaman-alat.index')
            ->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function destroy(PeminjamanAlat $peminjamanAlat)
    {
        $peminjamanAlat->delete();

        return redirect()->route('peminjaman-alat.index')
            ->with('success', 'Data peminjaman berhasil dihapus.');
    }

    /**
     * Export data peminjaman alat ke Excel
     */
    public function export()
    {
        try {
            return Excel::download(new PeminjamanAlatExport, 'data-peminjaman-alat-' . date('Y-m-d') . '.xlsx');
        } catch (\Exception $e) {
            return redirect()->route('peminjaman-alat.index')
                ->with('error', 'Terjadi kesalahan saat export: ' . $e->getMessage());
        }
    }

    /**
     * Import data peminjaman alat dari Excel
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            Excel::import(new PeminjamanAlatImport, $request->file('file'));
            return redirect()->route('peminjaman-alat.index')->with('success', 'Data peminjaman alat berhasil diimport.');
        } catch (\Exception $e) {
            return redirect()->route('peminjaman-alat.index')->with('error', 'Terjadi kesalahan saat import data: ' . $e->getMessage());
        }
    }

    /**
     * Clear semua data peminjaman alat
     */
    public function clear()
    {
        try {
            PeminjamanAlat::truncate();
            return redirect()->route('peminjaman-alat.index')->with('success', 'Semua data peminjaman alat berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('peminjaman-alat.index')->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}