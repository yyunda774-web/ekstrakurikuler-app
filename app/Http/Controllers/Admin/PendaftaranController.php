<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Ekstrakurikuler;
use App\Exports\EkskulExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;

class PendaftaranController extends Controller
{
    /**
     * Tampilkan daftar pendaftaran
     */
    public function index()
{
    $pendaftarans = Pendaftaran::with('ekstrakurikuler')
        ->latest()
        ->paginate(10);

    return view('admin.pendaftaran.index', compact('pendaftarans'));
}

    /**
     * Update status pendaftaran
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak,pending',
            'keterangan' => 'nullable|string|max:500',
        ]);

        $pendaftaran = Pendaftaran::with('ekstrakurikuler')->findOrFail($id);

        // Cek kuota jika diterima
        if ($request->status === 'diterima' && $pendaftaran->ekstrakurikuler) {
            $ekskul = $pendaftaran->ekstrakurikuler;

            if (!is_null($ekskul->kuota)) {
                $jumlah = Pendaftaran::where('ekstrakurikuler_id', $ekskul->id)
                    ->where('status', 'diterima')
                    ->count();

                if ($jumlah >= $ekskul->kuota) {
                    return back()->with('error', 'Kuota ekstrakurikuler sudah penuh!');
                }
            }
        }

        $pendaftaran->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'tanggal_verifikasi' => $request->status === 'pending' ? null : now(),
            'admin_id' => $request->status === 'pending' ? null : auth()->id(),
        ]);

        return back()->with('success', 'Status pendaftaran berhasil diperbarui');
    }

    public function export()
{
    $data = Pendaftaran::with('ekstrakurikuler')->get();

    return response()->json($data);
}

public function destroy($id)
{
    $pendaftaran = Pendaftaran::findOrFail($id);
    $pendaftaran->delete();

    return redirect()
        ->route('admin.pendaftaran.index')
        ->with('success', 'Data pendaftaran berhasil dihapus.');
}
    /**
     * Terima pendaftaran
     */
    public function terima($id)
    {
        $pendaftaran = Pendaftaran::with('ekstrakurikuler')->findOrFail($id);

        if ($pendaftaran->ekstrakurikuler && !is_null($pendaftaran->ekstrakurikuler->kuota)) {
            $jumlah = Pendaftaran::where('ekstrakurikuler_id', $pendaftaran->ekstrakurikuler->id)
                ->where('status', 'diterima')
                ->count();

            if ($jumlah >= $pendaftaran->ekstrakurikuler->kuota) {
                return back()->with('error', 'Kuota ekstrakurikuler sudah penuh!');
            }
        }

        $pendaftaran->update([
            'status' => 'diterima',
            'tanggal_verifikasi' => now(),
            'admin_id' => auth()->id(),
        ]);

        return back()->with('success', 'Pendaftaran berhasil diterima');
    }

    /**
     * Tolak pendaftaran
     */
    public function tolak($id)
    {
        Pendaftaran::findOrFail($id)->update([
            'status' => 'ditolak',
            'tanggal_verifikasi' => now(),
            'admin_id' => auth()->id(),
        ]);

        return back()->with('success', 'Pendaftaran berhasil ditolak');
    }

    /**
     * Reset ke pending
     */
    public function reset($id)
    {
        Pendaftaran::findOrFail($id)->update([
            'status' => 'pending',
            'tanggal_verifikasi' => null,
            'admin_id' => null,
            'keterangan' => null,
        ]);

        return back()->with('success', 'Status dikembalikan ke pending');
    }

