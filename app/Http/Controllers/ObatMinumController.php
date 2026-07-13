<?php

namespace App\Http\Controllers;

use App\Models\ObatMinum;
use Illuminate\Http\Request;

class ObatMinumController extends Controller
{
    public function index()
    {
        $obatMinums = ObatMinum::orderBy('nama_obat')->paginate(50); // 10 items per page
        return view('pages.medicine.obat-minum-index', compact('obatMinums'))
            ->with('title', 'Obat Minum');
    }

    public function create()
    {
        return view('obat-minum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'dosis' => 'required|string|max:50',
            'ketentuan' => 'required|string',
            'komposisi' => 'required|string',
            'status' => 'required|boolean'
        ]);

        ObatMinum::create($request->all());

        return redirect()->route('obat-minum.index')
            ->with('success', 'Obat minum berhasil ditambahkan.');
    }

    public function show(ObatMinum $obatMinum)
    {
        return view('obat-minum.show', compact('obatMinum'));
    }

    public function edit(ObatMinum $obatMinum)
    {
        return view('obat-minum.edit', compact('obatMinum'));
    }

    public function update(Request $request, ObatMinum $obatMinum)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'dosis' => 'required|string|max:50',
            'ketentuan' => 'required|string',
            'komposisi' => 'required|string',
            'status' => 'required|boolean'
        ]);

        $obatMinum->update($request->all());

        return redirect()->route('obat-minum.index')
            ->with('success', 'Obat minum berhasil diperbarui.');
    }

    public function destroy(ObatMinum $obatMinum)
    {
        $obatMinum->delete();

        return redirect()->route('obat-minum.index')
            ->with('success', 'Obat minum berhasil dihapus.');
    }
}