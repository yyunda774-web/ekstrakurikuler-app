<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EkskulExport implements FromCollection, WithHeadings
{
    protected $ekskul;

    public function __construct($ekskul)
    {
        $this->ekskul = $ekskul;
    }

    public function collection()
    {
        return Pendaftaran::with('ekstrakurikuler')
        ->whereHas('ekstrakurikuler', function($q){
            $q->where('nama',$this->ekskul);
        })
        ->where('status','diterima')
        ->get(['nama','kelas','no_hp']);
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Kelas',
            'No HP'
        ];
    }
}