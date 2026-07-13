<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\Service;

class AspirasiController extends Controller
{
    public function index()
    {
        return view('pages.aspirasi.user_aspiration', [
            'title' => 'Aspirasi'
        ]);
    }

    public function indexAdmin()
    {
        $aspirasis = Aspirasi::latest()->get();
        $notification = Service::where('status', 'Pending')->get();
        $pendings = $notification;

        return view('pages.aspirasi.admin_aspiration', compact('aspirasis', 'notification', 'pendings'))
            ->with('title', 'Admin - Aspirasi');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'nullable|string|max:255',
            'pesan' => 'required|string',
        ]);

        // Jika nama kosong, set sebagai 'Anonim'
        if (empty($validated['nama']) || trim($validated['nama']) === '') {
            $validated['nama'] = 'Anonim';
        }

        Aspirasi::create($validated);

        return back()->with('success', 'Aspirasi berhasil dikirim. Terima kasih atas partisipasinya!');
    }

    public function show($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        return response()->json([
            'id' => $aspirasi->id,
            'nama' => $aspirasi->nama,
            'pesan' => $aspirasi->pesan,
            'created_at' => $aspirasi->created_at->format('d F Y H:i'),
        ]);
    }

    public function destroy($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->delete();
        
        return response()->json(['success' => 'Aspirasi berhasil dihapus.']);
    }
}