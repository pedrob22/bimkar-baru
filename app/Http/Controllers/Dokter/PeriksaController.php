<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JanjiPeriksa;
use App\Models\Periksa;

class PeriksaController extends Controller
{
    public function index()
    {
        $dokterId = Auth::id();

        $data = JanjiPeriksa::with(['pasien', 'jadwalPeriksa'])
            ->whereHas('jadwalPeriksa', function ($query) use ($dokterId) {
                $query->where('id_dokter', $dokterId);
            })
            ->whereDoesntHave('periksa') // hanya yang belum diperiksa
            ->get();

        $riwayat = Periksa::with(['janjiPeriksa.pasien', 'janjiPeriksa.jadwalPeriksa'])
            ->whereHas('janjiPeriksa.jadwalPeriksa', function ($query) use ($dokterId) {
                $query->where('id_dokter', $dokterId);
            })
            ->latest()
            ->get();

        return view('dokter.periksa.index', compact('data' , 'riwayat'));
    }

    public function periksaForm($id)
    {
        $janji = JanjiPeriksa::with('pasien')->findOrFail($id);
        return view('dokter.periksa.form', compact('janji'));
    }

    public function simpan(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string',
            'biaya_obat' => 'required|numeric',
        ]);
    
        $biaya_dokter = 150000;
        $biaya_obat = $request->biaya_obat;
        $total_biaya = $biaya_obat + $biaya_dokter;
    
        Periksa::create([
            'id_janji_periksa' => $id,
            'catatan' => $request->catatan,
            'biaya_periksa' => $total_biaya, 
            'tgl_periksa' => now(),
        ]);

        return redirect()->route('dokter.periksa.index')->with('success', 'Data periksa berhasil disimpan.');
    }
}
