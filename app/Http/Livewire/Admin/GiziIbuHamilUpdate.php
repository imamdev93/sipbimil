<?php

namespace App\Http\Livewire\Admin;

use App\Models\IbuHamil;
use App\Models\Posyandu;
use Livewire\Component;

class GiziIbuHamilUpdate extends Component
{
    public $gizi_ibu_hamil;
    public $ibu_hamil_id, $posyandu_id, $tinggi_badan, $berat_badan, $tanggal_pengukuran;
    public $nama_posyandu;
    public $message;
    public $action = 'update';

    public function mount($gizi_ibu_hamil)
    {
        if ($gizi_ibu_hamil) {
            $this->gizi_ibu_hamil = $gizi_ibu_hamil;
            $this->ibu_hamil_id = $this->gizi_ibu_hamil->ibu_hamil_id;
            $this->posyandu_id = $this->gizi_ibu_hamil->posyandu_id;
            $this->tinggi_badan = $this->gizi_ibu_hamil->tinggi_badan;
            $this->berat_badan = $this->gizi_ibu_hamil->berat_badan;
            $this->tanggal_pengukuran = $this->gizi_ibu_hamil->tanggal_pengukuran;
        }
    }

    public function update()
    {
        $this->message = false;

        $this->validate([
            'ibu_hamil_id' => 'nullable|exists:ibu_hamil,id',
            'posyandu_id' => 'required|exists:posyandu,id',
            'tinggi_badan' => 'required',
            'berat_badan' => 'required',
            'tanggal_pengukuran' => 'required|date',
        ]);
        try {
            $store = IbuHamil::storeProcess($this->all(), $this->gizi_ibu_hamil->id);
            if (!$store) {
                $this->message = 'Inputan tinggi badan tidak ditemukan di data antropometri.';
            } else {
                return redirect()->route('admin.gizi-ibu-hamil.index')->with('success', 'Berhasil merubah data');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function deletePosyandu($id)
    {
        try {
            Posyandu::find($id)->delete();
            return redirect()->route('admin.gizi-ibu-hamil.edit', ['gizi_ibu_hamil' => $this->gizi_ibu_hamil->id])->with('success', 'Berhasil menghapus data');
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
            return redirect()->route('admin.gizi-ibu-hamil.edit', ['gizi_ibu_hamil' => $this->gizi_ibu_hamil->id])->with('success', 'Berhasil menambahkan data posyandu');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.gizi-ibu-hamil-update', [
            'posyandu' => Posyandu::all(),
            'bumil' => IbuHamil::all(),
        ]);
    }
}
