<?php

namespace App\Http\Livewire\Admin;

use App\Exports\GiziBalitaExport;
use App\Models\GiziBalita;
use App\Models\Posyandu;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class RekapBalita extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $status;
    public $posyandu_id;
    public $search;
    public $bulan;
    public $data;

    public function getGiziBalitaProperty()
    {
        return GiziBalita::when($this->search, function ($query) {
            $query->whereHas('balita', function ($query) {
                $query->where('nama', 'like', "%{$this->search}%");
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
        $data = GiziBalita::select(
            'balita.nama',
            'balita.jenis_kelamin',
            'balita.tanggal_lahir',
            'users.nama as nama_orangtua',
            'balita.alamat',
            'posyandu.nama as nama_posyandu',
            'balita.rt',
            'balita.rw',
            'gizi_balita.tanggal_pengukuran',
            'gizi_balita.berat_badan',
            'gizi_balita.tinggi_badan',
            'gizi_balita.status',
            'gizi_balita.hasil',
        )->when($this->status, function ($query) {
            $query->where('gizi_balita.status', $this->status);
        })->when($this->posyandu_id, function ($query) {
            $query->where('gizi_balita.posyandu_id', $this->posyandu_id);
        })->when($this->bulan, function ($query) {
            $query->whereMonth('tanggal_pengukuran', $this->bulan);
        })
            ->leftjoin('balita', 'balita.id', 'gizi_balita.balita_id')
            ->leftjoin('users', 'users.id', 'balita.user_id')
            ->leftjoin('posyandu', 'posyandu.id', 'gizi_balita.posyandu_id')
            ->get();
        return Excel::download(new GiziBalitaExport($data), 'data-gizi-balita-' . date('YmdHis') . '.xlsx');
    }

    public function show($id)
    {
        $this->data = GiziBalita::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.rekap-balita', [
            'bumil' => $this->giziBalita,
            'posyandu' => Posyandu::all()
        ]);
    }
}
