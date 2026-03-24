<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

public function index(Request $request)
{
    $ekskul = Ekstrakurikuler::where('pembina_id', auth()->id())->first();

    $pendaftarans = collect();

    if ($ekskul) {

        $query = Pendaftaran::with('ekstrakurikuler','user')
            ->where('ekstrakurikuler_id', $ekskul->id);

        // 🔍 FILTER STATUS
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // 🔎 SEARCH NAMA / KELAS
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('kelas', 'like', '%' . $request->search . '%');
            });
        }

        // 🔥 PAGINATION (GANTI get() → paginate())
        $pendaftarans = $query->latest()->paginate(10);
    }

    return view('pembina.dashboard', compact('pendaftarans','ekskul'));
}

public function terima($id)
{

$pendaftaran = Pendaftaran::findOrFail($id);

if(!$pendaftaran->ekstrakurikuler || $pendaftaran->ekstrakurikuler->pembina_id != auth()->id()){
abort(403);
}

$pendaftaran->update([
'status' => 'diterima'
]);

return back();

}

public function tolak($id)
{

$pendaftaran = Pendaftaran::findOrFail($id);

if(!$pendaftaran->ekstrakurikuler || $pendaftaran->ekstrakurikuler->pembina_id != auth()->id()){
abort(403);
}

$pendaftaran->update([
'status' => 'ditolak'
]);

return back();

}

}