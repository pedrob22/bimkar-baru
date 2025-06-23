<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\JanjiPeriksa;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JanjiPeriksaController extends Controller
{
    // Menampilkan form daftar poli + riwayat daftar poli
    public function index()
    {
        $jadwalList = JadwalPeriksa::with('dokter', 'poli')->get();
        $riwayat = JanjiPeriksa::with('jadwalPeriksa.dokter', 'jadwalPeriksa.poli' , 'pasien')
            ->where('id_pasien', Auth::id())->whereDoesntHave('periksa')
            ->get();

        return view('pasien.daftar-poli', compact('jadwalList', 'riwayat'));
    }
    public function riwayat()
    {   
        $riwayat = JanjiPeriksa::with('jadwalPeriksa.dokter', 'jadwalPeriksa.poli', 'pasien')
        ->where('id_pasien', Auth::id())
        ->whereHas('periksa')  // only JanjiPeriksa that have related Periksa
        ->get();

        return view('pasien.riwayat.index', compact('riwayat'));
    }

    public function blmriwayat()
    {   
        $blmriwayat = JanjiPeriksa::with('jadwalPeriksa.dokter', 'jadwalPeriksa.poli', 'pasien')
        ->where('id_pasien', Auth::id())
        ->whereDoesntHave('periksa') // only JanjiPeriksa that have related Periksa
        ->get();

        return view('dashboard', compact('blmriwayat'));
    }


    // Menyimpan janji periksa
    public function store(Request $request)
    {
        $request->validate([
            'id_jadwal_periksa' => 'required|exists:jadwal_periksas,id',
            'keluhan' => 'required|string|max:255',
        ]);

        $antrian = JanjiPeriksa::where('id_jadwal_periksa', $request->id_jadwal_periksa)->count() + 1;

        JanjiPeriksa::create([
            'id_pasien' => Auth::id(),
            'id_jadwal_periksa' => $request->id_jadwal_periksa,
            'keluhan' => $request->keluhan,
            'no_antrian' => $antrian,
        ]);

        return redirect()->route('pasien.janji.index')->with('success', 'Berhasil mendaftar poli.');
    }
}
