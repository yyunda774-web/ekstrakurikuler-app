<?php
namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function store($id)
    {
        $user = auth()->user();

        // Cegah daftar dua kali
        if (Pendaftaran::where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Anda sudah mendaftar ekstrakurikuler.');
        }

        Pendaftaran::create([
            'user_id' => $user->id,
            'ekstrakurikuler_id' => $id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Pendaftaran berhasil dikirim.');
    }

    public function cetak()
    {
        $pendaftaran = Pendaftaran::with('ekstrakurikuler')
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('cetak.bukti-pendaftaran', compact('pendaftaran'));
    }
}
