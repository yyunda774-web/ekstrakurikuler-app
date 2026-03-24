<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $siswa = User::where('role', 'siswa')->paginate(10);
    return view('admin.siswa.index', compact('siswa'));
}

   
   public function edit($id)
{
    $siswa = User::findOrFail($id);
    return view('admin.siswa.edit', compact('siswa'));
}

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $siswa = User::findOrFail($id);

    $siswa->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    return redirect()->route('admin.siswa.index')
        ->with('success', 'Data siswa berhasil diupdate.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $siswa = User::findOrFail($id);
    $siswa->delete();

    return redirect()->route('admin.siswa.index')
        ->with('success', 'Data siswa berhasil dihapus.');
}
}
