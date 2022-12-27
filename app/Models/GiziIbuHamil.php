<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiziIbuHamil extends Model
{
    use HasFactory;

    protected $table = 'gizi_ibu_hamil';
    public $primaryKey = 'id';
    public $guarded = [];

    public function ibuhamil()
    {
        return $this->belongsTo(IbuHamil::class, 'ibu_hamil_id', 'id');
    }

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'posyandu_id', 'id');
    }
}
