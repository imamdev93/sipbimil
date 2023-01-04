<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Balita;
use App\Models\IbuHamil;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $data['balita'] = Balita::count();
        $data['ibuhamil'] = IbuHamil::count();

        $data['balitaGemuk'] = Balita::where('status', 'Gemuk')->count();
        $data['balitaSangatKurus'] = Balita::where('status', 'Sangat Kurus')->count();
        $data['balitaKurus'] = Balita::where('status', 'Kurus')->count();
        $data['balitaNormal'] = Balita::where('status', 'Normal')->count();

        $data['bumilKurus'] = IbuHamil::where('status', 'Kurus')->count();
        $data['bumilNormal'] = IbuHamil::where('status', 'Normal')->count();
        $data['bumilGemuk'] = IbuHamil::where('status', 'Gemuk')->count();
        $data['bumilObase1'] = IbuHamil::where('status', 'Obese I')->count();
        $data['bumilObase2'] = IbuHamil::where('status', 'Obese II')->count();
        return view('admin.dashboard', $data);
    }
}
