<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Balita;
use App\Models\IbuHamil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    // Menampilkan Halaman Beranda
    public function index()
    {
        $data['totalIbuHamil'] = IbuHamil::count(); //menghitung data ibu hamil
        $data['totalBalita'] = Balita::count(); //menghitung data balita
        $data['totalBalitaByStatus'] = Balita::select('status', DB::raw('count(*) as total'))->groupBy('status')->get(); //Menghitung data gizi balita berdasarkan status
        $data['totalIbuHamilByStatus'] = IbuHamil::select('status', DB::raw('count(*) as total'))->groupBy('status')->get(); //Menghitung data gizi ibu hamil berdasarkan status
        return view('beranda', $data);
    }

    // Redirect ke halaman login user
    public function login()
    {
        if (auth()->guard('web')->check()) { // pengecekan jika user sudah login
            return redirect()->route('dashboard');
        } elseif (auth()->guard('admin')->check()) { // pengecekan jika user sudah login
            return redirect()->route('admin.dashboard');
        }
        return view('login');
    }

    // fungsi untuk login user
    public function loginProcess(LoginRequest $request)
    {
        try {
            if (!Auth::guard($request->role)->attempt($request->only('username', 'password'))) {
                return redirect()->route('login')->with('error', 'Gagal Login');
            }

            if ($request->role == 'web') {
                return redirect()->route('dashboard')->with('success', 'Berhasil Login');
            } else {
                return redirect()->route('admin.dashboard')->with('success', 'Berhasil Login');
            }
        } catch (\Throwable $th) {
            return redirect()->route('login')->with('error', $th->getMessage());
        }
    }

    // fungsi untuk menampilkan halaman monitoring berdasarkan user yang login
    public function dashboard(Request $request)
    {
        $users = auth()->guard('web')->user(); // mengambil data user yang login
        $balita = $request->balita_id ?? $users->balitas->first()->id ?? null;
        $bumil = $users->bumil->id ?? null;

        $data['semua_balita'] = $users->balitas->pluck('nama', 'id')->toArray();
        $data['nama_balita'] = null;
        $data['bumil'] = null;

        if ($balita) { // pengecekan jika id balita tidak kosong
            $data['balita'] = $this->getDataChart('balita', $balita); // mengambil data balita untuk chart
            $data['nama_balita'] = Balita::findOrFail($balita)->nama;
        }

        if ($bumil) { // pengecekan jika id ibu hamil tidak kosong
            $data['bumil'] = $this->getDataChart('ibu_hamil', $bumil); // mengambil data ibu hamil untuk chart
        }

        return view('dashboard', $data);
    }

    // fungsi untuk mengambil data untuk ditampilkan di chart
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

    //fungsi untuk keluar dari aplikasi
    public function logout()
    {
        auth()->guard('web')->logout();
        return view('login');
    }
}
