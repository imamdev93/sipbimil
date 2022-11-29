<?php

namespace App\Http\Livewire\Admin;

use App\Models\Posyandu;
use Livewire\Component;

class OperatorUpdate extends Component
{
    public $nama, $username, $password, $password_confirmation, $posyandu_id, $operator;
    public $action = 'update';

    public function mount($operator)
    {
        if ($operator) {
            $this->operator = $operator;
            $this->nama = $this->operator->nama;
            $this->username = $this->operator->username;
            $this->posyandu_id = $this->operator->posyandu_id;
        }
    }

    public function update()
    {
        $this->validate([
            'nama' => 'required|min:3',
            'posyandu_id' => 'required|exists:posyandu,id',
            'username' => 'required|min:3|unique:users,username,' . $this->operator->id,
            'password' => $this->password ? 'required|min:6|confirmed' : '',
        ]);
        try {
            $this->operator->update([
                'nama' => $this->nama,
                'username' => $this->username,
                'password' => $this->password ? bcrypt($this->password) : $this->operator->password,
                'posyandu_id' => $this->posyandu_id,
            ]);
            return redirect()->route('admin.operator.index')->with('success', 'Berhasil merubah data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.operator-update', [
            'posyandu' => Posyandu::all()
        ]);
    }
}
