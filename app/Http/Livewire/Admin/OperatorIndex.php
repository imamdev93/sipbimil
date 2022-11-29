<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class OperatorIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $search;
    public $data;

    public function getOperatorProperty()
    {
        return User::when($this->search, function ($query) {
            $query->where('nama', 'like', "%{$this->search}%")
                ->orWhere('username', 'like', "%{$this->search}%");
        })->where('role', 'operator')
            ->paginate($this->perPage);
    }

    public function show($id)
    {
        $this->data = User::findOrFail($id);
    }

    public function delete()
    {
        try {
            $this->data->delete();
            return redirect()->route('admin.operator.index')->with('success', 'Berhasil menghapus data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.operator-index', [
            'operator' => $this->operator
        ]);
    }
}
