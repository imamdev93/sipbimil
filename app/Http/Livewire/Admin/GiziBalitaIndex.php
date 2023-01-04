<?php

namespace App\Http\Livewire\Admin;

use App\Exports\GiziBalitaExport;
use App\Models\Balita;
use App\Models\GiziBalita;
use Livewire\Component;
use Livewire\WithPagination;
use Excel;

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
            $statusExist = GiziBalita::where('balita_id', $this->data->balita_id)->latest()->first()->status ?? null;
            Balita::find($this->data->balita_id)->update(['status' => $statusExist]);
            return redirect()->route('admin.gizi-balita.index')->with('success', 'Berhasil menghapus data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
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
        )
            ->leftjoin('balita', 'balita.id', 'gizi_balita.balita_id')
            ->leftjoin('users', 'users.id', 'balita.user_id')
            ->leftjoin('posyandu', 'posyandu.id', 'gizi_balita.posyandu_id')
            ->get();
        return Excel::download(new GiziBalitaExport($data), 'data-gizi-balita-' . date('YmdHis') . '.xlsx');
    }

    public function render()
    {
        return view('livewire.admin.gizi-balita-index', [
            'balita' => $this->giziBalita
        ]);
    }
}
