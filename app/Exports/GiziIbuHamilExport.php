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

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    public function collection()
    {
        $this->data->map(function ($item, $key) {
            $data['id'] = $key + 1;
            $data += $item->toArray();
            return $data;
        });
        return $this->data;
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
