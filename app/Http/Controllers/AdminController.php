<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function index()
    {
        $admin = User::all();
        return view('admin.index', compact('admin'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.index')->with('status', 'profile-updated');
    }

    public function edit(User $user)
    {
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validasi dan update data pegawai
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:Laki-laki,Perempuan'],
            'birth_date' => ['required', 'date'],
        ]);

        $user->update($request->all());

        return redirect()->route('admin.index')->with('success', 'Pegawai berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.index')->with('success', 'Pegawai berhasil dihapus.');
    }
}
