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

        $data['balitaGiziBaik'] = Balita::where('status', 'Gizi Baik')->count();
        $data['balitaGiziBuruk'] = Balita::where('status', 'Gizi Buruk')->count();
        $data['balitaGiziKurang'] = Balita::where('status', 'Gizi Kurang')->count();
        $data['balitaGiziLebih'] = Balita::where('status', 'Gizi Lebih')->count();
        $data['balitaObesitas'] = Balita::where('status', 'Obesitas')->count();
        $data['balitaBeresikoGiziLebih'] = Balita::where('status', 'Beresiko gizi lebih')->count();

        $data['bumilKurus'] = IbuHamil::where('status', 'Kurus')->count();
        $data['bumilNormal'] = IbuHamil::where('status', 'Normal')->count();
        $data['bumilGemuk'] = IbuHamil::where('status', 'Gemuk')->count();
        $data['bumilObase1'] = IbuHamil::where('status', 'Obase I')->count();
        $data['bumilObase2'] = IbuHamil::where('status', 'Obase II')->count();
        return view('admin.dashboard', $data);
    }
}
