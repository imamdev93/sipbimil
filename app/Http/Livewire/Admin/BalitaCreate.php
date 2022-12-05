<?php

namespace App\Http\Livewire\Admin;

use App\Models\Balita;
use App\Models\User;
use Livewire\Component;

class BalitaCreate extends Component
{
    // define attributes
    public $nama, $jenis_kelamin, $user_id, $alamat, $rt, $rw, $tanggal_lahir;
    public $nama_ortu, $username, $password, $password_confirmation;
    public $action = 'store';

    //fungsi menyimpan data
    public function store()
    {
        // validasi data
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
            Balita::create([
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
            // jika data gagal disimpan
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    //fungsi menyimpan data users
    public function storeOrtu()
    {
        $this->validate([
            'nama_ortu' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|min:6|confirmed',
        ]);

        try {
            User::create([
                'nama' => $this->nama_ortu,
                'username' => $this->username,
                'password' => bcrypt($this->password),
                'role' => 'user',
                'is_admin' => false,
            ]);
            return redirect()->route('admin.balita.create')->with('success', 'Berhasil menambahkan orangtua');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.balita-create', [
            'orangtua' => User::where('role', 'user')->get()
        ]);
    }
}
