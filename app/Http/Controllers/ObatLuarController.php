<?php

namespace App\Http\Controllers;

use App\Models\ObatLuar;
use Illuminate\Http\Request;

class ObatLuarController extends Controller
{
    public function index()
    {
        $obatLuars = ObatLuar::orderBy('nama_obat')->paginate(50);
        return view('pages.medicine.obat-luar-index', compact('obatLuars'))
            ->with('title', 'Obat Luar');
    }

    public function create()
    {
        return view('obat-luar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'ketentuan' => 'required|string',
            'status' => 'required|boolean'
        ]);

        ObatLuar::create($request->all());

        return redirect()->route('obat-luar.index')
            ->with('success', 'Obat luar berhasil ditambahkan.');
    }

    public function show(ObatLuar $obatLuar)
    {
        return view('obat-luar.show', compact('obatLuar'));
    }

    public function edit(ObatLuar $obatLuar)
    {
        return view('obat-luar.edit', compact('obatLuar'));
    }

    public function update(Request $request, ObatLuar $obatLuar)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'ketentuan' => 'required|string',
            'status' => 'required|boolean'
        ]);

        $obatLuar->update($request->all());

        return redirect()->route('obat-luar.index')
            ->with('success', 'Obat luar berhasil diperbarui.');
    }

    public function destroy(ObatLuar $obatLuar)
    {
        $obatLuar->delete();

        return redirect()->route('obat-luar.index')
            ->with('success', 'Obat luar berhasil dihapus.');
    }
}