<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JanjiPeriksa;
use App\Models\JadwalPeriksa;
use App\Models\Periksa;
use App\Models\Obat;
use App\Models\DetailPeriksa;

class PeriksaController extends Controller
{
    public function index()
    {
        $jadwalPeriksa = JadwalPeriksa::where('id_dokter', Auth::user()->id)
        ->where('status', true)
        ->first();

        if (!$jadwalPeriksa) {
            return view('dokter.periksa.index', [
                'janjiPeriksas' => collect(),
                'jadwalPeriksa' => null,
            ]);
        }

        $janjiPeriksas = JanjiPeriksa::where('id_jadwal_periksa', $jadwalPeriksa->id)->get();

        return view('dokter.periksa.index', [
            'janjiPeriksas' => $janjiPeriksas,
            'jadwalPeriksa' => $jadwalPeriksa,
        ]);
    }

    public function periksaForm(Request $request, $id)
    {
        $janjiPeriksa = JanjiPeriksa::findOrFail($id);
        $obats = Obat::all();
    
        $biayaPemeriksaan = 150000;
        $totalObat = 0;
    
        if ($request->has('obats')) {
            $totalObat = Obat::whereIn('id', $request->obats)->sum('harga');
        }
    
        $totalBiaya = $biayaPemeriksaan + $totalObat;
    
        return view('dokter.periksa.form', compact('janjiPeriksa', 'obats', 'totalBiaya'));
    }
    

    public function simpan(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'nullable|string|max:255',
            'obats' => 'array',
            'obats.*' => 'exists:obats,id',
        ]);

        $janjiPeriksa = JanjiPeriksa::findOrFail($id);

        // Hitung ulang total harga obat
        $hargaObat = Obat::whereIn('id', $validatedData['obats'])->sum('harga');

        // Tetapkan biaya pemeriksaan dasar
        $biayaPemeriksaan = 150000;

        // Total biaya = biaya periksa + harga semua obat
        $totalBiaya = $biayaPemeriksaan + $hargaObat;

        // Simpan pemeriksaan
        $periksa = Periksa::create([
            'id_janji_periksa' => $janjiPeriksa->id,
            'tgl_periksa' => $validatedData['tgl_periksa'],
            'catatan' => $validatedData['catatan'],
            'biaya_periksa' => $totalBiaya, // ← SEKARANG sesuai dengan jumlah obat!
        ]);

        foreach ($validatedData['obats'] as $obatId) {
            DetailPeriksa::create([
                'id_periksa' => $periksa->id,
                'id_obat' => $obatId,
            ]);
        }

        return redirect()->route('dokter.periksa.index')->with('success', 'Pemeriksaan berhasil disimpan.');
    }



    public function edit($id)
    {
        $periksa = Periksa::with(['janjiPeriksa.pasien', 'detailPeriksas.obat'])->findOrFail($id);
        $obats = Obat::all();
    
        // Ambil ID obat yang sudah dipilih
        $selectedObatIds = $periksa->detailPeriksas->pluck('id_obat')->toArray();
    
        // Hitung ulang total harga obat
        $hargaObat = Obat::whereIn('id', $selectedObatIds)->sum('harga');
        $totalBiaya = 150000 + $hargaObat;
    
        return view('dokter.periksa.edit', compact('periksa', 'obats', 'selectedObatIds', 'totalBiaya'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'nullable|string|max:255',
            'obats' => 'array',
            'obats.*' => 'exists:obats,id',
        ]);

        $periksa = Periksa::findOrFail($id);

        $obatIds = $validatedData['obats'] ?? [];
        $hargaObat = Obat::whereIn('id', $obatIds)->sum('harga');
        $biayaPeriksa = 150000 + $hargaObat;

        // Update periksa
        $periksa->update([
            'tgl_periksa' => $validatedData['tgl_periksa'],
            'catatan' => $validatedData['catatan'],
            'biaya_periksa' => $biayaPeriksa,
        ]);

        // Update detail obat
        $periksa->detailPeriksas()->delete(); // Hapus lama
        foreach ($obatIds as $obatId) {
            DetailPeriksa::create([
                'id_periksa' => $periksa->id,
                'id_obat' => $obatId,
            ]);
        }

        return redirect()->route('dokter.periksa.index')->with('success', 'Pemeriksaan berhasil diperbarui.');
    }



}
