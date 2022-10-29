<?php

namespace App\Http\Livewire\Admin;

use App\Models\Balita;
use Livewire\Component;
use Livewire\WithPagination;

class BalitaIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $search;
    public $data;

    public function getBalitaProperty()
    {
        return Balita::when($this->search, function ($query) {
            $query->where('nama', 'like', "%{$this->search}%")
                ->orWhereHas('orangtua', function ($query) {
                    $query->where('nama', 'like', "%{$this->search}%");
                });
        })->paginate($this->perPage);
    }

    public function show($id)
    {
        $this->data = Balita::findOrFail($id);
    }

    public function delete()
    {
        try {
            $this->data->delete();
            return redirect()->route('admin.balita.index')->with('success', 'Berhasil menghapus balita');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.balita-index', [
            'balita' => $this->balita
        ]);
    }
}
