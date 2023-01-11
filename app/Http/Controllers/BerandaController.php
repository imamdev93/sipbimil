<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Balita;
use App\Models\GiziBalita;
use App\Models\GiziIbuHamil;
use App\Models\IbuHamil;
use App\Models\Posyandu;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    // Menampilkan Halaman Beranda
    public function index(Request $request)
    {
        $posyandu = Posyandu::all()->pluck('nama', 'id')->toArray();
        $labelBalita = ['Sangat Kurus', 'Kurus', 'Normal', 'Gemuk'];
        $labelBumil = ['Kurus', 'Normal', 'Gemuk', 'Obese I', 'Obese II'];

        foreach ($posyandu as $key => $value) {
            $data['label'][] = $value;
            $data['rowBumil'][] = $this->countData($request, $key)['bumil'];
            $data['rowBalita'][] = $this->countData($request, $key)['balita'];
        }

        $data['grafikByStatus'] = $this->grafikByStatus($labelBalita, $labelBumil, $posyandu, $request);

        $data['tanggal'] = $request->tanggal;

        return view('beranda', $data);
    }

    public function countData($request, $posyanduId)
    {
        $data['bumil'] = GiziIbuHamil::when($request->tanggal, function ($query) use ($request) {
            $query->where(DB::raw('DATE_FORMAT(tanggal_pengukuran, "%Y-%m")'), $request->tanggal);
        })->where('posyandu_id', $posyanduId)->distinct('ibu_hamil_id')->count('ibu_hamil_id');

        $data['balita'] = GiziBalita::when($request->tanggal, function ($query) use ($request) {
            $query->where(DB::raw('DATE_FORMAT(tanggal_pengukuran, "%Y-%m")'), $request->tanggal);
        })->where('posyandu_id', $posyanduId)->distinct('balita_id')->count('balita_id');

        return $data;
    }

    public function grafikByStatus($balita, $bumil, $posyandu, $request)
    {
        $data['balita'] = [];
        $data['bumil'] = [];

        foreach($balita as $key => $val){
            $data['balita'][$key]['name'] = $val;
            foreach($posyandu as $k => $v){
                $count = GiziBalita::when($request->tanggal, function ($query) use ($request) {
                    $query->where(DB::raw('DATE_FORMAT(tanggal_pengukuran, "%Y-%m")'), $request->tanggal);
                })->where('posyandu_id', $k)->where('status', $val)->distinct('balita_id')->count('balita_id');
                $data['balita'][$key]['data'][] = $count;
            }
        }

        foreach($bumil as $key => $val){
            $data['bumil'][$key]['name'] = $val;
            foreach($posyandu as $k => $v){
                $count = GiziIbuHamil::when($request->tanggal, function ($query) use ($request) {
                    $query->where(DB::raw('DATE_FORMAT(tanggal_pengukuran, "%Y-%m")'), $request->tanggal);
                })->where('posyandu_id', $k)->where('status', $val)->distinct('ibu_hamil_id')->count('ibu_hamil_id');
                $data['bumil'][$key]['data'][] = $count;
            }
        }

        return $data;
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
            $user = User::where('username', $request->username)->first();
            $role = $request->role;
            if ($request->role == 'web') {
                $role = 'user';
            }elseif($user->role == 'operator'){
                $role = 'operator';
            }

            if ($user && $user->role != $role) {
                return redirect()->route('login')->with('error', 'Gagal Login');
            }

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
