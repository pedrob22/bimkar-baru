<?php

namespace App\Http\Controllers\Pasien;
use App\Http\Controllers\Controller;
use App\Models\JanjiPeriksa;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;


class PasienController extends Controller
{
    public function index()
    {
        $riwayat = JanjiPeriksa::with(['jadwalPeriksa.poli', 'jadwalPeriksa.dokter', 'periksa', 'pasien'])
            ->where('id_pasien', auth()->id())
            ->get();

        $jadwalList = JadwalPeriksa::with('poli', 'dokter')
            ->where('status', true)
            ->get();

        return view('pasien.daftar-poli', compact('riwayat', 'jadwalList'));
    }
}
