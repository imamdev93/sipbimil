<?php

namespace App\Http\Livewire\Admin;

use App\Models\GiziBalita;
use Livewire\Component;
use Livewire\WithPagination;

class GiziBalitaIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $status;
    public $search;
    public $data;

    public function getGiziBalitaProperty()
    {
        return GiziBalita::when($this->search, function ($query) {
            $query->whereHas('balita', function ($query) {
                $query->where('nama', 'like', "%{$this->search}%");
            });
        })->when($this->status, function ($query) {
            $query->where('status', $this->status);
        })->paginate($this->perPage);
    }

    public function show($id)
    {
        $this->data = GiziBalita::findOrFail($id);
    }

    public function delete()
    {
        try {
            $this->data->delete();
            return redirect()->route('admin.gizi-balita.index')->with('success', 'Berhasil menghapus data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.gizi-balita-index', [
            'balita' => $this->giziBalita
        ]);
    }
}
