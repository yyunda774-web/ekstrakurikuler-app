<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use App\Models\Pendaftaran;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
{
    
    $stats = [
        'total_ekskul' => \App\Models\Ekstrakurikuler::count(),
        'total_siswa' => \App\Models\User::where('role', 'siswa')->count(),
        'total_pendaftaran' => \App\Models\Pendaftaran::count(),
        'pendaftaran_pending' => \App\Models\Pendaftaran::where('status', 'pending')->count(),
    ];

    // 🔥 Ambil 5 pendaftaran terbaru untuk dashboard
    $pendaftaranTerbaru = \App\Models\Pendaftaran::with('user', 'ekstrakurikuler')
        ->latest()
        ->take(5)
        ->get();

    return view('admin.dashboard', compact(
        'stats',
        'pendaftaranTerbaru'
    ));
}
}