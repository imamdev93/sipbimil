<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiziBalita extends Model
{
    use HasFactory;

    protected $table = 'gizi_balita';
    public $primaryKey = 'id';
    public $guarded = [];

    public function balita()
    {
        return $this->belongsTo(Balita::class, 'balita_id', 'id');
    }

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'posyandu_id', 'id');
    }
}
