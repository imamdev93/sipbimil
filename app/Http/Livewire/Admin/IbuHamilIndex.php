<?php

namespace App\Http\Livewire\Admin;

use App\Models\IbuHamil;
use Livewire\Component;
use Livewire\WithPagination;

class IbuHamilIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $search;
    public $data;

    public function getIbuhamilProperty()
    {
        return IbuHamil::when($this->search, function ($query) {
            $query->whereHas('user', function ($query) {
                $query->where('nama', 'like', "%{$this->search}%");
            });
        })->paginate($this->perPage);
    }

    public function show($id)
    {
        $this->data = IbuHamil::findOrFail($id);
    }

    public function delete()
    {
        try {
            $this->data->delete();
            return redirect()->route('admin.ibu-hamil.index')->with('success', 'Berhasil menghapus data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.ibu-hamil-index', [
            'ibuhamil' => $this->ibuhamil
        ]);
    }
}
