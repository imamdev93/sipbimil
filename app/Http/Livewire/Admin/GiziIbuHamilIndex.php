<?php

namespace App\Http\Livewire\Admin;

use App\Exports\GiziIbuHamilExport;
use App\Models\GiziIbuHamil;
use Livewire\Component;
use Livewire\WithPagination;
use Excel;

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
        )
            ->leftjoin('ibu_hamil', 'ibu_hamil.id', 'gizi_ibu_hamil.ibu_hamil_id')
            ->leftjoin('users', 'users.id', 'ibu_hamil.user_id')
            ->leftjoin('posyandu', 'posyandu.id', 'gizi_ibu_hamil.posyandu_id')
            ->get();
        return Excel::download(new GiziIbuHamilExport($data), 'data-gizi-ibu-hamil-' . date('YmdHis') . '.xlsx');
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