    public function show($id)
{
    $pendaftaran = Pendaftaran::with('ekstrakurikuler', 'user')
        ->findOrFail($id);

    return view('admin.pendaftaran.show', compact('pendaftaran'));
}

public function cancel($id)
{
    $pendaftaran = \App\Models\Pendaftaran::where('user_id', auth()->id())
        ->findOrFail($id);

    // Hanya bisa membatalkan jika status masih pending
    if($pendaftaran->status !== 'pending'){
        return back()->with('error', 'Pendaftaran tidak bisa dibatalkan.');
    }

    $pendaftaran->delete(); // hapus pendaftaran

    return redirect()->route('dashboard')->with('success', 'Pendaftaran berhasil dibatalkan.');
}

public function edit($id)
{
    $pendaftaran = Pendaftaran::findOrFail($id);
    $ekstrakurikuler = Ekstrakurikuler::orderBy('nama')->get();

 
    return view('admin.pendaftaran.edit', compact('pendaftaran', 'ekstrakurikuler'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'kelas' => 'required|string|max:50',
        'no_hp' => 'required|string|max:20',
        'ekstrakurikuler_id' => 'required|exists:ekstrakurikulers,id',
        'status' => 'required|in:pending,diterima,ditolak',
        'catatan' => 'nullable|string',
    ]);

    $pendaftaran = Pendaftaran::findOrFail($id);
    $pendaftaran->update($request->all());

    return redirect()
        ->route('admin.pendaftaran.index')
        ->with('success', 'Data pendaftaran berhasil diperbarui');
}

/**
 * Form tambah pendaftaran (admin)
 */
public function create()
{
    $ekstrakurikuler = Ekstrakurikuler::orderBy('nama')->get();

    return view('admin.pendaftaran.create', compact('ekstrakurikuler'));
}

public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'kelas' => 'required|string|max:50',
        'no_hp' => 'required|string|max:20',
        'ekstrakurikuler_id' => 'required|exists:ekstrakurikulers,id',
        'status' => 'required|in:pending,diterima,ditolak',
        'catatan' => 'nullable|string|max:500',
    ]);

    Pendaftaran::create([
        'nama' => $request->nama,
        'kelas' => $request->kelas,
        'no_hp' => $request->no_hp,
        'ekstrakurikuler_id' => $request->ekstrakurikuler_id,
        'kode_pendaftaran' => 'ADM-' . strtoupper(\Str::random(8)),
        'status' => $request->status,
        'catatan' => $request->catatan,
        'admin_id' => auth()->id(),
        'tanggal_verifikasi' => $request->status === 'pending' ? null : now(),
    ]);

    return redirect()
        ->route('admin.pendaftaran.index')
        ->with('success', 'Pendaftaran berhasil ditambahkan');
}

public function exportExcel($ekskul)
{
    return Excel::download(new EkskulExport($ekskul), 'anggota_'.$ekskul.'.xlsx');
}

public function exportWord($ekskul)
{
    $data = Pendaftaran::with('ekstrakurikuler')
        ->whereHas('ekstrakurikuler', function($q) use ($ekskul){
            $q->where('nama',$ekskul);
        })
        ->where('status','diterima')
        ->get();

    $phpWord = new PhpWord();
    $section = $phpWord->addSection();

    $section->addText("Daftar Anggota Ekskul ".$ekskul);

    $table = $section->addTable();

    $table->addRow();
    $table->addCell()->addText("Nama");
    $table->addCell()->addText("Kelas");
    $table->addCell()->addText("No HP");

    foreach($data as $d){
        $table->addRow();
        $table->addCell()->addText($d->nama);
        $table->addCell()->addText($d->kelas);
        $table->addCell()->addText($d->no_hp);
    }

    $file = "anggota_".$ekskul.".docx";

    $temp_file = tempnam(sys_get_temp_dir(), $file);
    $phpWord->save($temp_file);

    return response()->download($temp_file,$file)->deleteFileAfterSend(true);
}

public function exportPdf($ekskul)
{
    $data = Pendaftaran::with('ekstrakurikuler')
        ->whereHas('ekstrakurikuler', function($q) use ($ekskul){
            $q->where('nama',$ekskul);
        })
        ->where('status','diterima')
        ->get();

    $pdf = Pdf::loadView('export.pdf', compact('data','ekskul'));

    return $pdf->download('anggota_'.$ekskul.'.pdf');
}

}