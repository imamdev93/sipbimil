<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Balita extends Model
{
    use HasFactory;
    protected $table = 'balita';
    public $guarded = [];

    public function orangtua()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function getAllByUsia()
    {
        return self::all()->filter(function ($item) {
            $date = Carbon::now();
            if ($date->diffInMonths($item->tanggal_lahir) <= 60) {
                return $item;
            }
        });
    }

    // fungsi untuk proses simpan data
    public static function storeProcess($data, $id = null)
    {
        $data['berat_badan'] = str_replace(',', '.', $data['berat_badan']);
        $data['tinggi_badan'] = str_replace(',', '.', $data['tinggi_badan']);

        $balita = self::getBalita($data);
        $usia = self::getUsia($balita, $data);

        $penilaian = self::getAntropometri($balita, $data, 2);
        if (($usia <= 24)) {
            $penilaian = self::getAntropometri($balita, $data, 1);
        }
        if (!$penilaian) {
            return $penilaian;
        }

        $result = self::formulaProcess($penilaian, $data);

        $data += $result;
        $data['naik_berat_badan'] = 'N';
        unset($data['gizi_balita']);
        unset($data['nama_posyandu']);
        unset($data['action']);
        unset($data['message']);
        try {
            // ubah atau simpan data gizi balita
            GiziBalita::updateOrCreate([
                'id' => $id
            ], $data);

            self::getBalita($data)->update(['status' => $data['status']]); // update status balita
            return true;
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public static function getBalita($data)
    {
        return self::findOrFail($data['balita_id']);
    }

    // fungsi untuk mengambil selisih usia balita
    public static function getUsia($balita, $data)
    {
        $date = Carbon::parse($data['tanggal_pengukuran']);
        $usia = $date->diffInMonths($balita->tanggal_lahir);
        return $usia;
    }

    //fungsi untuk mengambil data antropometri
    public static function getAntropometri($balita, $data, $kategori)
    {
        return AntropometriPenilaian::where('tinggi_badan', $data['tinggi_badan'])
            ->where('jenis_kelamin', $balita->jenis_kelamin)
            ->where('kategori', $kategori)
            ->first();
    }

    // fungsi perhitungan data mencari status
    public static function formulaProcess($penilaian, $data)
    {
        $result = ($data['berat_badan'] - $penilaian->median) / ($penilaian->median - $penilaian->negatif_satu_sd);
        if ($data['berat_badan'] >= $penilaian->median) {
            $result = ($data['berat_badan'] - $penilaian->median) / ($penilaian->positif_satu_sd - $penilaian->median);
        }

        return [
            'status' => self::getStatus($data['berat_badan'], $penilaian),
            'hasil' => round($result, 1)
        ];
    }

    // fungsi untuk menentukan status
    public static function getStatus($result, $penilaian)
    {
        $status = 'Obesitas';

        if ($result < $penilaian->negatif_tiga_sd) {
            $status = 'Gizi Buruk';
        } elseif ($result >= $penilaian->negatif_tiga_sd && $result < $penilaian->negatif_dua_sd) {
            $status = 'Gizi Kurang';
        } elseif ($result >= $penilaian->negatif_dua_sd && $result <= $penilaian->positif_satu_sd) {
            $status = 'Gizi Baik';
        } elseif ($result > $penilaian->positif_satu_sd && $result <= $penilaian->positif_dua_sd) {
            $status = 'Berisiko gizi lebih';
        } elseif ($result > $penilaian->positif_dua_sd && $result <= $penilaian->positif_tiga_sd) {
            $status = 'Gizi Lebih';
        }

        return $status;
    }
}
