<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Ekstrakurikuler;
use App\Models\Pendaftaran;
use App\Http\Controllers\Admin\PendaftaranController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MappingController;

/*
|--------------------------------------------------------------------------
| GROUP ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // DASHBOARD ADMIN
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

    // RESOURCE SISWA
    Route::resource('siswa', SiswaController::class);

    // RESOURCE PENDAFTARAN
    Route::resource('pendaftaran', PendaftaranController::class);
    Route::patch('pendaftaran/{id}/terima', [PendaftaranController::class,'terima'])->name('pendaftaran.terima');
    Route::patch('pendaftaran/{id}/tolak', [PendaftaranController::class,'tolak'])->name('pendaftaran.tolak');
    Route::patch('pendaftaran/{id}/reset', [PendaftaranController::class,'reset'])->name('pendaftaran.reset');

    // EXPORT DATA PENDAFTARAN
    Route::get('pendaftaran/export', [PendaftaranController::class,'export'])->name('pendaftaran.export');

    // EKSTRAKURIKULER
    Route::get('ekstrakurikuler', function() {
        $ekskul = Ekstrakurikuler::latest()->get();
        return view('admin.ekstrakurikuler.index', compact('ekskul'));
    })->name('ekstrakurikuler.index');

    Route::get('ekstrakurikuler/create', fn() => view('admin.ekstrakurikuler.create'))->name('ekstrakurikuler.create');

    Route::post('ekstrakurikuler', function(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:100',
            'kuota' => 'nullable|integer|min:1',
            'deskripsi' => 'nullable|string',
        ]);

        Ekstrakurikuler::create([
            'nama' => $request->nama,
            'kuota' => $request->kuota,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.ekstrakurikuler.index')
            ->with('success','Berhasil ditambahkan.');
    })->name('ekstrakurikuler.store');


    Route::get('/mapping', [MappingController::class, 'index'])
       ->name('mapping');

    Route::get('/mapping/{id}/edit', [MappingController::class, 'edit'])
       ->name('mapping.edit');

    Route::put('/mapping/{id}', [MappingController::class, 'update'])
       ->name('mapping.update');


   // STATISTIK ADMIN
Route::get('/statistik', function () {

    // Semua ekskul + jumlah pendaftar + relasi
    $total_per_ekskul = Ekstrakurikuler::withCount('pendaftarans')
        ->with('pendaftarans')
        ->get();

    // Top 5 ekskul
    $top_ekskul = $total_per_ekskul
        ->sortByDesc('pendaftarans_count')
        ->take(5);

    // Distribusi status
    $status_distribution = Pendaftaran::select('status')
        ->selectRaw('count(*) as total')
        ->groupBy('status')
        ->get();

    $stats = [
        'jumlah_siswa' => User::where('role', 'siswa')->count(),
        'jumlah_ekskul' => Ekstrakurikuler::count(),
        'jumlah_pendaftaran' => Pendaftaran::count(),
        'status_distribution' => $status_distribution,
        'total_per_ekskul' => $total_per_ekskul,
        'top_ekskul' => $top_ekskul,
        'pendaftaran_per_hari' => collect(), // sementara
    ];

    return view('admin.statistik', compact('stats'));
})
->name('statistik');


    // LAPORAN PENDAFTARAN
    Route::get('/laporan', function() {
        $pendaftaran = Pendaftaran::with('user','ekstrakurikuler')->latest()->get();
        return view('admin.laporan', compact('pendaftaran'));
    })->name('laporan');
});