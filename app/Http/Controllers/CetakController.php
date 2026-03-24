<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CetakController extends Controller
{
    public function buktiPendaftaran(Pendaftaran $pendaftaran)
    {
        // Verifikasi bahwa user hanya bisa mencetak bukti pendaftarannya sendiri
        if (auth()->id() !== $pendaftaran->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $pdf = Pdf::loadView('cetak.bukti-pendaftaran', compact('pendaftaran'));
        
        return $pdf->download('bukti-pendaftaran-' . $pendaftaran->kode_pendaftaran . '.pdf');
    }

    public function daftarAnggota(Ekstrakurikuler $ekskul)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $anggota = $ekskul->anggota()->with('user')->get();
        
        $pdf = Pdf::loadView('cetak.daftar-anggota', compact('ekskul', 'anggota'));
        
        return $pdf->download('daftar-anggota-' . $ekskul->nama . '.pdf');
    }
}