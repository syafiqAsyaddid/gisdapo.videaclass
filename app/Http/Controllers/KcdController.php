<?php

namespace App\Http\Controllers;

use App\Models\Jenjang;
use App\Models\KategoriSekolah;
use App\Models\Kecamatan;
use App\Models\Sekolah;
use Illuminate\Http\Request;

class KcdController extends Controller
{
    public function kecamatan()
    {

        return view('kcd.kecamatan', [
            'page' => 'kecamatan',
            'kecamatan' => Kecamatan::where('is_active', true)->get()->load(['sekolah']),
            'jenjang' => Jenjang::where('is_active', true)->get(),
            'kategori' => KategoriSekolah::where('is_active', true)->get()
        ]);
    }
    // public function inputSekolah(Kecamatan $kecamatan)
    // {
    //     return view('kcd.input-sekolah', [
    //         'page' => 'input',
    //         'kecamatan' => $kecamatan,
    //         'jenjang' => Jenjang::all(),
    //         'kategori' => KategoriSekolah::all()
    //     ]);
    // }
    public function sekolah(Kecamatan $kecamatan)
    {
        return view('kcd.sekolah', [
            'page' => 'sekolah',
            'jenjang' => Jenjang::where('is_active', true)->get(),
            'kategori' => KategoriSekolah::where('is_active', true)->get(),
            'kecamatan' => $kecamatan,
            'data' => $kecamatan->sekolah->sortBy('nama')
        ]);
    }

    public function updateSekolah(Request $request, Sekolah $sekolah)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'npsn' => 'required',
            'nss' => 'nullable',
            'jenjang_id' => 'required',
            'kategori_sekolah_id' => 'required',
            'kecamatan_id' => 'required'
        ]);

        $sekolah->update($validated);

        return redirect()->back()->with('success', 'Data Sekolah berhasil diperbarui.');
    }

    public function resetPassword(Request $request, Sekolah $sekolah)
    {
        $request->validate([
            'password' => 'required|min:6'
        ]);

        $newPassword = bcrypt($request->password);
        
        foreach($sekolah->user as $user) {
            $user->update(['password' => $newPassword]);
        }
        
        return redirect()->back()->with('success', 'Password berhasil diubah.');
    }

    public function deleteSekolah(Sekolah $sekolah)
    {

        foreach ($sekolah->ptk as $ptk) {
            $ptk->delete();
        }

        foreach ($sekolah->guru_prestasi as $guru_prestasi) {
            $guru_prestasi->delete();
        }
        foreach ($sekolah->siswa_prestasi as $siswa_prestasi) {
            $siswa_prestasi->delete();
        }
        foreach ($sekolah->guru as $guru) {
            $guru->delete();
        }
        foreach ($sekolah->sapras as $sapras) {
            $sapras->delete();
        }
        foreach ($sekolah->siswa as $siswa) {
            $siswa->delete();
        }
        foreach ($sekolah->rombel as $rombel) {
            $rombel->delete();
        }
        foreach ($sekolah->tingkat_kebutuhan as $tingkat_kebutuhan) {
            $tingkat_kebutuhan->delete();
        }
        foreach ($sekolah->jam as $jam) {
            $jam->delete();
        }

        foreach ($sekolah->user as $user) {
            if ($user->old_user) {
                $user->old_user->delete();
            }
            $user->delete();
        }

        $sekolah->delete();

        return redirect('/kcd/kecamatan/' . $sekolah->kecamatan_id . '/sekolah')->with('success', 'Sekolah berhasil dihapus.');
    }
}
