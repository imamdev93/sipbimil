<?php

namespace App\Http\Livewire\Admin;

use App\Models\IbuHamil;
use App\Models\Posyandu;
use Livewire\Component;

class GiziIbuHamilCreate extends Component
{
    public $ibu_hamil_id, $posyandu_id, $tinggi_badan, $berat_badan, $tanggal_pengukuran;
    public $nama_posyandu;
    public $action = 'store';

    public function storePosyandu()
    {
        $this->validate([
            'nama_posyandu' => 'required|string|unique:posyandu,nama',
        ]);

        try {
            Posyandu::create([
                'nama' => $this->nama_posyandu,
            ]);
            return redirect()->route('admin.gizi-ibu-hamil.create')->with('success', 'Berhasil menambahkan data posyandu');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function store()
    {
        $this->validate([
            'ibu_hamil_id' => 'required|exists:ibu_hamil,id',
            'posyandu_id' => 'nullable|exists:posyandu,id',
            'tinggi_badan' => 'required|numeric|between:0,200',
            'berat_badan' => 'required|numeric|between:0,200',
            'tanggal_pengukuran' => 'required|date',
        ]);
        try {
            IbuHamil::storeProcess($this->all());
            return redirect()->route('admin.gizi-ibu-hamil.index')->with('success', 'Berhasil menambahkan data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.gizi-ibu-hamil-create', [
            'posyandu' => Posyandu::all(),
            'bumil' => IbuHamil::all(),
        ]);
    }
}