<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\GuruPrestasi;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CrudGuruPrestasiController extends Controller
{
    public function createGuruPrestasi()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        $validator = Validator::make(request()->toArray(), [
            'nip' => ['required', Rule::exists('guru', 'nip')],
            'tingkat_id' => ['required', Rule::exists('tingkat_prestasi', 'id')],
            'prestasi_guru' => 'required'
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator, 'input')->withInput();
        }

        $attributes = $validator->validated();

        $id_guru = Guru::where('nip', $attributes['nip'])->without(['status_pegawai', 'mapel', 'pendidikan'])->first();
        $attributes['guru_id'] = $id_guru->id;
        unset($attributes['nip']);
        $attributes['sekolah_id'] = $sekolah->id;

        GuruPrestasi::create($attributes);
        return redirect()->back();
    }

    public function updateGuruPrestasi()
    {
        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        $validator = Validator::make(request()->toArray(), [
            'nip' => ['required', Rule::exists('guru', 'nip')],
            'tingkat_id' => ['required', Rule::exists('tingkat_prestasi', 'id')],
            'prestasi_guru' => 'required'
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator, 'edit')->withInput();
        }

        $attributes = $validator->validated();

        $attributes['sekolah_id'] = $sekolah->id;
        $id = $attributes['id'];
        unset($attributes['id']);

        GuruPrestasi::find($id)->update($attributes);
        return redirect()->back();
    }

    public function deleteGuruPrestasi(GuruPrestasi $guru_prestasi)
    {
        $guru_prestasi->delete();

        return redirect()->back();
    }
}
