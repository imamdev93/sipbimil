<?php

namespace App\Http\Livewire\Admin;

use App\Models\Balita;
use App\Models\Posyandu;
use Livewire\Component;

class GiziBalitaCreate extends Component
{
    public $balita_id, $posyandu_id, $tinggi_badan, $berat_badan, $tanggal_pengukuran;
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
            return redirect()->route('admin.gizi-balita.create')->with('success', 'Berhasil menambahkan data posyandu');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function deletePosyandu($id)
    {
        try {
            Posyandu::find($id)->delete();
            return redirect()->route('admin.gizi-balita.create')->with('success', 'Berhasil menghapus data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function store()
    {
        $this->validate([
            'balita_id' => 'required|exists:balita,id',
            'posyandu_id' => 'required|exists:posyandu,id',
            'tinggi_badan' => 'required|numeric|between:0,200',
            'berat_badan' => 'required|numeric|between:0,50',
            'tanggal_pengukuran' => 'required|date',
        ]);
        try {
            Balita::storeProcess($this->all());
            return redirect()->route('admin.gizi-balita.index')->with('success', 'Berhasil menambahkan balita');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.gizi-balita-create', [
            'posyandu' => Posyandu::all(),
            'balita' => Balita::getAllByUsia(),
        ]);
    }
}
