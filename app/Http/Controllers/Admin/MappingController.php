<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use App\Models\User;
use Illuminate\Http\Request;

class MappingController extends Controller
{
    public function index()
    {
        $ekskul = Ekstrakurikuler::with(['pembina','pendaftarans'])->get();

        return view('admin.mapping.index', compact('ekskul'));
    }

    public function edit($id)
    {
        $ekskul = Ekstrakurikuler::findOrFail($id);

        $pembina = User::where('role','pembina')->get();

        return view('admin.mapping.edit', compact('ekskul','pembina'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pembina_id' => 'required|exists:users,id'
        ]);

        // CEK: apakah pembina sudah dipakai ekskul lain
        $cek = Ekstrakurikuler::where('pembina_id', $request->pembina_id)
            ->where('id','!=',$id)
            ->first();

        if($cek){
            return back()->with('error','Pembina sudah dipakai di ekskul lain!');
        }

        $ekskul = Ekstrakurikuler::findOrFail($id);

        $ekskul->update([
            'pembina_id' => $request->pembina_id
        ]);

        return redirect()->route('admin.mapping')
            ->with('success','Mapping berhasil diperbarui!');
    }
}