<?php

namespace App\Http\Livewire\Admin;

use App\Models\GiziIbuHamil;
use App\Models\Posyandu;
use Livewire\Component;
use Livewire\WithPagination;

class RekapBumil extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $status;
    public $posyandu_id;
    public $search;
    public $bulan;
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
        })->when($this->posyandu_id, function ($query) {
            $query->where('posyandu_id', $this->posyandu_id);
        })->when($this->bulan, function ($query) {
            $query->whereMonth('tanggal_pengukuran', $this->bulan);
        })->paginate($this->perPage);
    }

    public function show($id)
    {
        $this->data = GiziIbuHamil::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.rekap-bumil', [
            'bumil' => $this->giziIbuHamil,
            'posyandu' => Posyandu::all()
        ]);
    }
}
