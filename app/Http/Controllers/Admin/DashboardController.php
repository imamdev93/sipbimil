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
        return view('admin.dashboard', $data);
    }
}
