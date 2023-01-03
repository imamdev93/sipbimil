<?php

namespace App\Http\Livewire\Admin;

use App\Models\IbuHamil;
use App\Models\User;
use Livewire\Component;

class IbuHamilUpdate extends Component
{
    public $ibu_hamil;
    public $user_id, $alamat, $rt, $rw, $tanggal_lahir;
    public $nama_ortu, $username;
    public $action = 'update';

    public function mount($ibu_hamil)
    {
        if ($ibu_hamil) {
            $this->ibu_hamil = $ibu_hamil;
            $this->user_id = $this->ibu_hamil->user_id;
            $this->alamat = $this->ibu_hamil->alamat;
            $this->rt = $this->ibu_hamil->rt;
            $this->rw = $this->ibu_hamil->rw;
            $this->tanggal_lahir = $this->ibu_hamil->tanggal_lahir;
        }
    }

    public function update()
    {
        $this->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal_lahir' => 'required|date',
            'rt' => 'required|numeric|min:1',
            'rw' => 'required|numeric|min:1',
            'alamat' => 'required',
        ]);
        try {
            $this->ibu_hamil->update([
                'user_id' => $this->user_id,
                'alamat' => $this->alamat,
                'rt' => $this->rt,
                'rw' => $this->rw,
                'tanggal_lahir' => $this->tanggal_lahir,
            ]);
            return redirect()->route('admin.ibu-hamil.index')->with('success', 'Berhasil merubah data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function storeOrtu()
    {
        $this->validate([
            'nama_ortu' => 'required|string',
            'username' => 'required|string',
        ]);
        try {
            User::create([
                'nama' => $this->nama_ortu,
                'username' => $this->username,
                'password' => bcrypt($this->username),
                'role' => 'user',
                'is_admin' => false,
            ]);
            return redirect()->route('admin.ibu-hamil.edit', $this->ibu_hamil->id)->with('success', 'Berhasil menambahkan data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.ibu-hamil-update', [
            'users' => User::where('role', 'user')->get()
        ]);
    }
}
