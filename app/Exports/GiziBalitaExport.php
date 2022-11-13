<?php

namespace App\Exports;

use App\Models\GiziBalita;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GiziBalitaExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
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
            ->get()->map(function ($item, $key) {
                $data['id'] = $key + 1;
                $data += $item->toArray();
                return $data;
            });
        return $data;
    }
    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'JK',
            'Tanggal Lahir',
            'Nama Orangtua',
            'Alamat',
            'Posyandu',
            'RT',
            'RW',
            'Tanggal Pengukuran',
            'Berat (kg)',
            'Tinggi (cm)',
            'Status',
            'Hasil Z Score',
        ];
    }
}
