<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RekapanController extends Controller
{
    public function getBumilRekap()
    {
        return view('admin.rekap.bumil');
    }

    public function getBalitaRekap()
    {
        return view('admin.rekap.balita');
    }
}
