<?php

namespace App\Http\Livewire\Admin;

use App\Models\Balita;
use App\Models\Posyandu;
use Livewire\Component;

class GiziBalitaUpdate extends Component
{
    public $gizi_balita;
    public $balita_id, $posyandu_id, $tinggi_badan, $berat_badan, $tanggal_pengukuran;
    public $nama_posyandu;
    public $message;
    public $action = 'update';

    public function mount($gizi_balita)
    {
        if ($gizi_balita) {
            $this->gizi_balita = $gizi_balita;
            $this->balita_id = $this->gizi_balita->balita_id;
            $this->posyandu_id = $this->gizi_balita->posyandu_id;
            $this->tinggi_badan = $this->gizi_balita->tinggi_badan;
            $this->berat_badan = $this->gizi_balita->berat_badan;
            $this->tanggal_pengukuran = $this->gizi_balita->tanggal_pengukuran;
        }
    }

    public function update()
    {
        $this->message = false;

        $this->validate([
            'balita_id' => 'required|exists:balita,id',
            'posyandu_id' => 'required|exists:posyandu,id',
            'tinggi_badan' => 'required',
            'berat_badan' => 'required',
            'tanggal_pengukuran' => 'required|date',
        ]);
        try {
            $store = Balita::storeProcess($this->all(), $this->gizi_balita->id);
            if (!$store) {
                $this->message = 'Inputan tinggi badan tidak ditemukan di data antropometri.';
            } else {
                return redirect()->route('admin.gizi-balita.index')->with('success', 'Berhasil merubah data');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function storePosyandu()
    {
        $this->validate([
            'nama_posyandu' => 'required|string|unique:posyandu,nama',
        ]);

        try {
            Posyandu::create([
                'nama' => $this->nama_posyandu,
            ]);
            return redirect()->route('admin.gizi-balita.edit', ['gizi_balitum' => $this->gizi_balita->id])->with('success', 'Berhasil menambahkan data posyandu');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function deletePosyandu($id)
    {
        try {
            Posyandu::find($id)->delete();
            return redirect()->route('admin.gizi-balita.edit', ['gizi_balitum' => $this->gizi_balita->id])->with('success', 'Berhasil menghapus data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.gizi-balita-update', [
            'posyandu' => Posyandu::all(),
            'balita' => Balita::getAllByUsia(),
        ]);
    }
}
