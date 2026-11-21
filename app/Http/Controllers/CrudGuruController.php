<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jam;
use App\Models\Mapel;
use App\Models\Sekolah;
use App\Models\TingkatKebutuhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CrudGuruController extends Controller
{
    private function updateKebutuhan($mapel_id, $sekolah_id)
    {
        $jamModel = Jam::where('mapel_id', $mapel_id)->first();
        if (!$jamModel) return;

        $tk = TingkatKebutuhan::where('jam_id', $jamModel->id)->first();
        if (!$tk) return;

        // Count teachers for this mapel in this school using pivot
        $count = Guru::where('sekolah_id', $sekolah_id)
                     ->whereHas('mapels', function($q) use ($mapel_id) {
                         $q->where('mapel.id', $mapel_id);
                     })->count();
        
        $tb = $count - $tk->quota;
        $lebih = ($tb > 0) ? $tb : 0;
        $kurang = ($tb < 0) ? abs($tb) : 0;

        $tk->update([
            'lebih' => $lebih,
            'kurang' => $kurang
        ]);
    }

    public function createGuru()
    {
        $sekolah = Sekolah::find(auth()->user()->sekolah_id);

        $validator = Validator::make(request()->toArray(), [
            'nip' => ['required', Rule::unique('guru', 'nip')->ignore(request()->id)],
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'telepon' => 'nullable',
            'email' => 'nullable',
            'status_pegawai_id' => ['required', Rule::exists('status_pegawai', 'id')],
            'pendidikan_id' => ['required', Rule::exists('pendidikan', 'id')],
            'mapel_id' => 'required|array',
            'mapel_id.*' => Rule::exists('mapel', 'id')
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator, 'input')->withInput();
        }

        $attributes = $validator->validated();
        $mapelIds = $attributes['mapel_id'];
        unset($attributes['mapel_id']);

        $attributes['sekolah_id'] = $sekolah->id;
        
        // Backward compatibility: set mapel_id to first selected if available
        if(!empty($mapelIds)) {
            $attributes['mapel_id'] = $mapelIds[0];
        }

        $guru = Guru::create($attributes);
        $guru->mapels()->attach($mapelIds);

        foreach ($mapelIds as $mid) {
            $this->updateKebutuhan($mid, $sekolah->id);
        }

        \App\Models\VerifikasiData::catat($sekolah->id, 'Guru', 'Penambahan data Guru: ' . $attributes['nama']);

        return redirect()->back();
    }

    public function updateGuru()
    {
        $validator = Validator::make(request()->toArray(), [
            'id' => ['required', Rule::exists('guru', 'id')],
            'nip' => ['required', Rule::unique('guru', 'nip')->ignore(request()->id)],
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'telepon' => 'nullable',
            'email' => 'nullable',
            'status_pegawai_id' => ['required', Rule::exists('status_pegawai', 'id')],
            'pendidikan_id' => ['required', Rule::exists('pendidikan', 'id')],
            'mapel_id' => 'required|array',
            'mapel_id.*' => Rule::exists('mapel', 'id'),
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator, 'edit')->withInput();
        }

        $attributes = $validator->validated();
        $id = $attributes['id'];
        $mapelIds = $attributes['mapel_id'];
        unset($attributes['id']);
        unset($attributes['mapel_id']);

        // Backward compatibility
        if(!empty($mapelIds)) {
             $attributes['mapel_id'] = $mapelIds[0];
        }

        $guru = Guru::find($id);
        
        // Get old mapels to re-calculate their needs later
        $oldMapelIds = $guru->mapels()->pluck('mapel_id')->toArray();
        if(empty($oldMapelIds) && $guru->mapel_id) $oldMapelIds = [$guru->mapel_id];

        $guru->update($attributes);
        $guru->mapels()->sync($mapelIds);

        // Update kebutuhan for old and new mapel IDs - merge unique
        $allMapelsToUpdate = array_unique(array_merge($oldMapelIds, $mapelIds));
        
        foreach ($allMapelsToUpdate as $mid) {
            $this->updateKebutuhan($mid, $guru->sekolah_id);
        }

        return redirect()->back();
    }

    public function deleteGuru(Guru $guru)
    {
        $mapelIds = $guru->mapels()->pluck('mapel_id')->toArray();
        if(empty($mapelIds) && $guru->mapel_id) $mapelIds = [$guru->mapel_id];
        
        $sekolahId = $guru->sekolah_id; // Capture before delete
        
        $guru->mapels()->detach(); // Optional if cascade works, but safer
        $guru->delete();

        foreach ($mapelIds as $mid) {
            $this->updateKebutuhan($mid, $sekolahId);
        }

        return redirect()->back();
    }
}
