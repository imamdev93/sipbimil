<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Balita;
use App\Models\GiziBalita;
use App\Models\GiziIbuHamil;
use App\Models\IbuHamil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $data['totalIbuHamil'] = IbuHamil::count();
        $data['totalBalita'] = Balita::count();
        $data['totalBalitaByStatus'] = Balita::select('status', DB::raw('count(*) as total'))->groupBy('status')->get();
        $data['totalIbuHamilByStatus'] = IbuHamil::select('status', DB::raw('count(*) as total'))->groupBy('status')->get();
        return view('beranda', $data);
    }

    public function login()
    {
        if (auth()->guard('web')->check()) {
            return redirect()->route('dashboard');
        }
        return view('login');
    }

    public function loginProcess(LoginRequest $request)
    {
        try {
            if (!Auth::guard('web')->attempt($request->only('username', 'password'))) {
                return redirect()->route('login')->with('error', 'Gagal Login');
            }
            return redirect()->route('dashboard')->with('success', 'Berhasil Login');
        } catch (\Throwable $th) {
            return redirect()->route('login')->with('error', $th->getMessage());
        }
    }

    public function dashboard(Request $request)
    {
        $users = auth()->guard('web')->user();
        $balita = $request->balita_id ?? $users->balitas->first()->id ?? null;
        $bumil = $users->bumil->id ?? null;

        $data['semua_balita'] = $users->balitas->pluck('nama', 'id')->toArray();
        $data['nama_balita'] = null;
        $data['bumil'] = null;

        if ($balita) {
            $data['balita'] = $this->getDataChart('balita', $balita);
            $data['nama_balita'] = Balita::findOrFail($balita)->nama;
        }

        if ($bumil) {
            $data['bumil'] = $this->getDataChart('ibu_hamil', $bumil);
        }

        return view('dashboard', $data);
    }

    public function getDataChart($label, $id)
    {
        $data = [];
        $balitaResults = DB::table('gizi_' . $label)->select(
            DB::raw('date_format(tanggal_pengukuran,"%M %y") as month'),
            'status',
            'hasil',

        )
            ->where($label . '_id', $id)
            ->groupBy(DB::raw('date_format(tanggal_pengukuran,"%Y-%m")'))
            ->orderBy('tanggal_pengukuran', 'asc')
            ->get();

        foreach ($balitaResults as $br) {
            $data['labels'][] = $br->month . " ($br->status)";
            $data['rows'][] = $br->hasil;
        }

        return $data;
    }

    public function logout()
    {
        auth()->guard('web')->logout();
        return view('login');
    }
}
