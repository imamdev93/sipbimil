<?php

namespace Database\Seeders;

use App\Models\AntropometriPenilaian;
use Illuminate\Database\Seeder;

class AntropometriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AntropometriPenilaian::truncate();

        $csvFile = fopen(base_path("database/data/antropometri.csv"), "r");
        $header = null;
        $data = array();
        if (($handle = $csvFile) !== false) {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                if (!$header)
                    $header = $row;
                else
                    array_push($data, $row);
            }
            fclose($handle);
        }

        foreach ($data as $row) {
            AntropometriPenilaian::create([
                "tinggi_badan" => str_replace(',', '.', $row['0']),
                "negatif_satu_sd" => str_replace(',', '.', $row['3']),
                "negatif_dua_sd" => str_replace(',', '.', $row['2']),
                "negatif_tiga_sd" => str_replace(',', '.', $row['1']),
                "median" => str_replace(',', '.', $row['4']),
                "positif_satu_sd" => str_replace(',', '.', $row['5']),
                "positif_dua_sd" => str_replace(',', '.', $row['6']),
                "positif_tiga_sd" => str_replace(',', '.', $row['7']),
                "jenis_kelamin" => str_replace(',', '.', $row['8']),
                "kategori" => str_replace(',', '.', $row['9']),
            ]);
        }
    }
}
