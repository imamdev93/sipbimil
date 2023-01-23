<?php

namespace App\Http\Livewire\Admin;

use App\Exports\GiziIbuHamilExport;
use App\Models\GiziIbuHamil;
use App\Models\Posyandu;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

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

    public function export()
    {
        $data = GiziIbuHamil::select(
            'ibu_hamil.tanggal_lahir',
            'users.nama as nama',
            'ibu_hamil.alamat',
            'posyandu.nama as nama_posyandu',
            'ibu_hamil.rt',
            'ibu_hamil.rw',
            'gizi_ibu_hamil.tanggal_pengukuran',
            'gizi_ibu_hamil.berat_badan',
            'gizi_ibu_hamil.tinggi_badan',
            'gizi_ibu_hamil.status',
            'gizi_ibu_hamil.hasil',
        )->when($this->status, function ($query) {
            $query->where('gizi_ibu_hamil.status', $this->status);
        })->when($this->posyandu_id, function ($query) {
            $query->where('gizi_ibu_hamil.posyandu_id', $this->posyandu_id);
        })->when($this->bulan, function ($query) {
            $query->whereMonth('tanggal_pengukuran', $this->bulan);
        })
            ->join('ibu_hamil', 'ibu_hamil.id', 'gizi_ibu_hamil.ibu_hamil_id')
            ->join('users', 'users.id', 'ibu_hamil.user_id')
            ->join('posyandu', 'posyandu.id', 'gizi_ibu_hamil.posyandu_id')

            ->get();
        return Excel::download(new GiziIbuHamilExport($data), 'data-gizi-ibu-hamil-' . date('YmdHis') . '.xlsx');
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
