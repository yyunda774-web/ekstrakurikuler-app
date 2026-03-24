<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;
use App\Models\Ekstrakurikuler;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Semua pendaftaran siswa (untuk tabel + statistik)
        $pendaftaran = Pendaftaran::with('ekstrakurikuler.kategori')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        // Semua ekskul tersedia
        $ekskul = Ekstrakurikuler::all();

        // Semua pendaftaran user (untuk cek sudah daftar)
        $allPendaftaran = Pendaftaran::where('user_id', $user->id)->get();

        return view('siswa.dashboard', compact(
            'pendaftaran',
            'ekskul',
            'allPendaftaran'
        ));
    }
}