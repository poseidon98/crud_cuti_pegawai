<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Cuti;
use Carbon\Carbon;

class CutiController extends Controller
{
    public function index()
    {

        $cuti = Cuti::with('pegawai')->get();
        return view('cuti.index', compact('cuti'));
    }

    public function create()
    {
        $pegawai = Pegawai::all(); // Menampilkan daftar pegawai
        return view('cuti.create', compact('pegawai'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'keterangan' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Cek apakah pegawai sudah mengambil cuti lebih dari 12 hari dalam setahun
        $pegawai_id = $request->pegawai_id;
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);

        $tahun = now()->year;
        $cutiTotalTahun = Cuti::where('pegawai_id', $pegawai_id)
            ->whereYear('start_date', $tahun)
            ->whereYear('end_date', $tahun)
            ->get()
            ->sum(function ($cuti) {
                return Carbon::parse($cuti->end_date)->diffInDays(Carbon::parse($cuti->start_date)) + 1; // Total hari cuti
            });

        $durasiCuti = $end_date->diffInDays($start_date) + 1;


        if ($cutiTotalTahun + $durasiCuti > 12) {
            return back()->withErrors(['message' => 'Pegawai sudah melebihi batas maksimal cuti 12 hari dalam setahun.']);
        }

        // Cek apakah pegawai sudah mengambil cuti di bulan yang sama
        $bulan = $start_date->month;
        $cutiBulanIni = Cuti::where('pegawai_id', $pegawai_id)
            ->whereMonth('start_date', $bulan)
            ->whereMonth('end_date', $bulan)
            ->exists();

        if ($cutiBulanIni || $durasiCuti > 1) {
            return back()->withErrors(['message' => 'Pegawai hanya dapat mengambil 1 hari cuti dalam bulan yang sama.']);
        }

        // Simpan data cuti
        Cuti::create($request->all());

        return redirect()->route('cuti.index')->with('success', 'Cuti berhasil ditambahkan');
    }

    public function edit(Cuti $cuti)
    {
        $pegawai = Pegawai::all();
        return view('cuti.edit', compact('cuti', 'pegawai'));
    }

    public function update(Request $request, Cuti $cuti)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'keterangan' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Cek apakah pegawai sudah mengambil cuti lebih dari 12 hari dalam setahun
        $pegawai_id = $request->pegawai_id;
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);
        $tahun = now()->year;
        $cutiTotalTahun = Cuti::where('pegawai_id', $pegawai_id)
            ->whereYear('start_date', $tahun)
            ->whereYear('end_date', $tahun)
            ->get()
            ->sum(function ($cuti) {
                return Carbon::parse($cuti->end_date)->diffInDays(Carbon::parse($cuti->start_date)) + 1;
            });

        $durasiCuti = $end_date->diffInDays($start_date) + 1;

        if ($cutiTotalTahun + $durasiCuti > 12) {
            return back()->withErrors(['message' => 'Pegawai sudah melebihi batas maksimal cuti 12 hari dalam setahun.']);
        }

        if ($durasiCuti > 1) {
            return back()->withErrors(['message' => 'Pegawai hanya dapat mengambil 1 hari cuti dalam bulan yang sama.']);
        }

        // Update data cuti
        $cuti->update($request->all());

        return redirect()->route('cuti.index')->with('success', 'Cuti berhasil diperbarui');
    }

    public function destroy(Cuti $cuti)
    {
        $cuti->delete();
        return redirect()->route('cuti.index')->with('success', 'Cuti berhasil dihapus');
    }
}
