<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class IndexController extends Controller
{

    public function index()
    {

        if (!file_exists(public_path('storage'))) {
            Artisan::call('storage:link');
        }
        return view('index', [
            'kecamatan' => Kecamatan::where('is_active', true)->orderBy('nama_kecamatan')->get(),
            'sekolah' => Sekolah::whereHas('kecamatan', function($q){
                $q->where('is_active', true);
            })->get(['id', 'kecamatan_id', 'nama'])
        ]);
    }

    public function loginSekolah()
    {
        return view('login', [
            'sekolah' => Sekolah::whereHas('kecamatan', function($q){ $q->where('is_active', true); })->get(),
            'kecamatan' => Kecamatan::where('is_active', true)->get()
        ]);
    }

    public function loginKcd()
    {
        return view('login-kcd');
    }

    public function storeSekolah()
    {
        // session()->regenerate();
        $attributes = request()->validate([
            'username' => 'required',
            'password' => 'required',
            'sekolah_id' => 'required',
            'kecamatan_id' => 'required'
        ]);

        $id = $attributes['kecamatan_id'];
        unset($attributes['kecamatan_id']);

        if (auth()->attempt($attributes)) {
            if (auth()->user()->hak_akses_id < 3) {
                session()->regenerate();
                return redirect('/sekolah/profil');
            }
            auth()->logout();
        }

        throw ValidationException::withMessages([
            'password' => 'Username atau password salah',
            'sekolah_id' => $id,
            'kecamatan_id' => $id
        ]);
    }

    public function storeKcd()
    {

        $attributes = request()->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $attributes['hak_akses_id'] = 3;

        if (auth()->attempt($attributes)) {
            session()->regenerate();

            return redirect('/kcd/kecamatan');
        }

        throw ValidationException::withMessages([
            'password' => 'Username atau password salah'
        ]);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/');
    }
    public function getsekolah($id)
    {
        $sekolah = Sekolah::where('id', $id)->first();
        // Return relationship data if needed for popup (e.g., Jenjang name)
        return response()->json($sekolah->load('jenjang')); 
    }

    public function getSekolahByKecamatan($id)
    {
        $sekolahs = Sekolah::where('kecamatan_id', $id)
                            ->orderBy('nama', 'asc')
                            ->get(['id', 'nama', 'npsn', 'jenjang_id']);
        
        return response()->json($sekolahs);
    }
}
