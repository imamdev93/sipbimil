<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IbuHamil extends Model
{
    use HasFactory;

    protected $table = 'ibu_hamil';
    public $guarded = [];

    // fungsi relasi ke tabel user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //Proses simpan data untuk gizi ibu hamil
    public static function storeProcess($request, $id = null)
    {
        $result = self::formulaProcess($request);
        $request += $result;
        unset($request['nama_posyandu']);
        unset($request['action']);
        unset($request['gizi_ibu_hamil']);
        try {
            GiziIbuHamil::updateOrCreate([
                'id' => $id
            ], $request);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    // fungsi perhitungan data mencari status
    public static function formulaProcess($request)
    {
        $tinggi_badan = pow($request['tinggi_badan'] / 100, 2);
        $result = $request['berat_badan'] / $tinggi_badan;
        return [
            'status' => self::getStatus($result),
            'hasil' => round($result, 1)
        ];
    }

    // fungsi untuk menentukan status
    public static function getStatus($result)
    {
        $status = 'Obese II';

        if ($result < 18.5) {
            $status = 'Kurus';
        } elseif ($result >= 18.5 && $result <= 22.9) {
            $status = 'Normal';
        } elseif ($result >= 23 && $result <= 24.9) {
            $status = 'Gemuk';
        } elseif ($result >= 25 && $result <= 29.9) {
            $status = 'Obese I';
        }

        return $status;
    }
}
