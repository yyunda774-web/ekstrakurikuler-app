<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Ekstrakurikuler;
use App\Models\Pendaftaran;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PendaftaranController;
use App\Http\Controllers\Siswa\DashboardController;


/*
|--------------------------------------------------------------------------
| HALAMAN DEPAN
|--------------------------------------------------------------------------
*/
Route::get('/', function () {

    if (auth()->check()) {

        if(auth()->user()->role === 'admin'){
            return redirect()->route('admin.dashboard');
        }

        if(auth()->user()->role === 'pembina'){
            return redirect()->route('pembina.dashboard');
        }

        return redirect()->route('dashboard');
    }

    $ekskul = Ekstrakurikuler::orderBy('nama')->get();
    return view('welcome', compact('ekskul'));

})->name('home');


/*
|--------------------------------------------------------------------------
| ROUTE SISWA (LOGIN / PENGURUS)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Route untuk cetak bukti pendaftaran
    Route::get('/pendaftaran/{id}/cetak', [PendaftaranController::class, 'cetakBukti'])
        ->name('cetak.bukti');


    // Route untuk membatalkan pendaftaran siswa
    Route::delete('/pendaftaran/{id}/cancel', [PendaftaranController::class, 'cancel'])
        ->name('pendaftaran.cancel');


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD SISWA
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', function () {

        // TAMBAHAN KEAMANAN
        if(auth()->user()->role !== 'siswa'){
            abort(403);
        }

        $pendaftaran = Pendaftaran::with('ekstrakurikuler.kategori')
            ->latest()
            ->paginate(10);

        $allPendaftaran = Pendaftaran::with('ekstrakurikuler')
            ->get();

        $ekskul = Ekstrakurikuler::orderBy('nama')->get();

        // DATA KELOMPOK PER EKSKUL
        $kelompokEkskul = Pendaftaran::with('ekstrakurikuler')
            ->where('status','diterima')
            ->get()
            ->groupBy(function ($item) {
                return $item->ekstrakurikuler->nama;
            });

        return view('dashboard', compact(
            'pendaftaran',
            'allPendaftaran',
            'ekskul',
            'kelompokEkskul'
        ));

    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | EXPORT DATA
    |--------------------------------------------------------------------------
    */
    Route::get('/export/excel/{ekskul}', [PendaftaranController::class,'exportExcel'])
        ->name('ekskul.export.excel');

    Route::get('/export/word/{ekskul}', [PendaftaranController::class,'exportWord'])
        ->name('ekskul.export.word');

    Route::get('/export/pdf/{ekskul}', [PendaftaranController::class,'exportPdf'])
        ->name('ekskul.export.pdf');


    /*
    |--------------------------------------------------------------------------
    | PENDAFTARAN SISWA (LOGIN)
    |--------------------------------------------------------------------------
    */
    Route::post('/pendaftaran', function (Request $request) {

        $request->validate([
            'ekstrakurikuler_id' => 'required|exists:ekstrakurikulers,id',
        ]);

        $ekskul = Ekstrakurikuler::findOrFail($request->ekstrakurikuler_id);

        $sudahDaftar = Pendaftaran::where('user_id', auth()->id())
            ->where('ekstrakurikuler_id', $request->ekstrakurikuler_id)
            ->exists();

        if ($sudahDaftar) {
            return back()->with('error', 'Anda sudah mendaftar ekstrakurikuler ini.');
        }

        $pendaftarCount = Pendaftaran::where('ekstrakurikuler_id', $request->ekstrakurikuler_id)
            ->where('status', '!=', 'ditolak')
            ->count();

        if ($ekskul->kuota && $pendaftarCount >= $ekskul->kuota) {
            return back()->with('error', 'Kuota penuh.');
        }

        Pendaftaran::create([
            'user_id' => auth()->id(),
            'nama' => auth()->user()->name,
            'kelas' => auth()->user()->kelas ?? '-',
            'no_hp' => auth()->user()->no_hp ?? '-',
            'ekstrakurikuler_id' => $request->ekstrakurikuler_id,
            'kode_pendaftaran' => 'USER-' . strtoupper(Str::random(8)),
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Berhasil mendaftar!');

    })->name('pendaftaran.store');


    /* 
    |--------------------------------------------------------------------------
    | DETAIL PENDAFTARAN SISWA
    |--------------------------------------------------------------------------
    */
    Route::get('/pendaftaran/{id}', function ($id) {

        $pendaftaran = Pendaftaran::with('ekstrakurikuler')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('pendaftaran-show', compact('pendaftaran'));

    })->name('pendaftaran.show');


    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| CEK STATUS SISWA (TANPA LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/cek-status', function () {
    return view('cek-status');
})->name('cek-status');


Route::get('/cek-status-hasil', function (Request $request) {

    $pendaftaran = Pendaftaran::where('kode_pendaftaran', $request->kode)
        ->with('ekstrakurikuler')
        ->first();

    return view('cek-status-hasil', compact('pendaftaran'));

});


/*
|--------------------------------------------------------------------------
| PENDAFTARAN UMUM (TANPA LOGIN)
|--------------------------------------------------------------------------
*/
Route::post('/pendaftaran-umum', function (Request $request) {

    $request->validate([
        'nama' => 'required|string|max:100',
        'kelas' => 'required|string|max:20',
        'no_hp' => 'required|string|max:15|regex:/^[0-9]+$/',
        'ekstrakurikuler_id' => 'required|exists:ekstrakurikulers,id',
    ]);

    $ekskul = Ekstrakurikuler::findOrFail($request->ekstrakurikuler_id);

    $pendaftarCount = Pendaftaran::where('ekstrakurikuler_id', $request->ekstrakurikuler_id)
        ->where('status', '!=', 'ditolak')
        ->count();

    if ($ekskul->kuota && $pendaftarCount >= $ekskul->kuota) {
        return back()->with('error', 'Kuota penuh.');
    }

    $pendaftaran = Pendaftaran::create([
        'nama' => $request->nama,
        'kelas' => $request->kelas,
        'no_hp' => $request->no_hp,
        'ekstrakurikuler_id' => $request->ekstrakurikuler_id,
        'kode_pendaftaran' => 'REG-' . strtoupper(Str::random(8)),
        'status' => 'pending',
    ]);

    return redirect()->route('pendaftaran.sukses', $pendaftaran->kode_pendaftaran);

})->name('pendaftaran.umum');


Route::get('/pendaftaran-sukses/{kode}', function ($kode) {

    $pendaftaran = Pendaftaran::where('kode_pendaftaran', $kode)
        ->with('ekstrakurikuler')
        ->firstOrFail();

    return view('pendaftaran-sukses', compact('pendaftaran'));

})->name('pendaftaran.sukses');


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/pembina.php';
