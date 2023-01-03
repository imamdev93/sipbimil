<?php

namespace App\Http\Livewire\Admin;

use App\Models\IbuHamil;
use App\Models\User;
use Livewire\Component;

class IbuHamilCreate extends Component
{
    public $user_id, $alamat, $rt, $rw, $tanggal_lahir;
    public $nama_ortu, $username, $password, $password_confirmation;
    public $action = 'store';

    public function store()
    {
        $this->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal_lahir' => 'required|date',
            'rt' => 'required|numeric|min:1',
            'rw' => 'required|numeric|min:1',
            'alamat' => 'required',
        ]);
        try {
            IbuHamil::create([
                'user_id' => $this->user_id,
                'alamat' => $this->alamat,
                'rt' => $this->rt,
                'rw' => $this->rw,
                'tanggal_lahir' => $this->tanggal_lahir,
            ]);
            return redirect()->route('admin.ibu-hamil.index')->with('success', 'Berhasil menambahkan ibu hamil');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

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
            return redirect()->route('admin.ibu-hamil.create')->with('success', 'Berhasil menambahkan data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.ibu-hamil-create', [
            'users' => User::where('role', 'user')->get()
        ]);
    }
}
