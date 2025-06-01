<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function edit()
{
    $dokter = auth()->user(); // ambil data dokter login
    return view('dokter.edit', compact('dokter'));
}

public function update(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'spesialis' => 'required',
        'alamat' => 'required',
        'no_telp' => 'required',
    ]);

    $dokter = auth()->user();
    $dokter->update($request->only(['name', 'email', 'spesialis', 'alamat', 'no_telp']));

    return redirect()->route('dokter.dashboard')->with('success', 'Data berhasil diperbarui.');
}

}
