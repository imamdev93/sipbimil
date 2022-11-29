<?php

namespace App\Http\Livewire\Admin;

use App\Models\Posyandu;
use App\Models\User;
use Livewire\Component;

class OperatorCreate extends Component
{
    public $nama, $username, $password, $password_confirmation, $posyandu_id;
    public $action = 'store';

    public function store()
    {
        $this->validate([
            'nama' => 'required|min:3',
            'posyandu_id' => 'required|exists:posyandu,id',
            'username' => 'required|min:3|unique:users,username',
            'password' => 'required|min:6|confirmed',
        ]);
        try {
            User::create([
                'nama' => $this->nama,
                'username' => $this->username,
                'posyandu_id' => $this->posyandu_id,
                'password' => bcrypt($this->password),
                'role' => 'operator'
            ]);
            return redirect()->route('admin.operator.index')->with('success', 'Berhasil menambahkan data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.operator-create', [
            'posyandu' => Posyandu::all()
        ]);
    }
}
