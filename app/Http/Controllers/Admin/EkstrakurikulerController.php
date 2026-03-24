<?php
// app/Http\Controllers/Admin/EkstrakurikulerController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;

class EkstrakurikulerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ganti get() dengan paginate()
        $ekstrakurikulers = Ekstrakurikuler::orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.ekstrakurikuler.index', compact('ekstrakurikulers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ekstrakurikuler.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'pembina' => 'nullable|string|max:255',
            'kuota' => 'nullable|integer|min:1',
            'hari' => 'nullable|string|max:100',
            'jam' => 'nullable|string|max:100',
        ]);

        Ekstrakurikuler::create($validated);

        return redirect()->route('admin.ekstrakurikuler.index')
            ->with('success', 'Ekstrakurikuler berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ekstrakurikuler $ekstrakurikuler)
    {
        return view('admin.ekstrakurikuler.show', compact('ekstrakurikuler'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ekstrakurikuler $ekstrakurikuler)
    {
        return view('admin.ekstrakurikuler.edit', compact('ekstrakurikuler'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ekstrakurikuler $ekstrakurikuler)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'pembina' => 'nullable|string|max:255',
            'kuota' => 'nullable|integer|min:1',
            'hari' => 'nullable|string|max:100',
            'jam' => 'nullable|string|max:100',
        ]);

        $ekstrakurikuler->update($validated);

        return redirect()->route('admin.ekstrakurikuler.index')
            ->with('success', 'Ekstrakurikuler berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ekstrakurikuler $ekstrakurikuler)
    {
        $ekstrakurikuler->delete();

        return redirect()->route('admin.ekstrakurikuler.index')
            ->with('success', 'Ekstrakurikuler berhasil dihapus!');
    }

    public function pembina()
    {
        return $this->belongsTo(User::class,'pembina_id');
    }

    public function pendaftarans()
    {
        return $this->hasMany(\App\Models\Pendaftaran::class);
    }

}