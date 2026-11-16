<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jam;
use App\Models\Ptk;
use App\Models\Rombel;
use App\Models\Sapras;
use App\Models\Sekolah;
use App\Models\SiswaPrestasi;
use App\Models\TingkatKebutuhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UpdateSekolahController extends Controller
{
    public function updateProfil()
    {

        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        $attributes = request()->validate([
            'kecamatan_id' => ['required', Rule::exists('kecamatan', 'id')],
            'npsn' => ['required', Rule::unique('sekolah', 'npsn')->ignore($sekolah->id)],
            'nss' => ['nullable', Rule::unique('sekolah', 'nss')->ignore($sekolah->id)],
            'nama' => 'required',
            'kepala_sekolah' => 'nullable',
            'profile_image' => 'nullable|image',
            'alamat' => 'nullable',
            'telepon' => 'nullable',
            'fax' => 'nullable',
            'email' => 'nullable',
            'jenjang_melayani' => 'nullable|array',
            'kategori_sekolah_id' => 'required',
            'jenjang_id' => 'required'
        ]);

        $attributes['id'] = $sekolah->id;

        
        if (isset($attributes['profile_image'])) {
            
            if ($sekolah->profile_image) {
                Storage::delete($sekolah->profile_image);
            }

            $attributes['profile_image'] = request()->file('profile_image')->store('public/profiles');
//            $attributes['profile_image'] = request()->file('profile_image')->store('public/profiles');
        }

        $sekolah->update($attributes);

        return redirect()->back();
    }
}
