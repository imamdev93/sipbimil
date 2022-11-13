<?php

namespace App\Http\Livewire\Admin;

use App\Models\GiziIbuHamil;
use Livewire\Component;
use Livewire\WithPagination;

class GiziIbuHamilIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $status;
    public $search;
    public $data;

    public function getGiziIbuHamilProperty()
    {
        return GiziIbuHamil::when($this->search, function ($query) {
            $query->whereHas('ibuhamil', function ($query) {
                $query->whereHas('user', function ($query) {
                    $query->where('nama', 'like', "%{$this->search}%");
                });
            });
        })->when($this->status, function ($query) {
            $query->where('status', $this->status);
        })->paginate($this->perPage);
    }

    public function show($id)
    {
        $this->data = GiziIbuHamil::findOrFail($id);
    }

    public function delete()
    {
        try {
            $this->data->delete();
            return redirect()->route('admin.gizi-ibu-hamil.index')->with('success', 'Berhasil menghapus data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.gizi-ibu-hamil-index', [
            'bumil' => $this->giziIbuHamil
        ]);
    }
}
