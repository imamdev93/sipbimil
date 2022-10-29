<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class BalitaUpdate extends Component
{
    public $balita;
    public $nama, $jenis_kelamin, $user_id, $alamat, $rt, $rw, $tanggal_lahir;
    public $nama_ortu, $username;
    public $action = 'update';

    public function mount($balita)
    {
        if ($balita) {
            $this->balita = $balita;
            $this->nama = $this->balita->nama;
            $this->user_id = $this->balita->user_id;
            $this->alamat = $this->balita->alamat;
            $this->rt = $this->balita->rt;
            $this->rw = $this->balita->rw;
            $this->jenis_kelamin = $this->balita->jenis_kelamin;
            $this->tanggal_lahir = $this->balita->tanggal_lahir;
        }
    }

    public function update()
    {
        $this->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'rt' => 'required|numeric|min:1',
            'rw' => 'required|numeric|min:1',
        ]);
        try {
            $this->balita->update([
                'user_id' => $this->user_id,
                'nama' => $this->nama,
                'jenis_kelamin' => $this->jenis_kelamin,
                'alamat' => $this->alamat,
                'rt' => $this->rt,
                'rw' => $this->rw,
                'tanggal_lahir' => $this->tanggal_lahir,
            ]);
            return redirect()->route('admin.balita.index')->with('success', 'Berhasil menambahkan balita');
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
            return redirect()->route('admin.balita.edit', $this->balita->id)->with('success', 'Berhasil menambahkan orangtua');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.balita-update', [
            'orangtua' => User::where('role', 'user')->get()
        ]);
    }
}
