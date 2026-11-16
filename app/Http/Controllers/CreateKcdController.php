<?php

namespace App\Http\Controllers;

use App\Exports\FirstUserExport;
use App\Models\OldUser;
use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class CreateKcdController extends Controller
{
    public function createSekolah()
    {

        $attributes = request()->validate([
            'kecamatan_id' => ['required', Rule::exists('kecamatan', 'id')->where('is_active', 1)],
            'npsn' => ['required', 'unique:sekolah,npsn'],
            'nss' => ['required', 'unique:sekolah,nss'],
            'nama' => 'required',
            'jenjang_id' => ['required', Rule::exists('jenjang', 'id')->where('is_active', 1)],
            'kategori_sekolah_id' => ['required', Rule::exists('kategori_sekolah', 'id')->where('is_active', 1)]
        ]);

        $sekolah = Sekolah::create($attributes);

        $password1 = "123456";
        $password2 = "123456";

        $userOperator = User::create([
            'username' => 'operator' . $sekolah->npsn,
            'password' => Hash::make($password1),
            'sekolah_id' => $sekolah->id,
            'hak_akses_id' => 1,
            'remember_token' => Str::random(10)
        ]);

        $userKepsek = User::create([
            'username' => 'kepsek' . $sekolah->npsn,
            'password' => Hash::make($password2),
            'sekolah_id' => $sekolah->id,
            'hak_akses_id' => 2,
            'remember_token' => Str::random(10)
        ]);

        OldUser::create([
            'users_id' => $userOperator->id,
            'username' => $userOperator->username,
            'first_password' => $password1
        ]);

        OldUser::create([
            'users_id' => $userKepsek->id,
            'username' => $userKepsek->username,
            'first_password' => $password2
        ]);

        return redirect('kcd/kecamatan');
    }

    public function createSekolahKosong(Request $request)
    {
        $attributes = $request->validate([
            'npsn' => ['required', 'unique:sekolah,npsn'],
            'password' => ['required', 'min:6'],
            'kecamatan_id' => ['nullable', 'exists:kecamatan,id']
        ]);

        // Create with just NPSN. Other fields are nullable thanks to our migration.
        $sekolah = Sekolah::create([
            'npsn' => $attributes['npsn'],
            'nama' => 'Sekolah Baru (' . $attributes['npsn'] . ')', // Placeholder name
            'kecamatan_id' => $attributes['kecamatan_id'] ?? null
        ]);

        // Create Operator User
        User::create([
            'username' => $attributes['npsn'], // User requested NPSN as username
            'password' => Hash::make($attributes['password']),
            'sekolah_id' => $sekolah->id,
            'hak_akses_id' => 1, // Assumed 1 is Operator/School Admin
            'remember_token' => Str::random(10)
        ]);

        return redirect()->back()->with('success', 'Akun sekolah berhasil dibuat!');
    }
}
