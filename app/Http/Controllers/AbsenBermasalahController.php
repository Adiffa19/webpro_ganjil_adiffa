<?php

namespace App\Http\Controllers;
use App\Models\AbsenBermasalah; // Jangan lupa import Model
use Illuminate\Http\Request;

class AbsenBermasalahController extends Controller
{
    public function index()
    {
        $dataAbsen = AbsenBermasalah::latest()->paginate(25); // Ambil data terbaru, 25 per halaman
        return view('absen.index', compact('dataAbsen'));
    }

    public function create()
    {
        return view('absen.form');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode_keterangan' => 'required|unique:absen_bermasalah,kode_keterangan',
            'keterangan' => 'required|string',
            'lokasi' => 'required|string',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
            'shift' => 'required|string',
            'kondisi' => 'required|string',
        ]);

        // Buat data baru
        AbsenBermasalah::create([
            'kode_keterangan' => $request->kode_keterangan,
            'keterangan' => $request->keterangan,
            'lokasi' => $request->lokasi,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'shift' => $request->shift,
            'kondisi' => $request->kondisi,
            'petugas_input' => 'Prita Anitya Melisa' // Ganti dengan user yang login
        ]);

        return redirect()->route('absen-bermasalah.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(AbsenBermasalah $absenBermasalah)
    {
        // Laravel otomatis akan mencari data berdasarkan ID
        return view('absen.form', ['absen' => $absenBermasalah]);
    }

    public function update(Request $request, AbsenBermasalah $absenBermasalah)
    {
        $request->validate([
            'kode_keterangan' => 'required|unique:absen_bermasalah,kode_keterangan,' . $absenBermasalah->id,
            'keterangan' => 'required|string',
            'lokasi' => 'required|string',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
            'shift' => 'required|string',
            'kondisi' => 'required|string',
        ]);

        $absenBermasalah->update($request->all());

        return redirect()->route('absen-bermasalah.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(AbsenBermasalah $absenBermasalah)
    {
        $absenBermasalah->delete();
        return redirect()->route('absen-bermasalah.index')->with('success', 'Data berhasil dihapus!');
    }
}