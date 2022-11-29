<?php

namespace App\Exports;

use App\Models\GiziIbuHamil;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GiziIbuHamilExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = GiziIbuHamil::select(
            'users.nama as nama',
            'ibu_hamil.tanggal_lahir',
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
            'Tanggal Lahir',
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
