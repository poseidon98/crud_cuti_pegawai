<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::all();
        return view('pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
    {
        // Validasi dan simpan data pegawai
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:pegawais,email'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:Laki-laki,Perempuan'],
            'birth_date' => ['required', 'date'],
            'phone_number' => ['required', 'string', 'max:20'],
        ]);

        // Pegawai::create([
        //     'name' => $request->name,
        //     'last_name' => $request->last_name,
        //     'gender' => $request->gender,
        //     'birth_date' => $request->birth_date,
        //     'email' => $request->email,
        //     'phone_number' => $request->phone_number
        // ]);

        Pegawai::create($request->all());

        return redirect()->route('pegawai.index')->with('status', 'profile-updated');
    }

    public function show(Pegawai $pegawai)
    {
        return view('pegawai.show', compact('pegawai'));
    }

    public function edit(Pegawai $pegawai)
    {
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        // Validasi dan update data pegawai
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:Laki-laki,Perempuan'],
            'birth_date' => ['required', 'date'],
            'phone_number' => ['required', 'string', 'max:20'],
        ]);

        $pegawai->update($request->all());

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diperbarui.');
    }

    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();
        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus.');
    }
}
